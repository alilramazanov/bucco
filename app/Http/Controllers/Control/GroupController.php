<?php

namespace App\Http\Controllers\Control;


use App\Http\Loader\Control\GroupLoader;
use App\Http\Repositories\Control\GroupRepository;
use App\Http\Requests\Control\Groups\AddMemberRequest;
use App\Http\Requests\Control\Groups\CreateGroupRequest;
use App\Http\Requests\Control\Groups\GroupListRequest;
use App\Http\Requests\Control\Groups\UnsertMemberRequest;
use App\Http\Requests\Control\Groups\UpdateGroupRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\PositionTemplate;
use GrahamCampbell\ResultType\Success;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class GroupController extends BaseController
{
    /**
     * @var GroupRepository
     */
    protected $groupRepository;
    protected $groupLoaderObject;

    public function __construct()
    {
        parent::__construct();
        $this->groupRepository = app(GroupRepository::class);
        $this->groupLoaderObject = app(GroupLoader::class);
    }

    public function list(GroupListRequest $request)
    {

        $groupList = $this->groupRepository->getGroupList($request);

        if ($groupList->isEmpty()) {
            throw new BadRequestException('Группы не найдены', 404);
        }

        return $groupList;
    }

    public function statisticList(GroupListRequest $request)
    {

        $groupList = $this->groupRepository->getGroupStatisticList($request);

        if ($groupList->isEmpty()) {
            throw new BadRequestException('Группы не найдены', 404);
        }

        return $groupList;

    }


    //                  POST методы таблицы groups


    public function create(CreateGroupRequest $request)
    {

        return $this->groupLoaderObject->createGroup($request);

    }


    public function update(UpdateGroupRequest $request)
    {

        return $this->groupLoaderObject->updateGrup($request);

    }

    public function delete(UpdateGroupRequest $request)
    {


        return $this->groupLoaderObject->deleteGroup($request);


    }





//                      POST методы таблицы group_members


    public function addMember(AddMemberRequest $request)
    {

        return $this->groupLoaderObject->addMemberInGroup($request);


    }

    public function unsertMember(UnsertMemberRequest $request){


        return $this->groupLoaderObject->unsertMemberFromGroup($request);


    }


}




