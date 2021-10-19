<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PositionTemplate
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Group $group
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PositionTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PositionTemplate extends Model
{
    protected $table = 'position_templates';



    public function group(){
        return $this->belongsTo(Group::class);
    }

}
