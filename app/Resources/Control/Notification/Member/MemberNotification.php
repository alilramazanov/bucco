<?php

namespace App\Resources\Control\Notification\Member;

use App\Resources\Control\Notification\NotificationCore as Notification;

class MemberNotification extends Notification
{




    public function startTask($memberNotificationId){

        $message = 'Приступите к задаче';
        $this->pushToUser($memberNotificationId, $message);

    }

    public function acceptTask($memberNotificationId, $message){

        $this->pushToUser($memberNotificationId, $message);
    }

    public function updateTask($memberNotificationId, $name){

        $message = 'Задача '.'"'.$name.'"'.' Обновлена';
        $this->pushToUser($memberNotificationId, $message);
    }

    public function createTask($memberNotificationId){

        $message = 'У вас новая задача';
        $this->pushToUser($memberNotificationId, $message);

    }

    public function endTask($memberNotificationId){
        $message = 'Завершите задачу';
        $this->pushToUser($memberNotificationId, $message);
    }

}
