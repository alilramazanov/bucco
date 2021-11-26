<?php

namespace App\Resources\Control\Rating;

abstract class RatingCore
{
    public function getRating($allTask, $completedTask){

        $rating = round(($completedTask != 0 ? ($completedTask/$allTask) : 0) * 5, 1);

        return $rating;

    }

}
