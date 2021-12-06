<?php

namespace App\Jobs\Task;

use App\Jobs\Job;
use App\Resources\Control\Notification\Member\MemberNotification;

class NotificationStartTimeJob extends Job
{

    protected $memberNotification;

    protected $memberNotificationId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($memberNotificationId)
    {
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
        $this->memberNotification->startTask($this->memberNotificationId);
    }
}
