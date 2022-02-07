<?php

namespace App\Http\Action\Control\Task;

use App\Http\Action\Control\ActionCore;
use App\Jobs\Task\NotificationStartTimeJob;
use App\Jobs\Task\NotificationStartWorkingJob;
use App\Models\Task;
use Carbon\Carbon;

class CreateTaskAction extends ActionCore
{


    // task - это новая задача которая нужна чтобы передать время ее начала джобу, и передать ее джобу
    // для совершения над задачей какой то логики (обновления статуса)

    // memberNotificationId используется для отправки пуш уведомления
    public function addAJob( $task, $memberNotificationParameters){

        $isTaskExists = Task::whereId($task->id)->exists();
        if ($isTaskExists){
            \Queue::later(Carbon::parse($task->start_at), new NotificationStartTimeJob($memberNotificationParameters));
            \Queue::later(Carbon::parse($task->start_at)->addMinutes(2), new NotificationStartWorkingJob($task, $memberNotificationParameters));
        }

    }
}
