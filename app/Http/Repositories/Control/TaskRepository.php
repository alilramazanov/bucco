<?php

namespace App\Http\Repositories\Control;

use App\Http\Resources\Control\Task\AllGroupTasksResource;
use App\Models\Task as Model;

class TaskRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllGroupTasks()
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
            ->where('group_id', 1)
            ->paginate();

        return AllGroupTasksResource::collection($tasks);


    }


}
