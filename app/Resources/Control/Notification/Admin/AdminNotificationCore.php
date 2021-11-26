<?php

namespace App\Resources\Control\Notification\Admin;

use App\Resources\Control\Notification\NotificationCore as Notification;
use OneSignal;

class AdminNotificationCore extends Notification
{


    public function __construct(){

    }

    public function updateTask($notificationId, $name){

        $message = 'Задача '.'"'.$name.'"'.' Обновлена';
        $this->pushToUser($notificationId, $message);
    }

    public function createTask($notificationId){

        $message = 'У вас новая задача';
        $this->pushToUser($notificationId, $message);

    }

}
