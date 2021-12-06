<?php

namespace App\Http\Action\Control\Task;

use App\Http\Action\Control\ActionCore;
use App\Jobs\Task\EndOfTaskJob;
use App\Jobs\Task\MinutesBeforeTheEndJob;
use App\Jobs\Task\NotificationStartTimeJob;
use App\Jobs\Task\NotificationStartWorkingJob;
use Carbon\Carbon;

class CreateTaskAction extends ActionCore
{

    public function addAJob($request, $task, $memberNotificationId){
        \Queue::later(Carbon::parse($request->get('start_at')), new NotificationStartTimeJob($memberNotificationId));
        \Queue::later(Carbon::parse($request->get('start_at'))->addMinutes(2), new NotificationStartWorkingJob($task, $memberNotificationId));
        \Queue::later(Carbon::parse($request->get('end_at'))->subMinutes(2), new MinutesBeforeTheEndJob($memberNotificationId));
        \Queue::later(Carbon::parse($request->get('end_at'))->addMinutes(2), new EndOfTaskJob($task, $memberNotificationId));

    }

}
