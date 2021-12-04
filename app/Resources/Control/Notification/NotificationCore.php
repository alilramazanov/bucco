<?php

namespace App\Resources\Control\Notification;

use OneSignal;

abstract class NotificationCore
{


    public function pushToUser($notificationId, $message){

        OneSignal::sendNotificationToExternalUser(
            $message,
            $notificationId,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );
    }

    public function pushToAll($message){

        OneSignal::sendNotificationToAll(
            "Some Message",
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );

    }
}
