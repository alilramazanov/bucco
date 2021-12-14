<?php

namespace App\Http\Loader\Control;

use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\GroupMember;
use App\Models\Member;

class MemberLoader extends BaseLoader
{
    protected $groupLoader;
    protected $stdClass;

    public function __construct(){
        $this->groupLoader = app(GroupLoader::class);
        $this->stdClass = new \stdClass();
    }


    public function createMember($request)
    {
        $adminId = \Auth::user()->id;
        $data = $request->input();
        $data['name'] = trim($data['name']);
        $data['user_notification_id'] = $data['login'];
        $data['password_visible'] = $data['password'];
        $data['password'] = app('hash')->make($data['password']);
        $data['avatar'] = Member::DEFAULT_AVATAR;
        $data['admin_id'] = $adminId;

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('members', 'public');
        }

        $newMember = Member::create($data);

        return $newMember;
    }


    public function createMemberInGroup($request){

        $isCreateMember = $this->createMember($request);
        $data = $request->input();

        $data['member_id'] = $isCreateMember->id;

        $isAddInGroup = GroupMember::create($data);

        return $isAddInGroup;
    }

    public function unsertMemberFromGroup($request){

        $isDelete = GroupMember::where('member_id', $request->member_id)
            ->where('group_id', $request->group_id)
            ->where('position', $request->position)
            ->delete();

        return $isDelete;
    }


    public function updateGroupMember($request)
    {

        $groupMember = GroupMember::whereId($request->id)->first();

        $isUpdate = $groupMember->update($request->input());

        return $isUpdate;
    }


    public function updateMember($request){

        $user = Member::whereId($request->id)->first();

        $isExists = Member::whereLogin($request->login)
            ->where('id', '!=', $request->id)
            ->exists();

        if ($isExists){
            $this->stdClass->message = 'Участник с таком логином уже есть';
            return new BasicErrorResource($this->stdClass);
        }

        $user->update($request->input());

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('members', 'public');
        }

        if (!empty($request->input('password'))) {
            $user->password_visible = $request['password'];
            $user->password = app('hash')->make($request['password']);
        }

        $isUpdate = $user->update();

        return $isUpdate;

    }

    public function deleteMember($request){

        $adminId = \Auth::user()->id;

        $isDelete = Member::whereId($request->input('id'))
            ->whereAdminId($adminId)
            ->delete();

        return $isDelete;

    }
}
