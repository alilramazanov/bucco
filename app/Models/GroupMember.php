<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GroupMember
 *
 * @property int $id
 * @property string $position
 * @property string|null $start_working_day
 * @property string|null $end_working_day
 * @property int $group_id
 * @property int $member_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereEndWorkingDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereStartWorkingDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GroupMember extends Model
{

    protected $table = 'group_members';
    protected $fillable = [
        'member_id',
        'group_id',
        'position'
    ];



}
