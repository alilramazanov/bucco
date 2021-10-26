<?php

namespace App\Http\Controllers\Control;


use App\Http\Repositories\Control\GroupRepository;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\Control\Groups\GroupListRequest;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
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

        $groupList = $this->groupRepository->getGroupList($request);

        if ($groupList->isEmpty()) {
            throw new BadRequestException('Группы не найдены', 404);
        }

        return  $groupList;
    }

    public function statisticList(GroupListRequest $request){

        $groupList = $this->groupRepository->getGroupStatisticList($request);

        if ($groupList->isEmpty()) {
            throw new BadRequestException('Группы не найдены', 404);
        }

        return  $groupList;

    }


}
