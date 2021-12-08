<?php

namespace App\Http\Resources\Accounting;

use App\Models\CategoryProduct;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CategoryProduct
 */
class CategoryProductListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isProcessing' => $this->is_processing,
            'group' => [
                'id' => $this->group_id,
                'name' => $this->group->name,
            ]
        ];
    }
}
