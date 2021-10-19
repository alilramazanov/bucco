<?php

namespace App\Http\Controllers\Control;


use App\Http\Repositories\Control\GroupRepository;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\Control\Group\GroupListRequest;

use Illuminate\Http\Request;
use Urameshibr\Requests\FormRequest;

class GroupController extends BaseController
{
    /**
     * @var GroupRepository
     */
    private $groupRepository;

    public function __construct (){
        parent::__construct();
        $this->groupRepository = app(GroupRepository::class);
    }


    public function list(GroupListRequest $request){



        return $this->groupRepository->getGroupList($request);

    }


}
