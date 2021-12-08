<?php

namespace App\Http\Resources\Accounting;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'count' => $this->count,
            'subcategory' => [
                'id' => $this->subcategory_product_id,
                'name' => $this->subcategoryProduct->name
            ]
        ];
    }
}
