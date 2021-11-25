<?php

namespace App\Resources\Control\Rating;

class MemberRating
{

    public function getRating($allTask, $completedTask){

        $rating = round(($completedTask != 0 ? ($completedTask/$allTask) : 0) * 5, 1);

        return $rating;

    }

    public function getMemberRating($portfolio){



        $allTask = $portfolio['all'];
        $completedTask = $portfolio['completed'];


        return $this->getRating($allTask, $completedTask);

    }
}
