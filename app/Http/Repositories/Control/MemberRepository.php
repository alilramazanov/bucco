<?php

namespace App\Http\Repositories\Control;


use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Member\AdminMemberListResource;
use App\Http\Resources\Control\Member\GroupMemberListResource;
use App\Models\Admin;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Member;
use App\Models\Member as Model;
use Illuminate\Support\Facades\Auth;

class MemberRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }


    public function getAdminMemberList(){

        $adminId = Auth::user()->id;
        $adminMemberList = Member::whereAdminId($adminId)
            ->orderByDesc('id')
            ->get();

        $checkAdminMembers = Model::whereAdminId($adminId)->exists();

        if (!$checkAdminMembers) {
            $stdClass = new \StdClass();
            $stdClass->message = 'Участники не найдены';
            return new BasicErrorResource($stdClass);
        }

        return AdminMemberListResource::collection($adminMemberList);
    }



    public function getGroupMemberList($request){

        $groupId = $request->get('group_id');
        $stdClass = new \stdClass();
        $group = Group::find($groupId);

        $groupMemberList = [];


        foreach ($group->members as $member){
            if ($member->pivot->group_id == $groupId){
                $groupMemberList [] = $member;

            }
        }

        $groupMemberList = array_reverse($groupMemberList);

        if (!$groupMemberList) {
            $stdClass->message = 'Участники группы не найдены';
            return new BasicErrorResource($stdClass);
        }

        return GroupMemberListResource::collection($groupMemberList);

    }
}
