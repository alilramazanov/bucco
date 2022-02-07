<?php

namespace App\Jobs\Task;

use App\Jobs\Job;
use App\Models\Task;
use App\Resources\Control\Notification\Member\MemberNotification;

class NotificationStartTimeJob extends Job
{

    protected $memberNotification;
    protected $task;

    protected $memberNotificationParameters;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task, $memberNotificationParameters)
    {
        $this->memberNotificationParameters = $memberNotificationParameters;
        $this->task = $task;
        $this->memberNotification = app(MemberNotification::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $isTaskExist = Task::whereId($this->task->id)->exists();
        if ($isTaskExist){

            $this->memberNotification->startTask($this->memberNotificationParameters);
        }
    }
}
