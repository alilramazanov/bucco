<?php

namespace App\Http\Repositories\Control;

use App\Http\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;


class BaseRepository extends Repository
{

    protected function getModelClass()
    {
        return Model::class;
    }



}
