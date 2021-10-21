<?php

namespace App\Http\Resources\Control\Member;

use App\Http\Resources\Control\Portfolio\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminMemberListResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'rating' => 'Класс рейтинга рейтинга в разработке',
            'portfolio' => PortfolioResource::collection($this->portfolio)
        ];
    }

}
