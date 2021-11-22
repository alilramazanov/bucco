<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Control\MemberTaskRepository;
use App\Http\Requests\Control\Members\MemberTasksRequest;

class MemberTaskController extends Controller
{

    /**
     * @var \Laravel\Lumen\Application|mixed
     */
    protected $memberTaskRepository;

    /**
     * MemberTaskController constructor
     */
    public function __construct()
    {
        $this->memberTaskRepository = app(MemberTaskRepository::class);
        $this->middleware('auth:member');
    }

    /**
     * @param MemberTasksRequest $request
     * @return mixed
     */
    public function taskList(MemberTasksRequest $request)
    {
        return $this->memberTaskRepository->getTaskListInGroup($request);
    }
}
