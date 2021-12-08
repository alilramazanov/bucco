<?php

namespace App\Http\Loader\Accounting;

use App\Models\SubcategoryProduct;

class SubcategoryProductLoader extends BaseLoader
{

    public function createSubcategory($request)
    {
        $data = $request->input();
        $subcategory = SubcategoryProduct::create($data);

        return $subcategory;
    }
}
