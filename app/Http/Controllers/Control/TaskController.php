<?php

namespace App\Http\Controllers\Control;

use App\Http\Loader\Control\TaskLoader;
use App\Http\Repositories\Control\TaskRepository;
use App\Http\Requests\Control\Tasks\CreateTaskRequest;
use App\Http\Requests\Control\Tasks\DetailTaskRequest;
use App\Http\Requests\Control\Tasks\GroupTaskListRequest;
use App\Http\Requests\Control\Tasks\MemberTaskListRequest;
use App\Http\Requests\Control\Tasks\UpdateTaskRequest;
use App\Models\Task;
use App\Resources\Control\Notification\Admin\AdminNotificationCore;
use OneSignal;
use App\Http\Resources\Control\Common\BasicErrorResource;
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
        $this->notification = app(AdminNotificationCore::class);
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
        $userId = 'userNotification';

        $this->notification->createTask($userId);
        return $this->taskLoaderObject->createTask($request);

    }


    public function update(UpdateTaskRequest $request){
        $userId = 'userNotification';
        $name = Task::whereId($request->input('id'))->first()->name;
        $this->notification->updateTask($userId, $name);

        return $this->taskLoaderObject->updateTask($request);

    }


    public function delete(DetailTaskRequest $request){

        return $this->taskLoaderObject->deleteTask($request);

    }

}
