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

        $isUpdate = Task::whereId($request->get('id'))
            ->whereAdminId($adminId)
            ->first()
            ->update($data);

        return $isUpdate;

    }

    public function deleteTask($request){

        $adminId = \Auth::user()->id;

        $isDelete = Task::whereId($request->input('id'))
            ->whereAdminId($adminId)
            ->delete();

        return $isDelete;

    }

    public function updateStatusTask($request){

        $isUpdate = Task::whereId($request->input('id'))
            ->update($request->input());

        return $isUpdate;

    }

    public function returnTask($request){

        $data = $request;
        $startTime = Carbon::parse($request->input('start_at'));
        $endTime = Carbon::parse($request->input('end_at'));
        $timeDifferenceOfTheLastTask = $startTime->diffInMinutes($endTime);


        $theLastTask = $this->taskRepository->getTheLastTask($request);


        // Начало задачи расчитывается от конца самой последней задачи + 5 минут
        $data['start_at'] = Carbon::parse($theLastTask->end_at)
            ->addMinutes(5);

        $data['end_at'] = Carbon::parse($data['start_at'])
            ->addMinutes($timeDifferenceOfTheLastTask);

        return $this->createTask($data);

    }
}
