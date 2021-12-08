<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CategoryProduct
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property bool $is_processing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Group $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubcategoryProduct[] $subcategoryProducts
 * @property-read int|null $subcategory_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereIsProcessing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CategoryProduct extends Model
{

    protected $table = 'category_products';

    protected $fillable = [
        'name', 'group_id', 'is_processing'
    ];


    public function subcategoryProducts()
    {
        return $this->hasMany(SubcategoryProduct::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
