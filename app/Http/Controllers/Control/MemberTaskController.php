<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Loader\Control\MemberLoader;
use App\Http\Loader\Control\TaskLoader;
use App\Http\Repositories\Control\GroupRepository;
use App\Http\Repositories\Control\MemberTaskRepository;
use App\Http\Repositories\Control\TaskRepository;
use App\Http\Requests\Control\Members\MemberTasksRequest;
use App\Models\Group;
use App\Resources\Control\Notification\Admin\AdminNotification;
use Illuminate\Http\Request;

class MemberTaskController extends Controller
{

    /**
     * @var \Laravel\Lumen\Application|mixed
     */
    protected $memberTaskRepository;
    protected $taskLoader;
    protected $groupRepository;
    protected $notification;
    protected $taskRepository;

    /**
     * MemberTaskController constructor
     */
    public function __construct()
    {
        $this->taskLoader = app(TaskLoader::class);
        $this->memberTaskRepository = app(MemberTaskRepository::class);
        $this->groupRepository = app(GroupRepository::class);
        $this->notification = app(AdminNotification::class);
        $this->taskRepository = app(TaskRepository::class);

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

        $userId = 'adminNotification';
        $this->notification->updateStatusTask( $request->input('task_status_id'), $userId);

        return $this->taskLoader->updateStatusTask($request);

    }

    public function memberGroupList(Request $request){
        return $this->groupRepository->getMemberGroup();

    }

    public function memberTaskList(Request $request){

        return $this->taskRepository->getAdminMemberTaskList($request->input('task_status_id'));

    }

}
