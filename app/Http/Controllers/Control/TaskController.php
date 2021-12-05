<?php

namespace App\Http\Controllers\Control;

use App\Http\Loader\Control\TaskLoader;
use App\Http\Repositories\Control\TaskRepository;
use App\Http\Requests\Control\Tasks\CreateTaskRequest;
use App\Http\Requests\Control\Tasks\DetailTaskRequest;
use App\Http\Requests\Control\Tasks\GroupTaskListRequest;
use App\Http\Requests\Control\Tasks\MemberTaskListRequest;
use App\Http\Requests\Control\Tasks\UpdateTaskRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Jobs\NotificationStartTimeJob;
use App\Jobs\NotificationStartWorkingJob;
use App\Jobs\Task\EndOfTaskJob;
use App\Jobs\Task\MinutesBeforeTheEndJob;
use App\Models\Member;
use App\Models\Task;
use App\Resources\Control\Notification\Admin\AdminNotification;
use App\Resources\Control\Notification\Member\MemberNotification;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class TaskController extends BaseController
{

    /**
     * @var TaskRepository $taskRepository
     * @var \stdClass $stdClass
     */
    protected $taskRepository;
    protected $taskLoaderObject;
    protected $adminNotification;
    protected $memberNotification;
    protected $stdClass;



    //                                              GET методы


    public function __construct()
    {
        parent::__construct();
        $this->taskRepository = app(TaskRepository::class);
        $this->taskLoaderObject = app(TaskLoader::class);
        $this->memberNotification = app(MemberNotification::class);
        $this->adminNotification = app(AdminNotification::class);
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

        $this->memberNotification->createTask($memberNotificationId);

        $newTask = $this->taskLoaderObject->createTask($request);

        \Queue::later(Carbon::parse($request->get('start_at')), new NotificationStartTimeJob($memberNotificationId));
        \Queue::later(Carbon::parse($request->get('start_at'))->addMinutes(2), new NotificationStartWorkingJob($newTask, $memberNotificationId));
        \Queue::later(Carbon::parse($request->get('end_at'))->subMinutes(2), new MinutesBeforeTheEndJob($memberNotificationId));
        \Queue::later(Carbon::parse($request->get('end_at')), new EndOfTaskJob($newTask, $memberNotificationId));

        if ($newTask === null){
            $stdClass->message = 'Задача успешно создана';
            return new SuccessResource($stdClass);
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

}
