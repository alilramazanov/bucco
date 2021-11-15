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
        public function createMemberInGroup($request){

            /*
             Получение данных и удаление отступов в принимаемом поле 'name'
             чтобы в базе не было одинаковых значений с разными отступами
             */
            $adminId = \Auth::user()->id;
            $data = $request->input();
            $data['name'] = trim($data['name']);
            $data['password'] = app('hash')->make($data['password']);

            // Проверка на существования участника с вводимым логином и создание участника
            $isExists = Member::whereLogin($request->input('login'))->exists();
            if ($isExists){
                $this->stdClass->message = 'Пользователь с таким логином уже существует';
                return new BasicErrorResource($this->stdClass);
            }

            $isCreateMember = Member::create([
                'name' => $data['name'],
                'login' => $data['login'],
                'password' => $data['password'],
                'avatar' => Member::DEFAULT_AVATAR,
                'admin_id' => $adminId,
                ]);


            // Подготовка данных для добавления участника в группу и добавление
            $data['member_id'] = Member::whereLogin($request->input('login'))->first('id')['id'];

            $isAddInGroup = GroupMember::create($data);


            // Ответ успешности создания участника и добавления его в группу
            if ($isCreateMember && $isAddInGroup) {
                $this->stdClass->message = 'Участник успешно создан и добавлен в группу';
                return new SuccessResource($this->stdClass);

            }

            $this->stdClass->message = 'Ошибка в создании участника ';
            return new BasicErrorResource($this->stdClass);

    }

    public function createMember($request)
    {
        $adminId = \Auth::user()->id;
        $data = $request->input();
        $data['name'] = trim($data['name']);
        $data['password'] = app('hash')->make($data['password']);

        // Проверка на существования участника с вводимым логином и создание участника
        $isExists = Member::whereLogin($request->input('login'))->exists();
        if ($isExists){
            $this->stdClass->message = 'Пользователь с таким логином уже существует';
            return new BasicErrorResource($this->stdClass);
        }

        $isCreateMember = Member::create([
            'name' => $data['name'],
            'login' => $data['login'],
            'password' => $data['password'],
            'avatar' => Member::DEFAULT_AVATAR,
            'admin_id' => $adminId,
        ]);

        if ($isCreateMember) {
            $this->stdClass->message = 'Пользователь успешно создан';
            return new SuccessResource($this->stdClass);
        }
        $this->stdClass->message = 'Ошибка при создании пользователя';
        return new BasicErrorResource($this->stdClass);
    }

    public function unsertMemberFromGroup($request){

        $stdClass = new \stdClass();
        $data = $request->input();


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


    public function updateMember($request){

        // Проверка на существование обновленного логина у другого участника

        $user = Member::whereId($request->input('id'))->first();


        $isExists = Member::whereLogin($request->input('login'))->exists();

        if ($isExists){
            $this->stdClass->message = 'Участник с таком логином уже есть';
            return new BasicErrorResource($this->stdClass);
        }


        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('members', 'public');
        }

        $isUpdate = $user->update($request->input());


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
