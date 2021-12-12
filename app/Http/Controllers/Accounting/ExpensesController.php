<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounting\DataResource;
use App\Http\Resources\Accounting\DetailExpenseResource;
use App\Http\Resources\Accounting\ExpenseListResource;
use App\Http\Resources\Accounting\ListExpenseResource;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\CategoryProduct;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;


class ExpensesController extends Controller
{

    protected $stdClass;

    public function __construct()
    {
        $this->stdClass = app(\stdClass::class);
        $this->middleware('auth');
    }


    public function createExpenseCategory(Request $request)
    {
        $data = $request->input();

        $isCreate = ExpenseCategory::create($data);

        if (!($isCreate === null)) {
            $this->stdClass->message = 'Категория успешно добавлена';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка сохранения категории';
        return new SuccessResource($this->stdClass);


    }

    public function createExpense(Request $request)
    {

        $data = $request->input();
        $isCreate = Expense::create($data);

        if (!($isCreate === null)) {
            $this->stdClass->message = 'Оплата успешно добавлена';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка сохранения оплаты';
        return new SuccessResource($this->stdClass);

    }

    public function updateStatusExpense(Request $request)
    {

        $expense = Expense::find($request->input('id'));

        $expense->is_paid == false ? $expense->is_paid = true : $expense->is_paid = false;
        $isUpdate = $expense->save();

        if ($isUpdate) {
            $this->stdClass->message = 'Статус успешно обновлен';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка обновления статуса';
        return new SuccessResource($this->stdClass);


    }

    public function detailExpense(Request $request)
    {

        $expenses = Expense::whereGroupId($request->id)
            ->whereExpenseCategoryId($request->expense_category_id)
            ->orderByDesc('is_paid')
            ->get();


        return DetailExpenseResource::collection($expenses)->groupBy(function ($expenses) {
            return substr($expenses['created_at'], 0, 10);
        });

    }

    public function listExpense(Request $request){

        $expenses = Expense::whereGroupId($request->id)
            ->get();

//        $categoryProducts = CategoryProduct::whereGroupId($request->id)
//            ->select('id', 'group_id', 'name', 'is_processing', 'created_at' );
//
//
//        $expenses = Expense::whereGroupId($request->id)
//            ->select('id', 'expense_category_id',  'name', 'is_paid', 'created_at', )
//            ->unionAll($categoryProducts)
//            ->get();

//        $expenses = \DB::table('expenses as e')
//            ->where('e.group_id', $request->id)
//            ->rightJoin('category_products as cp', 'e.group_id', '=', 'cp.group_id')
//            ->select('e.id as e_id', 'cp.id as cp_id')
//            ->get();




        if ($expenses->isEmpty()){
            $this->stdClass->message = 'Расходов нет';
            return new BasicErrorResource($this->stdClass);
        }

        return ListExpenseResource::collection($expenses)->groupBy('expense_category_id');

    }
}
