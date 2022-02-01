<?php

namespace App\Resources\Control\Notification\Admin;

use App\Resources\Control\Notification\NotificationCore as Notification;

class AdminNotification extends Notification
{





    public function updateStatusTask($notificationParameters, $statusId){
        switch ($statusId){
            case 2:
                $message = 'К задаче приступили';
                $this->pushToUser($notificationParameters, $message);
                break;
            case 3:
                $message = 'Задача выполнена';
                $this->pushToUser($notificationParameters, $message);
                break;

            case 4:
                $message = 'Задача просрочена';
                $this->pushToUser($notificationParameters, $message);
                break;
        }
    }


}
