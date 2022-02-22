<?php

namespace App\Http\Repositories\Control;



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

        $columns  = [
            'm.id',
            'm.name',
            'm.avatar',
            'group_members.group_id as group_id',
            'group_members.position'
        ];

        $groupMembers = GroupMember::query()
            ->select($columns)
            ->where('group_members.group_id', 1)
            ->leftJoin('members as m', 'm.id', '=', 'group_members.member_id')
            ->orderBy('m.created_at', 'desc')
            ->get();


        return $groupMembers;

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
