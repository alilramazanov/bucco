<?php

namespace App\Http\Loader\Control;

use App\Http\Repositories\Control\TaskRepository;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Task;
use Carbon\Carbon;

class TaskLoader extends BaseLoader
{

    protected $taskRepository;

    public function __construct()
    {
        $this->taskRepository = app(TaskRepository::class);
    }

    public function createTask($request){

        $data = $request->input();
        $data['admin_id'] = \Auth::user()->id;

        $newTask = Task::create($data);

        return $newTask;

    }

    public function updateTask($request){

        $adminId = \Auth::user()->id;
        $data = $request->input();

        $isUpdate = Task::whereId($request->id)
            ->first()
            ->update($data);

        return $isUpdate;

    }

    public function deleteTask($request){

        $adminId = \Auth::user()->id;

        $isDelete = Task::whereId($request->id)
            ->delete();

        return $isDelete;

    }

    public function updateStatusTask($request){

        $isUpdate = Task::whereId($request->id)
            ->update($request->input());

        return $isUpdate;

    }

    public function returnTask($request){

        $task = Task::whereId($request->id)->first();
        $data = $request;
        $data['name'] = $task->name;
        $data['description'] = $task->description;
        $data['group_id'] = $task->group_id;
        $data['member_id'] = $task->member_id;
        $data['start_at'] = $task->start_at;


        $theLastTask = $this->taskRepository->getTheLastTask($request);

        $timeDifferenceOfTheLastTask = $this->diffInMinutesInTasks($task);

        // Начало задачи расcчитывается от конца самой последней задачи + 5 минут
        $data['start_at'] = Carbon::parse($theLastTask->end_at < Carbon::now() ? Carbon::now() : $theLastTask->end_at )
            ->addMinutes(5);

        $data['end_at'] = Carbon::parse($data['start_at'])
            ->addMinutes($timeDifferenceOfTheLastTask);

        return $this->createTask($data);

    }

    protected function diffInMinutesInTasks($task){
        $startTime = Carbon::parse($task->start_at);
        $endTime = Carbon::parse($task->end_at);

        return $startTime->diffInMinutes($endTime);
    }
}
