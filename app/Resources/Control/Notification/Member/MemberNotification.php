<?php

namespace App\Resources\Control\Notification\Member;

use App\Resources\Control\Notification\NotificationCore as Notification;

class MemberNotification extends Notification
{


    public function __construct(){

    }

    public function startTask($notificationId){
        $message = 'Приступите к задаче';
        $this->pushToUser($notificationId, $message);

    }

    public function acceptTask($notificationId, $message)
    {
        $this->pushToUser($notificationId, $message);
    }

    public function updateTask($notificationId, $name){

        $message = 'Задача '.'"'.$name.'"'.' Обновлена';
        $this->pushToUser($notificationId, $message);
    }

    public function createTask($notificationId){

        $message = 'У вас новая задача';
        $this->pushToUser($notificationId, $message);

    }

    public function endTask($notificationId, $name){
        $message = 'Завершите задачу';
        $this->pushToUser($notificationId, $message);
    }

}
