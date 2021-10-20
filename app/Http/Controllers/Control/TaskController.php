<?php

namespace App\Http\Controllers\Control;

use App\Http\Repositories\Control\TaskRepository;
use App\Http\Requests\Control\Groups\AllGroupTasksRequest;
use App\Http\Requests\Control\Tasks\GroupTaskListRequest;
use App\Http\Requests\Control\Tasks\MemberTaskListRequest;
use App\Http\Requests\Control\Tasks\TaskRequest;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class TaskController extends BaseController
{

    /**
     * @var TaskRepository
     */
    private $taskRepository;


    public function __construct()
    {
        parent::__construct();
        $this->taskRepository = app(TaskRepository::class);

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



}
