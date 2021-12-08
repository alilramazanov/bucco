<?php

namespace App\Http\Loader\Accounting;

use App\Models\CategoryProduct;

class CategoryProductLoader extends BaseLoader
{

    public function createCategory($request)
    {
        $data = $request->input();
        $category = CategoryProduct::create($data);

        return $category;
    }
}
