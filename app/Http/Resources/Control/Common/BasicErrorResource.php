<?php


namespace App\Http\Resources\Control\Common;


use Illuminate\Http\Resources\Json\JsonResource;

class BasicErrorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => 0,
            'message' => $this->message
        ];
    }

}
