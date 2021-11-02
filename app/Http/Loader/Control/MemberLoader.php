<?php

namespace App\Http\Loader\Control;

use App\Http\Resources\Control\Common\BasicErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Member;
use Lcobucci\JWT\Claim\Basic;
use function Symfony\Component\Translation\t;

class MemberLoader extends BaseLoader
{
    protected $groupLoader ;
    protected $stdClass;

    public function __construct(){
        $this->groupLoader = app(GroupLoader::class);
        $this->stdClass = new \stdClass();
    }


    //          По наказу великого и всемогущего, этот метод сначало создает
    //          участника а потом добавляет его в группу
        public function createMemberInGroup($request){

            $data = $request->input();
            $data['name'] = trim($data['name']);


            // проверка на существования уастника с вводимым логином и создание участника
            $isExists = Member::whereLogin($request->input('login'))->exists();
            if ($isExists){
                $this->stdClass->message = 'Пользователь с такиим логином уже существует';
                return new BasicErrorResource($this->stdClass);
            }
            $isCreateMember = Member::create($data);


            // Подготовка данных для добавления участника в группу
            $data= [
                'group_id' => $request->input('group_id'),
                'member_id' => Member::whereLogin($request->input('login'))->first('id')['id'],
                'position' => $request->input('position')
            ];
            $isAddInGroup = GroupMember::create($data);


            // Проверка ошибок
            if ($isCreateMember) {
                if ($isAddInGroup){
                    $this->stdClass->message = 'Участник успешно создан и добавлен в группу';
                    return new SuccessResource($this->stdClass);

                }

            }

            $this->stdClass->message = 'Ошибка в создании участника ';
            return new BasicErrorResource($this->stdClass);

    }


    public function updateMember($request){

        $isExists = Member::whereLogin($request->input('login'))->exists();
        if ($isExists){
            $this->stdClass->message = 'Участник с таком логином уже есть';
            return new SuccessResource($this->stdClass);
        }

        $isUpdate = Member::whereId($request->input('id'))->update(request()->input());

        if ($isUpdate){
            $this->stdClass->message = 'Участник усспешно обновлен';
            return new SuccessResource($this->stdClass);

        }

        $this->stdClass->message = 'Ошибка обновления участника';
        return new BasicErrorResource($this->stdClass);

    }

    public function deleteMember($request){


        $isDelete = Member::whereId($request->input('id'))->delete();

        if ($isDelete){
            $this->stdClass->message = 'Участник успешно удален';
            return new SuccessResource($this->stdClass);
        }

        $this->stdClass->message = 'Ошибка удаления участника';
        return new BasicErrorResource($this->stdClass);

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
