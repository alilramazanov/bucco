<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Control\MemberRepository;
use App\Http\Requests\Control\Members\GroupMemberListRequest;
use App\Http\Requests\Control\Members\MemberRequest;

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






}
