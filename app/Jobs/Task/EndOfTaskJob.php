<?php

namespace App\Jobs\Task;

use App\Jobs\Job;
use App\Models\Task;
use App\Resources\Control\Notification\Member\MemberNotification;

class EndOfTaskJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**

     * @var MemberNotification $memberNotification
     */

    protected $memberNotification;
    protected $memberNotificationId;
    protected $task;
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

        switch ($this->task->task_status_id){
            case 2:

                $this->task->update([
                    'task_status_id' => 4
                ]);

                break;

        }
    }
}
