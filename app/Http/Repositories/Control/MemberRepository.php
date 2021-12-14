<?php

namespace App\Http\Repositories\Control;


use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Member\AdminMemberListResource;
use App\Http\Resources\Control\Member\DetailGroupMemberResource;
use App\Http\Resources\Control\Member\DetailMemberResource;
use App\Http\Resources\Control\Member\GroupMemberListResource;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Member;
use App\Models\Member as Model;
use Illuminate\Support\Facades\Auth;

class MemberRepository extends BaseRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }



    public function getAdminMemberList(){

        $adminId = Auth::user()->id;

        $adminMemberList = Member::whereAdminId($adminId)
            ->orderByDesc('id')
            ->get();

        return $adminMemberList;
    }


    public function getGroupMemberList($request){

        $groupId = $request->group_id;
        $group = Group::find($groupId);

        $groupMemberList = [];

        foreach ($group->members as $member){
            if ($member->pivot->group_id == $groupId){
                $groupMemberList [] = $member;
            }
        }

        $groupMemberList = array_reverse($groupMemberList);

        return $groupMemberList;

    }


    public function detailGroupMember($request)
    {
        $groupMember = GroupMember::whereId($request->id)->first();

        return $groupMember;
    }



    public function detailMember($request)
    {
        $member = Member::whereId($request->input('id'))
            ->whereAdminId(\Auth::user()->id)
            ->first();

        return $member;
    }
}
