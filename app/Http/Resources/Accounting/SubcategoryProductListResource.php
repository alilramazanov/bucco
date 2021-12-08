<?php

namespace App\Http\Resources\Accounting;

use App\Models\SubcategoryProduct;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin SubcategoryProduct
 */
class SubcategoryProductListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => [
                'id' => $this->category_product_id,
                'name' => $this->category->name
            ]
        ];
    }
}
