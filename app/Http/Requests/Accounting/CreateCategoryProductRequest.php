<?php

namespace App\Http\Requests\Accounting;

use App\Http\Requests\ApiRequest;

class CreateCategoryProductRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'group_id' => 'required|integer|exists:groups,id'
        ];
    }
}
