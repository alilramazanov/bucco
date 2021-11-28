<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Requests\Control\Penalties\CreatePenaltiesRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Penalties;

class PenaltiesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(CreatePenaltiesRequest $request)
    {
        $stdClass = new \stdClass();
        if (Penalties::create($request->input())){
            $stdClass->message = 'Успешно';
            return new SuccessResource($stdClass);
        }
            $stdClass->message = 'Ошибка при добавлении штрафа';
            return new BasicErrorResource($stdClass);
    }


}
