<?php

namespace App\Http\Repositories\Control;

use App\Http\Resources\Control\Task\MemberTasksResource;
use App\Models\Member as Model;
use App\Models\Task;

class MemberTaskRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getTaskListInGroup($request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $userId = \Auth::guard('member')->user()->id;

        $columns = [
            'id',
            'name',
            'description',
            'start_at',
            'end_at',
            'task_status_id'
        ];

        if ($request->input('status_id') == 1) {
            $tasksWithDouble = Task::whereMemberId($userId)
                ->whereGroupId($request->input('group_id'))
                ->whereIn('task_status_id', [1, 2])
                ->select($columns)
                ->orderByDesc('task_status_id')
                ->orderBy('start_at')
                ->get();

            return MemberTasksResource::collection($tasksWithDouble);
        }

        $tasks = Task::whereMemberId($userId)
            ->whereGroupId($request->input('group_id'))
            ->whereTaskStatusId($request->input('status_id'))
            ->select($columns)
            ->orderBy('start_at')
            ->get();

        return MemberTasksResource::collection($tasks);
    }
}
