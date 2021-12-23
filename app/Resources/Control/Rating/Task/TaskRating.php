<?php

namespace App\Resources\Control\Rating\Task;

use App\Resources\Control\Portfolio\iStatistic;
use App\Resources\Control\Rating\iRating;

class TaskRating implements iRating
{

    public static function getRating(iStatistic $statistic)
    {
        $taskStatistic = $statistic->getStatistic();

        $rating = round(($taskStatistic['completed'] != 0 ? ($taskStatistic['completed'] / $taskStatistic['all']) : 0) * 5, 1);

        return $rating;
    }
}
