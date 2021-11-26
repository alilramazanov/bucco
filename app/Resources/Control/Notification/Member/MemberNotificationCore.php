<?php

namespace App\Resources\Control\Notification\Member;

use App\Resources\Control\Notification\NotificationCore as Notification;

class MemberNotificationCore extends Notification
{


    public function updateStatusTask($statusId, $notificationUserId){
        switch ($statusId){
            case 4:
                $message = 'К задаче приступили';
                $this->pushToUser($notificationUserId, $message);
                break;
        }
    }
}
