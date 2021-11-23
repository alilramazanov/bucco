<?php

namespace App\Http\Repositories\Control;

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
            'name',
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
            'name',
            'task_status_id',
            'group_id',
            'member_id',
            'description',
            'start_at',
            'end_at'
        ];

        if ($request->get('status_id') == 1) {
            $tasks = $this->startConditions()
                ->select($columns)
                ->where('group_id', $request->get('group_id'))
                ->where('member_id', $request->get('member_id'))
                ->whereIn('task_status_id', [1, 4])
                ->orderByDesc('id')
                ->get();

            return MemberTasksResource::collection($tasks);

        }

        $currentTasks = $this->startConditions()
            ->select($columns)
            ->where('group_id', $request->get('group_id'))
            ->where('member_id', $request->get('member_id'))
            ->where('task_status_id', $request->get('status_id'))
            ->orderByDesc('id')
            ->get();

        return MemberTasksResource::collection($currentTasks);
    }


    public function getAdminMemberTaskList($statusId){

        $columns = [
            'id',
            'name',
            'task_status_id',
            'group_id',
            'member_id',
            'description',
            'start_at',
            'end_at'
        ];

        $tasks = $this->startConditions()
            ->select($columns)
            ->where('task_status_id', $statusId)
            ->get();

        return MemberTasksResource::collection($tasks);
    }

}
