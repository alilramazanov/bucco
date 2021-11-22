<?php

namespace App\Http\Loader\Control;

use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Task;

class TaskLoader extends BaseLoader
{

    public function createTask($request){

        $stdClass = new \stdClass();
        $data = $request->input();
        $data['admin_id'] = \Auth::user()->id;

        $isCreate = Task::create($data);

        if ($isCreate){
            $stdClass->message = 'Задача успешно создана';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка создания задачи';
        return new BasicErrorResource($stdClass);
    }

    public function updateTask($request){

        $adminId = \Auth::user()->id;
        $stdClass = new \stdClass();
        $data = $request->input();
        $task = Task::whereId($request->get('id'))
            ->whereAdminId($adminId)
            ->first();

        $isUpdate = $task->update($data);

        if ($isUpdate){
            $stdClass->message = 'Задача успешно обновлена';
            return new SuccessResource($stdClass);
        }

        $stdClass->messge = 'Ошибка обновления задачи';
        return new BasicErrorResource($stdClass);

    }

    public function deleteTask($request){

        $stdClass = new \stdClass();
        $adminId = \Auth::user()->id;

        $isDelete = Task::whereId($request->input('id'))
            ->whereAdminId($adminId)
            ->delete();

        if ($isDelete){
            $stdClass->message = 'Задача успешно удалена';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка удаления задачи';
        return new BasicErrorResource($stdClass);
    }

    public function updateStatusTask($request){

        $stdClass = new \stdClass();

        $task = Task::whereId($request->input('id'))
        ->update($request->input());
        if ($task){
            $stdClass->message = 'Статус успешно обновлен';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка обновления';
        return new BasicErrorResource($stdClass);




    }

}
