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
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class TaskController extends BaseController
{

    /**
     * @var TaskRepository
     */
    protected $taskRepository;
    protected $taskLoaderObject;



    //                                              GET методы

    public function __construct()
    {
        parent::__construct();
        $this->taskRepository = app(TaskRepository::class);
        $this->taskLoaderObject = app(TaskLoader::class);
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
            $stdClass = new \stdClass();
            $stdClass->message = 'Задачи участника не найдены';
            return new BasicErrorResource($stdClass);
        }

        return $memberTasks;

    }



    //                                        ПОСТ МЕТОДЫ

    public function create(CreateTaskRequest $request){

        return $this->taskLoaderObject->createTask($request);

    }


    public function update(UpdateTaskRequest $request){

        return $this->taskLoaderObject->updateTask($request);

    }


    public function delete(DetailTaskRequest $request){

        return $this->taskLoaderObject->deleteTask($request);

    }

}
