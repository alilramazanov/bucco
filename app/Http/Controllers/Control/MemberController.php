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
use Illuminate\Http\Request;

class MemberController extends BaseController
{
        /**
         * @var $MembersRepository
         */

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

        return $this->membersRepository->getAdminMemberList($request);

    }

    public function groupMemberList(GroupMemberListRequest $request){

        return $this->membersRepository->getGroupMemberList($request);

    }

    public function detailGroupMember(DetailGroupMemberRequest $request)
    {
        return $this->membersRepository->detailGroupMember($request);
    }

    public function updateGroupMember(UpdateGroupMemberRequest $request)
    {
        return $this->memberLoader->updateGroupMember($request);
    }


    public function createMemberInGroup(CreateMemberInGroupRequest $request){

       $isCreate = $this->memberLoader->createMemberInGroup($request);

        if ($isCreate === null){
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

        return $this->memberLoader->unsertMemberFromGroup($request);

    }

    public function detail(DetailMemberRequest $request)
    {
        return $this->membersRepository->detailMember($request);
    }

    public function update(UpdateMemberRequest $request){

        return $this->memberLoader->updateMember($request);
    }

    public function delete(DetailMemberRequest $request){

        return $this->memberLoader->deleteMember($request);

    }


}
