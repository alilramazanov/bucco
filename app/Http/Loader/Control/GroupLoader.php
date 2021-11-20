<?php

namespace App\Http\Loader\Control;

use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Http\Resources\Control\Group\DetailGroupResource;
use App\Models\Group;
use App\Models\GroupMember;

class GroupLoader extends BaseLoader
{

    public function createGroup($request){

        $adminId = \Auth::user()->id;
        $stdClass = new \stdClass();
        $data = $request->input();


        // Проверка на существование подобного имени группы у админа без учета регистра и возвращение ответа
        $isNameExists = Group::whereAdminId($adminId)
            ->where('name' ,'iLIKE', $data['name'])
            ->exists();

        if ($isNameExists) {
            $stdClass->message = 'Такая группа уже есть';
            return new BasicErrorResource($stdClass);
        }

        // Создание группы и возвращение статуса выполнения
        $group = new Group;
        $group->name = trim($data['name']);
        $group->admin_id = $adminId;
        if ($request->hasFile('avatar')) {
            $group->avatar = $request->file('avatar')->store('groups', 'public');
        }

        $isCreate = $group->save();


        if ($isCreate){
            $stdClass->message = 'Группа успешно создана';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка создания группы';
        return new BasicErrorResource($stdClass);

    }

    public function detailGroup($request)
    {
        $group = Group::whereId($request->input('id'))
            ->whereAdminId(\Auth::user()->id)
            ->first();

        return new DetailGroupResource($group);
    }

    public function updateGroup($request){

        $adminId = \Auth::user()->id;
        $stdClass = new \stdClass();
        $data = $request->input();
        $data['name'] = trim($data['name']);


        $group = Group::whereId($request->input('id'))
            ->whereAdminId($adminId)
            ->first();
        $isNameExists = Group::whereAdminId($adminId)
            ->where('name' ,'iLIKE', $data['name'])
            ->exists();

        if ($isNameExists) {
            $stdClass->message = 'Такая группа уже есть';
            return new BasicErrorResource($stdClass);
        }

        if ($request->hasFile('avatar')) {
            $group->avatar = $request->file('avatar')->store('groups', 'public');
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
        $adminId = \Auth::user()->id;

        $isDelete = Group::whereId($request->input('id'))
            ->whereAdminId($adminId)
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

        $isExists = GroupMember::where('member_id', $data['member_id'])
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
