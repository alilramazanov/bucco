<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Penalties
 *
 * @property int $id
 * @property int $member_id
 * @property int $group_id
 * @property int $amount_of_penalty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Member $groups
 * @property-read \App\Models\Member $members
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties query()
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties whereAmountOfPenalty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penalties whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Penalties extends Model
{


    protected $fillable = [
        'member_id',
        'group_id',
        'amount_of_penalty'
    ];



    public function members(){
        return $this->belongsTo(Member::class);
    }

    public function groups(){
        return $this->belongsTo(Member::class);

    }

}
