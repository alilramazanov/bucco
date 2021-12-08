<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property int $subcategory_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\SubcategoryProduct $subcategoryProduct
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubcategoryProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $count
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCount($value)
 */
class Product extends Model
{
    protected $table = 'products';


    protected $fillable = [
        'name',
        'subcategory_product_id',
        'count'
    ];


    public function subcategoryProduct()
    {
        return $this->belongsTo(SubcategoryProduct::class);
    }

}
