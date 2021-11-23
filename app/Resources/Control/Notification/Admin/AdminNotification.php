<?php

namespace App\Resources\Control\Notification\Admin;

use App\Resources\Control\Notification\Notification;
use OneSignal;

class AdminNotification extends Notification
{


    public function __construct(){
    }

    public function push($notificationUserId, $message){

        OneSignal::sendNotificationToExternalUser(
            $message,
            $notificationUserId,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );
    }

    public function updateStatusTask($statusId, $notificationUserId){
        switch ($statusId){
            case 4:
                $message = 'К задаче приступили';
                $this->push($notificationUserId, $message);
                break;

        }
    }

    public function updateTask($notificationId){
        $message = 'Задача обновлена';
        $this->push($notificationId, $message);
    }

}
