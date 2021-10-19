<?php

namespace App\Http\Controllers\Control;

use App\Http\Repositories\Control\TaskRepository;


class TaskController extends BaseController
{

    /**
     * @var TaskRepository
     */
    private $taskRepository;


    public function __construct()
    {
        parent::__construct();
        $this->taskRepository = app(TaskRepository::class);


    }

    public function getAllGroupTasks(){

       return $this->taskRepository->getAllGroupTasks();


    }



}
