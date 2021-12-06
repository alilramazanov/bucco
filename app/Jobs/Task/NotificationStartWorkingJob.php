<?php

namespace App\Jobs\Task;

use App\Jobs\Job;
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
    protected $memberNotificationId;

    public function __construct($task, $memberNotificationId)
    {
        $this->task = $task;
        $this->memberNotificationId = $memberNotificationId;
        $this->memberNotification = app(MemberNotification::class);

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = '';

        switch ($this->task->task_status_id){
            case 1:

                $this->task->update([
                    'task_status_id' => 4
                ]);

                $message = 'Задача просрочена';
                $this->memberNotification->acceptTask($this->memberNotificationId, $message);
                break;
        }
    }
}
