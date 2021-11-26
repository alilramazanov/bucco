<?php

namespace App\Resources\Control\Notification;

use OneSignal;

abstract class NotificationCore
{

    public function pushToUser($notificationUserId, $message){

        OneSignal::sendNotificationToExternalUser(
            $message,
            'userNotification',
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
