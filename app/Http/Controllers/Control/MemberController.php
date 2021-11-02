<?php

namespace App\Http\Controllers\Control;

use App\Http\Loader\Control\MemberLoader;
use App\Http\Repositories\Control\MemberRepository;
use App\Http\Requests\Control\Groups\UnsertMemberRequest;
use App\Http\Requests\Control\Members\AdminMemberListRequest;
use App\Http\Requests\Control\Members\CreateMemberRequest;
use App\Http\Requests\Control\Members\GroupMemberListRequest;
use App\Http\Requests\Control\Members\UpdateMemberRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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
    }

    public function adminMemberList(AdminMemberListRequest $request){

        $adminMembers = $this->membersRepository->getAdminMemberList($request);

        if ($adminMembers === null) {
            $this->stdClass->message = 'Участники админа не найдены';
            return new BasicErrorResource($this->stdClass);
        }

        return $adminMembers;

    }

    public function groupMemberList(GroupMemberListRequest $request){

        $groupMembers = $this->membersRepository->getGroupMemberList($request);

        if ($groupMembers === null) {
            $this->stdClass->message = 'Участники группы не найдены';
            return new BasicErrorResource($this->stdClass);
        }

        return $groupMembers;


    }


    public function create (CreateMemberRequest $request){

        return $this->memberLoader->createMemberInGroup($request);

    }

    public function unsert(UnsertMemberRequest $request){


        return $this->memberLoader->unsertMemberFromGroup($request);


    }


    public function update(UpdateMemberRequest $request){

        return $this->memberLoader->updateMember($request);
    }

    public function delete(UpdateMemberRequest $request){

        $this->memberLoader->deleteMember($request);

    }

}
