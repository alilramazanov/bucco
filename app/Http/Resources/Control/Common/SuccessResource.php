<?php


namespace App\Http\Resources\Control\Common;


use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => 1,
            'message' => $this->message
        ];
    }

}
