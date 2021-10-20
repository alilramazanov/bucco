<?php

namespace App\Http\Repositories\Control;

use App\Http\Requests\Control\Groups\AllGroupTasksRequest;
use App\Http\Resources\Control\Task\GroupTasksResource;
use App\Http\Resources\Control\Task\MemberTasksResource;
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
            'task_template_id',
            'description',
            'start_at',
            'end_at'
        ];

        $tasks = $this->startConditions()
            ->select($columns)
            ->where('group_id', $request->get('group_id'))
            ->paginate();

        return GroupTasksResource::collection($tasks);

    }


    public function getMemberTaskList($request){

        $columns = [
            'id',
            'task_template_id',
            'task_status_id',
            'group_id',
            'member_id',
            'description',
            'start_at',
            'end_at'
        ];

        $currentTasks = $this->startConditions()
            ->select($columns)
            ->where('group_id', $request->get('group_id') )
            ->where('member_id', $request->get('member_id'))
            ->where('task_status_id', $request->get('status_id'))
            ->paginate();

        return MemberTasksResource::collection($currentTasks);
    }

}
