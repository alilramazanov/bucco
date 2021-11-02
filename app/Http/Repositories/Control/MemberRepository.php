<?php

namespace App\Http\Repositories\Control;


use App\Http\Resources\Control\Member\AdminMemberListResource;
use App\Http\Resources\Control\Member\GroupMemberListResource;
use App\Models\Admin;
use App\Models\Group;
use App\Models\Member as Model;

class MemberRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }


    public function getAdminMemberList($request){

        $adminId = $request->input('admin_id');
        $admin = Admin::whereId($adminId)->first();
        $adminMemberList = [];

        foreach ($admin->members as $member){
            $adminMemberList [] = $member;

        }

        return AdminMemberListResource::collection($adminMemberList);
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

    }
}
