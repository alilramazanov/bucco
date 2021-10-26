<?php

namespace App\Http\Controllers\Control;

use App\Http\Repositories\Control\TaskRepository;
use App\Http\Requests\Control\Tasks\GroupTaskListRequest;
use App\Http\Requests\Control\Tasks\MemberTaskListRequest;
use App\Http\Requests\Control\Tasks\TaskCreateRequest;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;


class TaskController extends BaseController
{

    /**
     * @var TaskRepository
     */
    private $taskRepository;



    //                                              GET методы

    public function __construct()
    {
        parent::__construct();
        $this->taskRepository = app(TaskRepository::class);

    }


    public function groupTaskList(GroupTaskListRequest $request){

       $groupTasks = $this->taskRepository->getGroupTaskList($request);

        if ($groupTasks->isEmpty()) {
            throw new BadRequestException('Задачи группы не найдены', 404);
        }

        return $groupTasks;

    }

    public function memberTaskList(MemberTaskListRequest $request){

        $memberTasks = $this->taskRepository->getMemberTaskList($request);

        if ($memberTasks->isEmpty()) {
            throw new BadRequestException('Задачи участника не найдены', 404);
        }

        return $memberTasks;

    }



    //                                        ПОСТ МЕТОДЫ

    public function create(TaskCreateRequest $request){

        $data = $request->input();

        $isExists = Task::whereGroupId($request->input('group_id'))
            ->whereMemberId($request->input('member_id'))
            ->whereTaskTemplateId($request->input('task_template_id'))
            ->whereDescription($request->input('description'))
            ->exists();


        if ($isExists){

            return 'Такая запись уже существует';

        }

        Task::create($data);
        return 'Запись сохранена';
    }


    public function update(TaskCreateRequest $request){

        $data = $request->input();
        $item = Task::whereId($request->get('id'))->first();

        $isUpdate = $item->update($data);

        if ($isUpdate){
            return 'Запись успешно обновлена';
        }

        return 'Ошибка обновления';
    }


    public function delete(TaskCreateRequest $request){

        $isDelete = Task::whereId($request->input('id'))
            ->delete();

        if ($isDelete){
            return 'Запись удалена';
        }

        return 'Ошибка удаления';

    }


}
