<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Loader\Accounting\SubcategoryProductLoader;
use App\Http\Repositories\Accounting\SubcategoryProductRepository;
use App\Http\Requests\Accounting\CreateSubcategoryProductRequest;
use App\Http\Requests\Accounting\DetailCategoryProductRequest;
use App\Http\Resources\Accounting\SubcategoryProductListResource;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\SubcategoryProduct;
use Illuminate\Http\Request;

class SubcategoryProductController extends Controller
{

    protected $subcategoryProductRepository;
    protected $subcategoryProductLoader;
    protected $stdClass;
    public function __construct()
    {
        $this->subcategoryProductRepository = app(SubcategoryProductRepository::class);
        $this->subcategoryProductLoader = app(SubcategoryProductLoader::class);
        $this->stdClass = app(\stdClass::class);
        $this->middleware('auth');
    }

    public function subcategoryList(DetailCategoryProductRequest $request)
    {
        $subcategoriesProduct = $this->subcategoryProductRepository->getGroupSubcategoryList($request);

        if ($subcategoriesProduct == null) {
            $this->stdClass->message = 'Подкатегории не найдены';
            return new BasicErrorResource($this->stdClass);
        }
        return SubcategoryProductListResource::collection($subcategoriesProduct);
    }

    public function create(CreateSubcategoryProductRequest $request)
    {
        $isCreate = $this->subcategoryProductLoader->createSubcategory($request);

        if ($isCreate == null) {
            $this->stdClass->message = 'Ошибка при создании';
            return new BasicErrorResource($this->stdClass);
        }
        $this->stdClass->message = 'Подкатегория создана';
        return new SuccessResource($this->stdClass);
    }

    public function changeStatus(Request $request)
    {
        $subcategory = SubcategoryProduct::whereId($request->input('id'))->first();
        $subcategory->is_processing === false ? $subcategory->is_processing = true : $subcategory->is_processing = false;
        $subcategory->update();
        $this->stdClass->message = 'Статус изменён';
        return new SuccessResource($this->stdClass);
    }
}
