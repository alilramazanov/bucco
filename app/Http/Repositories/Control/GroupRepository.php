<?php

namespace App\Http\Repositories\Control;

use App\Http\Resources\Control\Group\GroupListResource;
use App\Http\Resources\Control\Group\GroupStatisticListResource;
use App\Models\Group as Model;
use App\Models\Member;


class GroupRepository extends BaseRepository
{


    protected function getModelClass()
    {
        return Model::class;
    }

    public function getGroupList(){

        $adminId = \Auth::user()->id;

        $columns = [
            'id',
            'name',
            'admin_id',
            'avatar'
        ];

        $groups = $this->startConditions()
            ->select($columns)
            ->whereAdminId($adminId)
            ->get();

        return GroupListResource::collection($groups);
    }

    public function getGroupStatisticList(){

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

    public function getMemberGroup(){

        $memberId = \Auth::guard('member')->user()->id;


        $groups = Member::whereId($memberId)
            ->first()
            ->groups;

        return GroupListResource::collection($groups);
    }

}
