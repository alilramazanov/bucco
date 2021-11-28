<?php

namespace App\Http\Requests\Control\Penalties;

use App\Http\Requests\ApiRequest;

class CreatePenaltiesRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'member_id' => 'integer|required|exists:members,id',
            'group_id' => 'integer|required|exists:groups,id',
            'amount_of_penalty' => 'integer|required'
        ];
    }
}
