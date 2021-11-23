<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Loader\Control\MemberLoader;
use App\Http\Loader\Control\TaskLoader;
use App\Http\Repositories\Control\GroupRepository;
use App\Http\Repositories\Control\MemberTaskRepository;
use App\Http\Requests\Control\Members\MemberTasksRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class MemberTaskController extends Controller
{

    /**
     * @var \Laravel\Lumen\Application|mixed
     */
    protected $memberTaskRepository;
    protected $memberTaskLoader;
    protected $groupRepository;

    /**
     * MemberTaskController constructor
     */
    public function __construct()
    {
        $this->memberTaskLoader = app(TaskLoader::class);
        $this->memberTaskRepository = app(MemberTaskRepository::class);
        $this->groupRepository = app(GroupRepository::class);
        $this->middleware('auth:member');
    }

    /**
     * @param MemberTasksRequest $request
     * @return mixed
     */
    public function taskList(MemberTasksRequest $request)
    {
        return $this->memberTaskRepository->getTaskListInGroup($request);
    }

    public function updateStatusTask(Request $request){

        return $this->memberTaskLoader->updateStatusTask($request);

    }

    public function memberGroupList(Request $request){



        return $this->groupRepository->getMemberGroup();

    }

}
