<?php

namespace App\Http\Requests\Accounting;

use App\Http\Requests\ApiRequest;

class DetailCategoryProductRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:category_products,id'
        ];
    }
}
