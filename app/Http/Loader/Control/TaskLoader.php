<?php

namespace App\Http\Loader\Control;

use App\Http\Requests\Control\Tasks\CreateTaskRequest;
use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Task;
use http\Client\Request;

class TaskLoader extends BaseLoader
{




    public function createTask($request){

        $stdClass = new \stdClass();
        $data = $request->input();

        $isExists = Task::whereGroupId($request->input('group_id'))
            ->whereMemberId($request->input('member_id'))
            ->whereName($request->input('name'))
            ->whereDescription($request->input('description'))
            ->exists();


        if ($isExists){
            $stdClass->message = 'Такая задача уже есть, поменяйте описание';
            return new BasicErrorResource($stdClass);
        }

        $isCreate = Task::create($data);

        if ($isCreate){

            $stdClass->message = 'Задача успешно создана';
            return new SuccessResource($stdClass);

        }

        $stdClass->message = 'Ошибка создания задачи';
        return new BasicErrorResource($stdClass);
    }

    public function updateTask($request){

        $stdClass = new \stdClass();

        $data = $request->input();
        $task = Task::whereId($request->get('id'))->first();

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

        $isDelete = Task::whereId($request->input('id'))
            ->delete();


        if ($isDelete){
            $stdClass->message = 'Задача успешно удалена';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка удаления задачи';
        return new BasicErrorResource($stdClass);
    }

}
