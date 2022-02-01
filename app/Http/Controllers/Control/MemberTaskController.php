<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Loader\Control\TaskLoader;
use App\Http\Repositories\Control\GroupRepository;
use App\Http\Repositories\Control\MemberTaskRepository;
use App\Http\Repositories\Control\TaskRepository;
use App\Http\Requests\Control\Members\MemberTasksRequest;
use App\Http\Requests\Control\Tasks\MemberTaskListRequest;
use App\Http\Requests\Control\Tasks\UpdateTaskStatusRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Http\Resources\Control\Member\AdminPhoneResource;
use App\Http\Resources\Control\Task\MemberTasksResource;
use App\Models\Admin;
use App\Models\Member;
use App\Models\Task;
use App\Resources\Control\Notification\Admin\AdminNotification;
use Illuminate\Http\Request;

class MemberTaskController extends Controller
{

    /**
     * @var \Laravel\Lumen\Application|mixed
     */
    protected $memberTaskRepository;

    /**
     * @var TaskLoader
     */
    protected $taskLoader;
    protected $groupRepository;
    protected $adminNotification;
    protected $taskRepository;

    protected $stdClass;
    /**
     * MemberTaskController constructor
     */
    public function __construct()
    {
        $this->taskLoader = app(TaskLoader::class);
        $this->memberTaskRepository = app(MemberTaskRepository::class);
        $this->groupRepository = app(GroupRepository::class);
        $this->adminNotification = app(AdminNotification::class);
        $this->taskRepository = app(TaskRepository::class);
        $this->stdClass = app(\stdClass::class);

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

    public function updateStatusTask(UpdateTaskStatusRequest $request){

        $adminNotificationId = Admin::find(Task::find($request->id)->member->admin_id)->admin_notification_id;
        $adminOnesignalApp = Admin::find(Task::find($request->id)->member->admin_id)->onesignal_app;

        $notificationParameters = [
          'onesignalApp' => $adminOnesignalApp,
          'notificationId' => $adminNotificationId
        ];

        $this->adminNotification->updateStatusTask($notificationParameters, $request->task_status_id);

        $isUpdate = $this->taskLoader->updateStatusTask($request);

        if ($isUpdate){
            $this->stdClass->message = 'Статус успешно обновлен';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка обновления';
        return new BasicErrorResource($this->stdClass);

    }

    public function memberGroupList(){
        return $this->groupRepository->getMemberGroup();

    }

    public function memberTaskList(MemberTaskListRequest $request){

        $memberTaskList = $this->taskRepository->getAdminMemberTaskList($request->input('task_status_id'));

        return MemberTasksResource::collection($memberTaskList);

    }

    public function getAdminPhone(){
        $memberId = \Auth::guard('member')->user()->id;
        $member = Member::query()
            ->where('id', $memberId)
            ->first();

        return new AdminPhoneResource($member->admin);


    }

}
