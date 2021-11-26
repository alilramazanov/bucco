<?php

namespace App\Http\Resources\Control\Member;

use App\Resources\Control\Portfolio\Member\MemberPortfolio;
use App\Resources\Control\Rating\Member\MemberRating;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminMemberListResource extends JsonResource
{

    public function toArray($request)
    {

        $portfolio = (new MemberPortfolio())->getAdminMemberPortfolio($this->id, $this->admin_id);
        $rating = (new MemberRating)->getMemberRating($portfolio);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'rating' => $rating,
            'portfolio' => $portfolio
        ];
    }

}
