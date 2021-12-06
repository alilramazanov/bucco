<?php

namespace App\Http\Repositories\Control;

use App\Http\Resources\Control\Task\GroupTasksResource;
use App\Http\Resources\Control\Task\MemberTasksResource;
use App\Models\Task as Model;
use Carbon\Carbon;

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

        if ($request->get('task_status_id') == 1) {
            $tasks = $this->startConditions()
                ->select($columns)
                ->where('group_id', $request->get('group_id'))
                ->where('member_id', $request->get('member_id'))
                ->whereIn('task_status_id', [1, 2])
                ->orderByDesc('task_status_id')
                ->orderBy('start_at')
                ->get();

            return MemberTasksResource::collection($tasks)->groupBy(function ($tasks) {
                return substr($tasks['start_at'], 0, 10);
            });

        }

        $currentTasks = $this->startConditions()
            ->select($columns)
            ->where('group_id', $request->get('group_id'))
            ->where('member_id', $request->get('member_id'))
            ->where('task_status_id', $request->get('task_status_id'))
            ->orderBy('start_at')
            ->get();

        return MemberTasksResource::collection($currentTasks);
    }


    public function getAdminMemberTaskList($statusId){

        $memberId = \Auth::guard('member')->user()->id;

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
            ->whereMemberId($memberId)
            ->orderBy('start_at')
            ->get();

        return MemberTasksResource::collection($tasks);
    }

}
