<?php

namespace App\Http\Controllers\Control;

use App\Http\Action\Control\Task\CreateTaskAction;
use App\Http\Loader\Control\TaskLoader;
use App\Http\Repositories\Control\TaskRepository;
use App\Http\Requests\Control\Tasks\CreateTaskRequest;
use App\Http\Requests\Control\Tasks\DetailTaskRequest;
use App\Http\Requests\Control\Tasks\GroupTaskListRequest;
use App\Http\Requests\Control\Tasks\MemberTaskListRequest;
use App\Http\Requests\Control\Tasks\UpdateTaskRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Http\Resources\Control\Task\GroupTasksResource;
use App\Models\Member;
use App\Models\Task;
use App\Resources\Control\Notification\Admin\AdminNotification;
use App\Resources\Control\Notification\Member\MemberNotification;
use App\Resources\Control\Notification\NotificationCoreSingleton;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class TaskController extends BaseController
{


    /**
     * @var \Laravel\Lumen\Application|mixed
     * @var TaskRepository $taskRepository
     */
    protected $taskRepository;
    protected $taskLoaderObject;
    protected $adminNotification;
    protected $memberNotification;
    protected $createTaskAction;

    protected $stdClass;


    //                                              GET методы


    public function __construct()
    {
        parent::__construct();
        $this->taskRepository = app(TaskRepository::class);
        $this->taskLoaderObject = app(TaskLoader::class);
        $this->memberNotification = app(MemberNotification::class);
        $this->adminNotification = app(AdminNotification::class);
        $this->createTaskAction = app(CreateTaskAction::class);
        $this->stdClass = app(\stdClass::class);
        $this->middleware('auth');
    }


    public function groupTaskList(GroupTaskListRequest $request){

       $groupTasks = $this->taskRepository->getGroupTaskList($request);

        if ($groupTasks->isEmpty()) {
            $this->stdClass->message = 'Задачи группы не найдены';
            return new SuccessResource($this->stdClass);
        }

        return GroupTasksResource::collection($groupTasks);

    }

    public function memberTaskList(MemberTaskListRequest $request){

        $memberTasks = $this->taskRepository->getMemberTaskList($request);

        if ($memberTasks->isEmpty()) {
            $this->stdClass->message = 'Задачи участника не найдены';
            return new SuccessResource($this->stdClass);
        }

        return $memberTasks;

    }





    /**
     * @param CreateTaskRequest $request
     * @return BasicErrorResource|SuccessResource
     * @var Task $isCreate
     */
    public function create(CreateTaskRequest $request){


        $memberId = $request->get('member_id');
        $isExistStartTaskTime = Task::query()
            ->where('member_id', $memberId)
            ->where('group_id', $request->get('group_id'))
            ->where('start_at', $request->get('start_at'))
            ->whereIn('task_status_id', [1,2])
            ->exists();

        if ($isExistStartTaskTime){
            $this->stdClass->message = 'Задача на это время уже существует';
            return new BasicErrorResource($this->stdClass);
        }


        $isStartTaskTimeBusy = Task::query()
            ->where('member_id', $memberId)
            ->where('group_id', $request->get('group_id'))
            ->whereBetween('start_at', [$request->get('start_at'), $request->get('end_at') ])
            ->whereIn('task_status_id', [1,2])
            ->exists();



        if ($isStartTaskTimeBusy){
            $this->stdClass->message = 'Время окончания или начала конфликтует с другой задачей';
            return new BasicErrorResource($this->stdClass);

        }

        $isEndTaskTimeBusy = Task::query()
            ->where('member_id', $memberId)
            ->where('group_id', $request->get('group_id'))
            ->whereBetween('end_at', [$request->get('start_at'), $request->get('end_at') ])
            ->whereIn('task_status_id', [1,2])
            ->exists();



        if ($isEndTaskTimeBusy){
            $this->stdClass->message = 'Время начала или окончания конфликтует с другой задачей';
            return new BasicErrorResource($this->stdClass);

        }




        $newTask = $this->taskLoaderObject->createTask($request);


        $memberNotificationId = Member::find($request->member_id)->user_notification_id;
        $memberOnesignalApp = Member::find($request->member_id)->onesignal_app;
        $memberNotificationParameters = [
            'onesignalApp' => $memberOnesignalApp,
            'notificationId' => $memberNotificationId
        ];


        $this->createTaskAction->addAJob($newTask, $memberNotificationParameters);




        if (!($newTask === null)){
            $this->stdClass->message = 'Задача успешно создана';
            $this->memberNotification->createTask($memberNotificationParameters);
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка создания задачи';
        return new BasicErrorResource($this->stdClass);

    }


    /**
     * @param UpdateTaskRequest $request
     * @return mixed
     * @var Task $task
     *
     *
     */
    public function update(UpdateTaskRequest $request){

        $updateTask = Task::whereId($request->get('id'))->first();
        $isDelete  = Task::whereId($request->get('id'))->first()->delete();

        $memberId = $updateTask->member_id;
        $groupId = $updateTask->group_id;

        $isExistStartTaskTime = Task::query()
            ->where('member_id', $memberId)
            ->where('group_id', $groupId)
            ->where('start_at', $request->get('start_at'))
            ->whereIn('task_status_id', [1,2])
            ->exists();

        if ($isExistStartTaskTime){
            $this->stdClass->message = 'Задача на это время уже существует';
            return new BasicErrorResource($this->stdClass);
        }



        $isStartTaskTimeBusy = Task::query()
            ->where('member_id', $memberId)
            ->where('group_id', $groupId)
            ->whereBetween('start_at', [$request->get('start_at'), $request->get('end_at') ])
            ->whereIn('task_status_id', [1,2])
            ->exists();


        if ($isStartTaskTimeBusy){
            $this->stdClass->message = 'Время окончания или начала конфликтует с другой задачей';
            return new BasicErrorResource($this->stdClass);

        }

        $isEndTaskTimeBusy = Task::query()
            ->where('member_id', $memberId)
            ->where('group_id', $groupId)
            ->whereBetween('end_at', [$request->get('start_at'), $request->get('end_at') ])
            ->whereIn('task_status_id', [1,2])
            ->exists();



        if ($isEndTaskTimeBusy){
            $this->stdClass->message = 'Время начала или окончания конфликтует с другой задачей';
            return new BasicErrorResource($this->stdClass);

        }




        $memberNotificationId = Member::find($updateTask->member_id)->user_notification_id;
        $memberOnesignalApp = Member::find($updateTask->member_id)->onesignal_app;
        $memberNotificationParameters = [
            'onesignalApp' => $memberOnesignalApp,
            'notificationId' => $memberNotificationId
        ];


        $this->memberNotification->updateTask($memberNotificationParameters);


        $updateTask->start_at = $request->get('start_at') === null ? $updateTask->start_at : $request->get('start_at');
        $updateTask->end_at = $request->get('end_at') === null ? $updateTask->end_at : $request->get('end_at');


        $task = collect([
           'name' => $updateTask->name,
            'description' => $updateTask->description,
            'admin_id' => $updateTask->admin_id,
            'group_id' => $updateTask->group_id,
            'member_id' => $updateTask->member_id,
            'start_at' => $updateTask->start_at,
            'end_at' => $updateTask->end_at
        ]);



        $newTask = Task::create($task->toArray());

        $this->createTaskAction->addAJob($updateTask, $memberNotificationParameters);
        if (!($newTask === null)){
            $this->stdClass->message = 'Задача успешно обновлена';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->messge = 'Ошибка обновления задачи';
        return new BasicErrorResource($this->stdClass);

    }


    public function delete(DetailTaskRequest $request){

        $isDelete = $this->taskLoaderObject->deleteTask($request);

        if ($isDelete){
            $this->stdClass->message = 'Задача успешно удалена';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка удаления задачи';
        return new BasicErrorResource($this->stdClass);

    }

    public function returnTask(DetailTaskRequest $request){


        $newReturnTask = $this->taskLoaderObject->returnTask($request);

        $memberNotificationId = Member::find($newReturnTask->member_id)->user_notification_id;
        $memberOnesignalApp = Member::find($newReturnTask->member_id)->onesignal_app;

        $memberNotificationParameters = [
            'onesignalApp' => $memberOnesignalApp,
            'notificationId' => $memberNotificationId
        ];



        $this->memberNotification->createTask($memberNotificationParameters);

        $this->createTaskAction->addAJob($newReturnTask, $memberNotificationParameters);

        $this->taskLoaderObject->deleteTask($request);


        if (!($newReturnTask === null)){
            $this->stdClass->message = 'Задача успешно возвращена';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка возвращения задачи';
        return new BasicErrorResource($this->stdClass);

    }
}
