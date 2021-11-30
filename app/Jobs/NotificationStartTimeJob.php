<?php

namespace App\Jobs;

use App\Resources\Control\Notification\Member\MemberNotification;

class NotificationStartTimeJob extends Job
{

    protected $memberNotification;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->memberNotification = app(MemberNotification::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->memberNotification->startTask('userNotify');
    }
}
