<?php

namespace App\Jobs\Task;

use App\Jobs\Job;
use App\Resources\Control\Notification\Member\MemberNotification;

class MinutesBeforeTheEndJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**
     * @var MemberNotification $notification
     */
    protected $notification;
    protected $memberNotificationId;
    public function __construct($memberNotificationId)
    {
        $this->memberNotificationId = $memberNotificationId;
        $this->notification = app(MemberNotification::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->notification->endTask($this->memberNotificationId);
    }
}
