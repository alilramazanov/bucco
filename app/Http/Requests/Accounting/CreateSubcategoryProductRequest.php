<?php

namespace App\Http\Requests\Accounting;

use App\Http\Requests\ApiRequest;

class CreateSubcategoryProductRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'category_product_id' => 'required|integer|exists:category_products,id'
        ];
    }
}
