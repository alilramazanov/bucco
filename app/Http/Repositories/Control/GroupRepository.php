<?php

namespace App\Http\Repositories\Control;

use App\Http\Resources\Control\Group\GroupListResource;
use App\Http\Resources\Control\Group\GroupStatisticListResource;
use App\Models\Group as Model;


class GroupRepository extends BaseRepository
{


    protected function getModelClass()
    {
        return Model::class;
    }

    public function getGroupList($request){

        $adminId = \Auth::user()->id;

        $columns = [
            'id',
            'name',
            'admin_id'
        ];

        $groups = $this->startConditions()
            ->select($columns)
            ->whereAdminId($adminId)
            ->get();

        return GroupListResource::collection($groups);
    }

    public function getGroupStatisticList($request){

        $adminId = \Auth::user()->id;
        $columns = [
            'id',
            'name',
            'admin_id'
        ];

        $groups = $this->startConditions()
            ->select($columns)
            ->whereAdminId($adminId)
            ->get();

        return GroupStatisticListResource::collection($groups);

    }

}
