<?php

namespace App\Http\Repositories\Control;


use App\Models\Member as Model;

class MemberRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }


}
