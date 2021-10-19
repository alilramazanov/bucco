<?php

namespace App\Http\Repositories\Control;

use App\Http\Repositories\Repository;
use App\Models\Task as Model;

class BaseRepository extends Repository
{

    protected function getModelClass()
    {
        return Model::class;
    }



}
