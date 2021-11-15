<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class DetailMemberRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'id' => 'integer|required|exists:members,id'
        ];
    }

}
