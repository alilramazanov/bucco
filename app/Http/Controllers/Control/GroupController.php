<?php

namespace App\Http\Controllers\Control;


use App\Http\Loader\Control\GroupLoader;
use App\Http\Repositories\Control\GroupRepository;
use App\Http\Requests\Control\Groups\AddMemberRequest;
use App\Http\Requests\Control\Groups\CreateGroupRequest;
use App\Http\Requests\Control\Groups\DetailGroupRequest;
use App\Http\Requests\Control\Groups\UpdateGroupRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Group\GroupListResource;
use App\Http\Resources\Control\Group\GroupStatisticListResource;
use Illuminate\Http\Request;
use OneSignal;

class GroupController extends BaseController
{
    /**
     * @var GroupRepository
     */
    protected $groupRepository;
    protected $groupLoaderObject;
    private $stdClass;

    public function __construct()
    {
        parent::__construct();
        $this->groupRepository = app(GroupRepository::class);
        $this->groupLoaderObject = app(GroupLoader::class);
        $this->stdClass = new \stdClass();
        $this->middleware('auth');
    }

    public function list(Request $request)
    {
        $groups = $this->groupRepository->getGroupList($request);



        if ($groups->isEmpty()) {
            $this->stdClass->message = 'Группы не найдены';
            return new BasicErrorResource($this->stdClass);
        }

        return GroupListResource::collection($groups);

    }

    public function statisticList(Request $request)
    {

        $groups = $this->groupRepository->getGroupStatisticList($request);

        if ($groups->isEmpty()) {
            $this->stdClass->message = 'Группы не найдены';
            return new BasicErrorResource($this->stdClass);
        }

        return GroupStatisticListResource::collection($groups);

    }




    public function create(CreateGroupRequest $request)
    {
        return $this->groupLoaderObject->createGroup($request);
    }

    public function detail(DetailGroupRequest $request)
    {
        return $this->groupLoaderObject->detailGroup($request);
    }


    public function update(UpdateGroupRequest $request)
    {
        return $this->groupLoaderObject->updateGroup($request);
    }

    public function delete(DetailGroupRequest $request)
    {
        return $this->groupLoaderObject->deleteGroup($request);
    }





//                      POST методы таблицы group_members


    public function addMember(AddMemberRequest $request)
    {
        return $this->groupLoaderObject->addMemberInGroup($request);
    }




}




