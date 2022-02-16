<?php

namespace App\Http\Controllers\Control;

use App\Http\Loader\Control\MemberLoader;
use App\Http\Repositories\Control\MemberRepository;
use App\Http\Requests\Control\Groups\UnsertMemberRequest;
use App\Http\Requests\Control\Members\CreateMemberInGroupRequest;
use App\Http\Requests\Control\Members\CreateMemberRequest;
use App\Http\Requests\Control\Members\DetailGroupMemberRequest;
use App\Http\Requests\Control\Members\DetailMemberRequest;
use App\Http\Requests\Control\Members\GroupMemberListRequest;
use App\Http\Requests\Control\Members\UpdateGroupMemberRequest;
use App\Http\Requests\Control\Members\UpdateMemberRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Http\Resources\Control\Member\AdminMemberListResource;
use App\Http\Resources\Control\Member\AdminPhoneResource;
use App\Http\Resources\Control\Member\DetailGroupMemberResource;
use App\Http\Resources\Control\Member\DetailMemberResource;
use App\Http\Resources\Control\Member\GroupMemberListResource;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends BaseController
{

    protected $membersRepository;
    protected $memberLoader;
    private $stdClass;



    public function __construct(){

        parent::__construct();
        $this->membersRepository = app(MemberRepository::class);
        $this->memberLoader = app(MemberLoader::class);
        $this->stdClass = app(\stdClass::class);
        $this->middleware('auth');
    }

    public function adminMemberList(Request $request){

       $adminMemberList = $this->membersRepository->getAdminMemberList($request);

       if ($adminMemberList == null){
           $this->stdClass->message = 'Участников админа нет';
           return new SuccessResource($this->stdClass);
       }

       return AdminMemberListResource::collection($adminMemberList);

    }

    public function groupMemberList(GroupMemberListRequest $request){

        $groupMemberList = $this->membersRepository->getGroupMemberList($request);

        if ($groupMemberList == null){
            $this->stdClass->message = 'Участников группы нет';
            return new SuccessResource($this->stdClass);
        }

        return GroupMemberListResource::collection($groupMemberList);

    }

    public function detailGroupMember(DetailGroupMemberRequest $request)
    {
        $groupMember = $this->membersRepository->detailGroupMember($request);

        return new DetailGroupMemberResource($groupMember);

    }


    public function detail(DetailMemberRequest $request)
    {
        $member = $this->membersRepository->detailMember($request);

        return new DetailMemberResource($member);

    }


    public function updateGroupMember(UpdateGroupMemberRequest $request)
    {
        $isUpdate = $this->memberLoader->updateGroupMember($request);

        if ($isUpdate){
            $this->stdClass->message = 'Участник группы успешно обновлен';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка обновления участника группы';
        return new BasicErrorResource($this->stdClass);

    }


    public function createMemberInGroup(CreateMemberInGroupRequest $request){


        // Проверка на существования участника с вводимым логином и создание участника
        $isExists = Member::whereLogin($request->input('login'))->exists();

        if ($isExists){
            $this->stdClass->message = 'Пользователь с таким логином уже существует';
            return new BasicErrorResource($this->stdClass);
        }

       $newMember = $this->memberLoader->createMemberInGroup($request);

        if (!($newMember == null)){
            $this->stdClass->message = 'Участник успешно создан и добавлен в группу';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка в создании участника ';
        return new BasicErrorResource($this->stdClass);

    }

    public function createMember(CreateMemberRequest $request)
    {
        $isCreateMember = $this->memberLoader->createMember($request);
        if ($isCreateMember) {
        $this->stdClass->message = 'Пользователь успешно создан';
        return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка при создании пользователя';
        return new BasicErrorResource($this->stdClass);
    }

    public function unsert(UnsertMemberRequest $request){

        $isDelete = $this->memberLoader->unsertMemberFromGroup($request);

        if ($isDelete){
            $this->stdClass->message = 'Участник успешно удален из группы';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка удаления участника';
        return new BasicErrorResource($this->stdClass);

    }

    public function update(UpdateMemberRequest $request){

        $isUpdate = $this->memberLoader->updateMember($request);

        if ($isUpdate){
            $this->stdClass->message = 'Участник успешно обновлен';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка обновления участника';
        return new BasicErrorResource($this->stdClass);

    }

    public function delete(DetailMemberRequest $request){

        $isDelete = $this->memberLoader->deleteMember($request);

        if ($isDelete){
            $this->stdClass->message = 'Участник успешно удален';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка удаления участника';
        return new BasicErrorResource($this->stdClass);

    }

    public function updateAdmin(Request $request){

        $admin = Admin::whereId(\Auth::user()->id)->first();

        $isUpdate = $admin->update($request->input());

        if ($isUpdate){
            $this->stdClass->message = 'Админ успешно обновлен';
            return new SuccessResource($this->stdClass);
        }


    }


}
