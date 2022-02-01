<?php

namespace App\Resources\Control\Notification\Member;

use App\Resources\Control\Notification\NotificationCore as Notification;

class MemberNotification extends Notification
{




    public function startTask($memberNotificationParameters){

        $message = 'Приступите к задаче';
        $this->pushToUser($memberNotificationParameters, $message);

    }

    public function acceptTask($memberNotificationParametres, $message){

        $this->pushToUser($memberNotificationParametres, $message);
    }

    public function updateTask($memberNotificationParametres, $name){

        $message = 'Задача '.'"'.$name.'"'.' Обновлена';
        $this->pushToUser($memberNotificationParametres, $message);
    }

    public function createTask($notificationParameters){

        $message = 'У вас новая задача';
        $this->pushToUser($notificationParameters, $message);

    }

    public function endTask($memberNotificationParameters){
        $message = 'Завершите задачу';
        $this->pushToUser($memberNotificationParameters, $message);
    }



}
