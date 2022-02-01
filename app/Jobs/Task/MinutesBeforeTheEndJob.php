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
    protected $memberNotification;
    protected $memberNotificationParameters;
    public function __construct($memberNotificationParameters)
    {
        $this->memberNotificationParameters = $memberNotificationParameters;
        $this->memberNotification = app(MemberNotification::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->memberNotification->endTask($this->memberNotificationParameters);
    }
}
