<?php

namespace App\Http\Controllers\Control;

use App\Http\Loader\Control\TaskLoader;
use App\Http\Repositories\Control\TaskRepository;
use App\Http\Requests\Control\Tasks\CreateTaskRequest;
use App\Http\Requests\Control\Tasks\DetailTaskRequest;
use App\Http\Requests\Control\Tasks\GroupTaskListRequest;
use App\Http\Requests\Control\Tasks\MemberTaskListRequest;
use App\Http\Requests\Control\Tasks\UpdateTaskRequest;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Jobs\NotificationStartTimeJob;
use App\Jobs\NotificationStartWorkingJob;
use App\Jobs\Task\EndOfTaskJob;
use App\Jobs\Task\MinutesBeforeTheEndJob;
use App\Models\Task;
use App\Resources\Control\Notification\Member\MemberNotification;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class TaskController extends BaseController
{

    /**
     * @var TaskRepository
     */
    protected $taskRepository;
    protected $taskLoaderObject;
    protected $notification;



    //                                              GET методы

    public function __construct()
    {
        parent::__construct();
        $this->taskRepository = app(TaskRepository::class);
        $this->taskLoaderObject = app(TaskLoader::class);
        $this->notification = app(MemberNotification::class);
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

    public function create(CreateTaskRequest $request){
        $stdClass = new \stdClass();
        $userId = 'userNotify';

        $this->notification->createTask($userId);

        $isCreate = $this->taskLoaderObject->createTask($request); // Получаем id задачи
//
//        \Queue::later(Carbon::parse($request->get('start_at')), new NotificationStartTimeJob());
//        \Queue::later(Carbon::parse($request->get('start_at'))->addMinutes(1), new NotificationStartWorkingJob($isCreate));
//        \Queue::later(Carbon::parse($request->get('end_at'))->subMinutes(1), new MinutesBeforeTheEndJob());
//        \Queue::later(Carbon::parse($request->get('end_at')), new EndOfTaskJob($isCreate));

        if ($isCreate){
            $stdClass->message = 'Задача успешно создана';
            return new SuccessResource($stdClass);
        }

    }


    public function update(UpdateTaskRequest $request){
        $userId = 'userNotify';
        $name = Task::whereId($request->input('id'))->first()->name;
        $this->notification->updateTask($userId, $name);

        return $this->taskLoaderObject->updateTask($request);

    }


    public function delete(DetailTaskRequest $request){

        return $this->taskLoaderObject->deleteTask($request);

    }

}
