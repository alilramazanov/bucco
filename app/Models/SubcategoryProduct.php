<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\SubcategoryProduct
 *
 * @property int $id
 * @property string $name
 * @property int $category_product_id
 * @property bool $is_processing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\CategoryProduct $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct whereCategoryProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct whereIsProcessing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubcategoryProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubcategoryProduct extends Model
{
    protected $table = 'subcategory_products';

    protected $fillable = [
        'name', 'category_product_id', 'is_processing'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
