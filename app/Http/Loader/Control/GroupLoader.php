<?php

namespace App\Http\Loader\Control;

use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Group;
use App\Models\GroupMember;

class GroupLoader extends BaseLoader
{

    public function createGroup($request){

        $stdClass = new \stdClass();


        $data = $request->input();

        $isExists = Group::whereAdminId($request->input('admin_id'))
            ->whereName($request->input('name'))
            ->exists();

        if ($isExists) {
            $stdClass->message = 'Такая группа уже создана';
            return new BasicErrorResource($stdClass);
        }

        $isCreate = Group::create($data);

        if ($isCreate){
            $stdClass->message = 'Группа успешно создана';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка удаления группы';
        return new BasicErrorResource($stdClass);

    }

    public function updateGroup($request){

        $stdClass = new \stdClass();

        $data = $request->input();
        $group = Group::whereId($request->input('id'))->first();

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

        $isCreate = GroupMember::create($data);

        if ($isCreate){
            $stdClass->message = 'Участник успешно добавлен в группу';

            return new SuccessResource($stdClass);
        }


        $stdClass->message =  'Ошибка добавления';

        return new BasicErrorResource($stdClass);

    }

    public function unsertMemberFromGroup($request){

        $stdClass = new \stdClass();

        $data = $request->input();


        $isDelete = GroupMember::where('member_id', $request->input('member_id'))
            ->where('group_id', $request->input('group_id'))
            ->where('position', $request->input('position'))->delete();

        if ($isDelete){
            $stdClass->message = 'Участник успешно удален из группы';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка удаления участника';
        return new BasicErrorResource($stdClass);
    }

}
