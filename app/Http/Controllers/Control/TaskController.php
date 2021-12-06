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
use App\Models\Member;
use App\Models\Task;
use App\Resources\Control\Notification\Admin\AdminNotification;
use App\Resources\Control\Notification\Member\MemberNotification;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class TaskController extends BaseController
{

    /**
     * @var TaskRepository $taskRepository
     * @var \stdClass $stdClass
     * @var TaskLoader $taskLoaderObject
     */
    protected $taskRepository;
    protected $taskLoaderObject;
    protected $adminNotification;
    protected $memberNotification;
    protected $stdClass;
    protected $createTaskAction;



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
            throw new BadRequestException('Задачи группы не найдены', 404);
        }

        return $groupTasks;

    }

    public function memberTaskList(MemberTaskListRequest $request){

        $memberTasks = $this->taskRepository->getMemberTaskList($request);

        if ($memberTasks->isEmpty()) {
            throw new BadRequestException('Задачи участника не найдены', 404);
        }

        return $memberTasks;

    }



    //                                        ПОСТ МЕТОДЫ

    /**
     * @param CreateTaskRequest $request
     * @return BasicErrorResource|SuccessResource
     * @var Task $isCreate
     */
    public function create(CreateTaskRequest $request){

        $stdClass = new \stdClass();
        $memberNotificationId = Member::find($request->input('member_id'))->user_notification_id;

        $newTask = $this->taskLoaderObject->createTask($request);

        $this->createTaskAction->addAJob($request, $newTask, $memberNotificationId);

        if (!($newTask === null)){
            $stdClass->message = 'Задача успешно создана';
            return new SuccessResource($stdClass);
            $this->memberNotification->createTask($memberNotificationId);
        }

        $stdClass->message = 'Ошибка создания задачи';
        return new BasicErrorResource($stdClass);

    }


    /**
     * @param UpdateTaskRequest $request
     * @return mixed
     * @var Task $task
     *
     *
     */
    public function update(UpdateTaskRequest $request){

        $task = Task::whereId($request->input('id'))->first();
        $memberNotificationId = Member::find($task->member_id)->login;

        $name = $task->name;

        $this->memberNotification->updateTask($memberNotificationId, $name);

        $isUpdate = $this->taskLoaderObject->updateTask($request);

        if ($isUpdate){
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



        if (!($newReturnTask === null)){
            $this->stdClass->message = 'Задача успешно возвращена';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка возвращения задачи';
        return new BasicErrorResource($this->stdClass);

    }


}
