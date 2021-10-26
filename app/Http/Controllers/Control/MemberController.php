<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Control\MemberRepository;
use App\Http\Requests\Control\Members\AdminMemberListRequest;
use App\Http\Requests\Control\Members\GroupMemberListRequest;
use App\Http\Requests\Control\Members\MemberRequest;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MemberController extends BaseController
{
        /**
         * @var $MembersRepository
         */

    private $membersRepository;

    public function __construct(){
        parent::__construct();
        $this->membersRepository = app(MemberRepository::class);
    }

    public function adminMemberList(AdminMemberListRequest $request){

        $adminMembers = $this->membersRepository->getAdminMemberList($request);

        if ($adminMembers === null) {
            throw new BadRequestException('участники админа не найдены', 404);
        }

        return $adminMembers;

    }

    public function groupMemberList(GroupMemberListRequest $request){
        $groupMembers = $this->membersRepository->getGroupMemberList($request);

        if ($groupMembers === null) {
            throw new BadRequestException('участники группы не найдены', 404);
        }

        return $groupMembers;


    }













}
