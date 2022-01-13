<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounting\ProductListResource;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $stdClass;

    public function __construct()
    {
        $this->stdClass = app(\stdClass::class);
        $this->middleware('auth');
    }

    public function addProduct(Request $request)
    {
        $data = $request->input();
        $isCreate = Product::create($data);

        if ($isCreate == null) {
            $this->stdClass->message = 'Ошибка добавления';
            return new BasicErrorResource($this->stdClass);
        }
        $this->stdClass->message = 'Товар успешно добавлен';
        return new SuccessResource($this->stdClass);
    }

    public function addCount(Request $request)
    {
        $product = Product::whereId($request->input('id'))->first();
        $product->count += 1;
        $product->update();
        $this->stdClass->message = 'Добавлено';
        return new SuccessResource($this->stdClass);
    }

    public function minusCount(Request $request)
    {
        $product = Product::whereId($request->input('id'))->first();
        $product->count -= 1;
        $product->update();
        $this->stdClass->message = 'Удалено';
        return new SuccessResource($this->stdClass);
    }

    public function list(Request $request)
    {
        $columns = [
            'id', 'name', 'count', 'subcategory_product_id'
        ];

        $products = Product::select($columns)
            ->whereSubcategoryProductId($request->input('subcategory_product_id'))
            ->get();

        return ProductListResource::collection($products);
    }

    public function changeCount(Request $request){

        $products = json_decode($request->input('values'), true);

        $numOfUpdated = 0;
        foreach ($products as $product) {
            $isUpdate = Product::whereId($product['id'])
                ->update(['count' => $product['count']]);

            if ($isUpdate){
                $numOfUpdated += 1;
            }
        }

        $this->stdClass->message = 'Обновлено продуктов: ' . $numOfUpdated;
        return new SuccessResource($this->stdClass);

    }
}
