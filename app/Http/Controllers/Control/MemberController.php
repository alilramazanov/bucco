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
        return $this->memberLoader->detailGroupMember($request);
    }

    public function updateGroupMember(UpdateGroupMemberRequest $request)
    {
        return $this->memberLoader->updateGroupMember($request);
    }


    public function create (CreateMemberInGroupRequest $request){

        return $this->memberLoader->createMemberInGroup($request);

    }

    public function createMember(CreateMemberRequest $request)
    {
        return $this->memberLoader->createMember($request);
    }

    public function unsert(UnsertMemberRequest $request){

        return $this->memberLoader->unsertMemberFromGroup($request);

    }

    public function detail(DetailMemberRequest $request)
    {
        return $this->memberLoader->detailMember($request);
    }

    public function update(UpdateMemberRequest $request){

        return $this->memberLoader->updateMember($request);
    }

    public function delete(DetailMemberRequest $request){

        return $this->memberLoader->deleteMember($request);

    }

}
