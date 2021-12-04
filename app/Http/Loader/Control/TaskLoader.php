<?php

namespace App\Http\Loader\Control;

use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Task;

class TaskLoader extends BaseLoader
{

    public function createTask($request){

        $data = $request->input();
        $data['admin_id'] = \Auth::user()->id;

        $isCreate = Task::create($data);

        return $isCreate;

    }

    public function updateTask($request){

        $adminId = \Auth::user()->id;
        $data = $request->input();

        $task = Task::whereId($request->get('id'))
            ->whereAdminId($adminId)
            ->first();

        $isUpdate = $task->update($data);

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

        $stdClass = new \stdClass();

        $task = Task::whereId($request->input('id'))
            ->update($request->input());

        return $task;

    }
}
