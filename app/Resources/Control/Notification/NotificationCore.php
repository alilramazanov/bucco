<?php

namespace App\Resources\Control\Notification;

use OneSignal;

abstract class NotificationCore
{

    protected $onesignalAppId = 'android';

    protected $onesignalApps = [
        'android' => [
            'app_id' => '01ec8a81-8aaf-4eb2-902f-a4b391dc7e31',
            'api_key' => 'YWE3YzY0YjctOGRiNS00NGFhLWI3M2UtYTliNzM2MTZhYjJi'
        ],
        'iosEmployee' => [
            'app_id' => 'a166352d-376d-45b2-b75d-98da9f942007',
            'api_key' => 'ODBlYzdiMjktODUzNS00MjY3LTk5NTgtM2YzYTg1ZmI5YTNj'
        ],
        'iosAdmin' => [
            'app_id' => 'e17f2816-0dbf-4ca8-8c43-b2f7dd0fd9da',
            'api_key' => 'ZmE3OThiM2YtMTUxYy00NTU0LThhMjEtODIyYjM0ZDkzODdl'
        ],
    ];

    /*
     * notificationParameters
     * - notificationId
     * - onesignalApp
     */

    public function pushToUser($notificationParameters, $message){

        $this->sendToDifferentApp($notificationParameters['onesignalApp'], $notificationParameters['notificationId'], $message );

    }


    public  function sendToDifferentApp($onesignalApp, $notifyId, $message){


        $params = [
            'app_id' => $this->onesignalApps[$onesignalApp]['app_id'],
            'api_key' => $this->onesignalApps[$onesignalApp]['api_key'],
            'include_external_user_ids' => [$notifyId],
            $params['include_player_ids'] = ['358433ea-82a8-11ec-818d-a284d2887856'],
            'contents' => [
                'en' => $message
                ]
        ];

        OneSignal::sendNotificationCustom($params);

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


