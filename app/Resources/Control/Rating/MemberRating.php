<?php

namespace App\Resources\Control\Rating;

use App\Http\Resources\Control\Portfolio\PortfolioResource;
use App\Models\Portfolio;
use App\Resources\Control\Rating;
use App\Models\Member as Model;
use function React\Promise\all;

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
