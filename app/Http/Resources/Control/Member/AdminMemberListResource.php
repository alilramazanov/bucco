<?php

namespace App\Http\Resources\Control\Member;

use App\Http\Resources\Control\Portfolio\PortfolioResource;
use App\Models\Member;
use App\Models\Portfolio;
use App\Resources\Control\Rating\MemberRating;
use App\Resources\Control\Statistic\Statistic;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminMemberListResource extends JsonResource
{

    public function toArray($request)
    {
        $rating = (new MemberRating)->getMemberRating($this->portfolio);
        $portfolio = PortfolioResource::collection($this->portfolio);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'rating' => $rating,
            'portfolio' => $portfolio
        ];
    }

}
