<?php

namespace App\Resources\Control\Rating;

use App\Resources\Control\Portfolio\iStatistic;

interface iRating
{
    public static function getRating(iStatistic $statistic);

}
