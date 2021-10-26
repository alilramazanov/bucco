<?php


namespace App\Http\Resources\Control\Common;


use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ErrorResource
 * @package App\Http\Resources\Common
 * @mixin Exception
 */
final class ErrorResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'status' => 0,
            'message' => $this->getMessage(),
        ];
    }

}
