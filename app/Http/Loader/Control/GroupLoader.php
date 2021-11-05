<?php

namespace App\Http\Loader\Control;

use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class GroupLoader extends BaseLoader
{

    public function createGroup($request){

        $stdClass = new \stdClass();
        $data = $request->input();

        // Удаление ненужных отступов в начале и конце
        $data['name'] = trim($data['name']);


        // Проверка на существование подобного имени группы у админа без учета регистра и возвращение ответа
        $isNameExists = Group::whereAdminId($request->input('admin_id'))
            ->where('name' ,'iLIKE', '%'.$data['name'].'%')
            ->exists();

        if ($isNameExists) {
            $stdClass->message = 'Такая группа уже есть';
            return new BasicErrorResource($stdClass);
        }

        // Создание группы и возвращение статуса выполнения
        $isCreate = Group::create($data);

        if ($isCreate){
            $stdClass->message = 'Группа успешно создана';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка создания группы';
        return new BasicErrorResource($stdClass);

    }

    public function updateGroup($request){

        $stdClass = new \stdClass();
        $data = $request->input();
        $data['name'] = trim($data['name']);


        $group = Group::whereId($request->input('id'));
        $isNameExists = Group::whereAdminId($request->input('admin_id'))
            ->where('name' ,'iLIKE', '%'.$data['name'].'%')
            ->exists();

        if ($isNameExists) {
            $stdClass->message = 'Такая группа уже есть';
            return new BasicErrorResource($stdClass);
        }

        $isUpdate = $group->update($data);

        if ($isUpdate) {
            $stdClass->message = 'Группа успешно обновлена';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка обновления группы';
        return new BasicErrorResource($stdClass);

    }

    public function deleteGroup($request){

        $stdClass = new \stdClass();

        $isDelete = Group::whereId($request->input('id'))
            ->delete();

        if ($isDelete) {
            $stdClass->message = 'Группа успешно удалена';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка удаления группы';
        return new BasicErrorResource($stdClass);

    }


    public function addMemberInGroup($request){

        $stdClass = new \stdClass();
        $data = $request->input();
        $data['position'] = trim($data['position']);

        $isExists = GroupMember::where('position', 'iLIKE', $data['position'])
        ->where('member_id', $data['member_id'])
        ->where('group_id', $data['group_id'])
        ->exists();

        if ($isExists){
            $stdClass->message = 'Участник уже имеет эту роль в группе';
            return new BasicErrorResource($stdClass);

        }

        $isCreate = GroupMember::create($data);

        if ($isCreate){
            $stdClass->message = 'Участник успешно добавлен в группу';

            return new SuccessResource($stdClass);
        }

        $stdClass->message =  'Ошибка добавления';

        return new BasicErrorResource($stdClass);

    }
}
