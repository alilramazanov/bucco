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
        $columns = [
            'id',
            'name',
            'admin_id'
        ];

        $groups = $this->startConditions()
            ->select($columns)
            ->where('admin_id', $request->get('admin_id'))
            ->get();

        return GroupListResource::collection($groups);
    }

    public function getGroupStatisticList($request){
        $columns = [
            'id',
            'name',
            'admin_id'
        ];

        $groups = $this->startConditions()
            ->select($columns)
            ->where('admin_id', $request->get('admin_id'))
            ->get();

        return GroupStatisticListResource::collection($groups);

    }

}
