<?php

namespace App\Http\Loader\Control;

use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\GroupMember;
use App\Models\Member;

class MemberLoader extends BaseLoader
{
    protected $groupLoader;
    protected $stdClass;

    public function __construct(){
        $this->groupLoader = app(GroupLoader::class);
        $this->stdClass = new \stdClass();
    }

    //          По наказу великого и всемогущего, этот метод сначала создает
    //          участника, а потом добавляет его в группу
    /**
     * @param $request
     * @return BasicErrorResource|SuccessResource
     */
    public function createMemberInGroup($request){
        /**
         * @var Member $isCreateMember
         * @var GroupMember $isAddInGroup
         */

        $isCreateMember = $this->createMember($request);
        $data = $request->input();

        $data['member_id'] = $isCreateMember->id;

        $isAddInGroup = GroupMember::create($data);

        return $isAddInGroup;
    }

    /**
     * @param $request
     * @return BasicErrorResource|void
     */
    public function createMember($request)
    {
        $adminId = \Auth::user()->id;
        $data = $request->input();
        $data['name'] = trim($data['name']);
        $data['user_notification_id'] = $data['login'];
        $data['password_visible'] = $data['password'];
        $data['password'] = app('hash')->make($data['password']);

        // Проверка на существования участника с вводимым логином и создание участника
        $isExists = Member::whereLogin($request->input('login'))->exists();
        if ($isExists){
            $this->stdClass->message = 'Пользователь с таким логином уже существует';
            return new BasicErrorResource($this->stdClass);
        }

        $data['avatar'] = Member::DEFAULT_AVATAR;
        $data['admin_id'] = $adminId;

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('members', 'public');
        }

        $isSave = Member::create($data);

        if ($isSave) {
            return $isSave;
        }
    }

    public function unsertMemberFromGroup($request){

        $stdClass = new \stdClass();

        // Удаление записи о связи участника с группой и возвращение статуса удаления
        $isDelete = GroupMember::where('member_id', $request->input('member_id'))
            ->where('group_id', $request->input('group_id'))
            ->where('position', $request->input('position'))
            ->delete();

        if ($isDelete){
            $stdClass->message = 'Участник успешно удален из группы';
            return new SuccessResource($stdClass);
        }

        $stdClass->message = 'Ошибка удаления участника';
        return new BasicErrorResource($stdClass);
    }


    public function updateGroupMember($request)
    {
        /**
         * @var GroupMember $groupMember
         */
        $groupMember = GroupMember::whereId($request->input('id'))->first();

        $isUpdate = $groupMember->update($request->input());

        if ($isUpdate){
            $this->stdClass->message = 'Участник успешно обновлен';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка обновления участника';
        return new BasicErrorResource($this->stdClass);
    }


    public function updateMember($request){

        /**
         * @var Member $user
         */
        $user = Member::whereId($request->input('id'))->first();

        $isExists = Member::whereLogin($request->input('login'))
            ->where('id', '!=', $request->get('id'))
            ->exists();

        if ($isExists){
            $this->stdClass->message = 'Участник с таком логином уже есть';
            return new BasicErrorResource($this->stdClass);
        }

        $user->update($request->input());

        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('members', 'public');
        }

        if (!empty($request->input('password'))) {
            $user->password_visible = $request['password'];
            $user->password = app('hash')->make($request['password']);
        }


        $isUpdate = $user->update();


        if ($isUpdate){
            $this->stdClass->message = 'Участник успешно обновлен';
            return new SuccessResource($this->stdClass);

        }

        $this->stdClass->message = 'Ошибка обновления участника';
        return new BasicErrorResource($this->stdClass);

    }

    public function deleteMember($request){

        $adminId = \Auth::user()->id;
        // Удаление и вывод статуса удаления
        $isDelete = Member::whereId($request->input('id'))
            ->whereAdminId($adminId)
            ->delete();

        if ($isDelete){
            $this->stdClass->message = 'Участник успешно удален';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка удаления участника';
        return new BasicErrorResource($this->stdClass);

    }
}
