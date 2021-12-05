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
        dd($request->input());

    }
}
