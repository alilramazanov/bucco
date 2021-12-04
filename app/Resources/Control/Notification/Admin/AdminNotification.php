<?php

namespace App\Resources\Control\Notification\Admin;

use App\Resources\Control\Notification\NotificationCore as Notification;

class AdminNotification extends Notification
{





    public function updateStatusTask($notificationUserId, $statusId){
        switch ($statusId){
            case 2:
                $message = 'К задаче приступили';
                $this->pushToUser($notificationUserId, $message);
                break;
            case 3:
                $message = 'Задача выполнена';
                $this->pushToUser($notificationUserId, $message);
                break;

            case 4:
                $message = 'Задача просрочена';
                $this->pushToUser($notificationUserId, $message);
                break;
        }
    }


}
