<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Loader\Accounting\CategoryProductLoader;
use App\Http\Repositories\Accounting\CategoryProductRepository;
use App\Http\Requests\Accounting\CreateCategoryProductRequest;
use App\Http\Requests\Control\Groups\DetailGroupRequest;
use App\Http\Resources\Accounting\CategoryProductListResource;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{

    protected $categoryProductRepository;
    protected $categoryProductLoader;
    protected $stdClass;

    public function __construct()
    {
        $this->categoryProductRepository = app(CategoryProductRepository::class);
        $this->categoryProductLoader = app(CategoryProductLoader::class);
        $this->stdClass = app(\stdClass::class);
        $this->middleware('auth');
    }


    public function categoryList(DetailGroupRequest $request)
    {
        $productCategories = $this->categoryProductRepository->getGroupCategoryList($request);

        if ($productCategories == null) {
            $this->stdClass->message = 'Категории не найдены';
            return new BasicErrorResource($this->stdClass);
        }
        return CategoryProductListResource::collection($productCategories);
    }

    public function create(CreateCategoryProductRequest $request)
    {
        $isCreate = $this->categoryProductLoader->createCategory($request);

        if ($isCreate == null) {
            $this->stdClass->message = 'Ошибка при создании';
            return new BasicErrorResource($this->stdClass);
        }
        $this->stdClass->message = 'Категория создана';
        return new SuccessResource($this->stdClass);
    }

    public function changeStatus(Request $request)
    {
        $category = CategoryProduct::whereId($request->input('id'))->first();
        $category->is_processing === false ? $category->is_processing = true : $category->is_processing = false;
        $category->update();
    }
}
