<?php

namespace App\Jobs;

use App\Models\Task;
use App\Resources\Control\Notification\Member\MemberNotification;

class NotificationStartWorkingJob extends Job
{

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $task;
    protected $memberNotification;

    public function __construct($task)
    {
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
        $notifyId = 'userNotify';
        $message = '';

        switch ($this->task->task_status_id){
            case 1:
                $message = 'Задача просрочена';
                $task = Task::whereId($this->task->id)->first();
                $task->update([
                    'task_status_id' => 4
                              ]);

                $this->memberNotification->acceptTask($notifyId, $message);
                break;
        }
    }
}
