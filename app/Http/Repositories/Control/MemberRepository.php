<?php

namespace App\Http\Repositories\Control;


use App\Http\Requests\Control\Members\AdminMemberListRequest;
use App\Http\Resources\Control\Group\PortfolioResource;
use App\Http\Resources\Control\Member\AdminMemberListResource;
use App\Http\Resources\Control\Member\GroupMemberListResource;
use App\Models\Group;
use App\Models\Member;
use App\Models\Member as Model;
use App\Models\Portfolio;

class MemberRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }


    public function getAdminMemberList($request){

        $columns = [
            'id',
            'name'
        ];

        $adminMembers = $this->startConditions()
            ->select($columns)
            ->where('admin_id', $request->input('admin_id'))
            ->paginate();

        return AdminMemberListResource::collection($adminMembers);
    }



    public function getGroupMemberList($request){

        $groupId = $request->get('group_id');

        $group = Group::find($groupId);
        $groupMemberList = [];

        foreach ($group->members as $member){
            if ($member->pivot->group_id == $groupId){
                $groupMemberList [] = $member;
            }
        }

        return GroupMemberListResource::collection($groupMemberList);



//            метод который не сработал
//        (через startCondition не виден pivot)


//        $columns = [
//            'id',
//            'name'
//        ];
//
//        $member = $this->startConditions()
//            ->select($columns)
//            ->where('id', $request->get('member_id'))
//            ->get();
//
//        foreach ($member->groups as $group){
//            $groupId = $group->pivot->group_id;
//
//
//        }
//        dd($groupId);


    }
}
