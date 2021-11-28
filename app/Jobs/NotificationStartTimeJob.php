<?php

namespace App\Jobs;

use App\Resources\Control\Notification\Admin\AdminNotification;

class NotificationStartTimeJob extends Job
{

    protected $adminNotification;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->adminNotification = app(AdminNotification::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->adminNotification->startTime('userNotification');
    }
}
