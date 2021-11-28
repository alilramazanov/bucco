<?php

namespace App\Resources\Control\Rating\Member;

use App\Resources\Control\Rating\RatingCore as Rating;

class MemberRating extends Rating
{

    public function getMemberRating($portfolio){

        $allTask = $portfolio['completed'] + $portfolio['overdue'];
        $completedTask = $portfolio['completed'];

        return $this->getRating($allTask, $completedTask);

    }
}
