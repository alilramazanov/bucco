<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OneSignal;

class TimerCommand extends Command
{

    protected $signature = 'notif';


    public function __invoke()
    {



        OneSignal::sendNotificationToAll(
            "С - страдание",
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );
    }

}
