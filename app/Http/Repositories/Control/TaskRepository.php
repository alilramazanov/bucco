<?php

namespace App\Http\Repositories\Control;

use App\Http\Resources\Control\Task\GroupTasksResource;
use App\Http\Resources\Control\Task\MemberTasksResource;
use App\Models\Task;
use App\Models\Task as Model;

class TaskRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getGroupTaskList($request)
    {
        $columns = [
            'id',
            'name',
            'description',
            'start_at',
            'end_at'
        ];

        $tasks = $this->startConditions()
            ->select($columns)
            ->where('group_id', $request->group_id)
            ->paginate();

        return $tasks;

    }


    public function getMemberTaskList($request){


        if ($request->task_status_id == 1) {
            $tasks = $this->startConditions()
                ->where('group_id', $request->group_id)
                ->where('member_id', $request->member_id)
                ->whereIn('task_status_id', [1, 2])
                ->orderByDesc('task_status_id')
                ->orderBy('start_at')
                ->get();

            return MemberTasksResource::collection($tasks)->groupBy(function ($tasks) {
                return substr($tasks['start_at'], 0, 10);
            });

        }

        $currentTasks = $this->startConditions()
            ->where('group_id', $request->group_id)
            ->where('member_id', $request->member_id)
            ->where('task_status_id', $request->task_status_id)
            ->orderBy('start_at')
            ->get();

        return MemberTasksResource::collection($currentTasks);
    }


    public function getAdminMemberTaskList($statusId){

        $memberId = \Auth::guard('member')->user()->id;

        $tasks = $this->startConditions()
            ->where('task_status_id', $statusId)
            ->whereMemberId($memberId)
            ->orderBy('start_at')
            ->get();

        return $tasks;
    }

    public function getTheLastTask($request){

        $task = Task::whereId($request->id)->first();

        $theLastTask = $this->startConditions()
            ->whereMemberId($task->member_id)
            ->whereGroupId($task->group_id)
            ->orderByDesc('end_at')
            ->first();

        return $theLastTask;
    }
}
