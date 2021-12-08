<?php

namespace App\Http\Repositories\Accounting;

use App\Models\SubcategoryProduct as Model;

class SubcategoryProductRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getGroupSubcategoryList($request)
    {
        $columns = [
            'id',
            'name',
            'category_product_id',
            'is_processing'
        ];

        $subcategories = $this->startConditions()
            ->select($columns)
            ->whereCategoryProductId($request->input('id'))
            ->get();

        return $subcategories;
    }
}
