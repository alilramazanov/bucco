<?php

namespace App\Http\Repositories\Accounting;

use App\Models\CategoryProduct as Model;

class CategoryProductRepository extends BaseRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getGroupCategoryList($request)
    {
        $columns = [
            'id',
            'name',
            'group_id',
            'is_processing'
        ];

        $categories = $this->startConditions()
            ->select($columns)
            ->whereGroupId($request->input('id'))
            ->get();

        return $categories;
    }
}
