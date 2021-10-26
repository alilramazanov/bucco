<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Portfolio
 *
 * @property int $id
 * @property int $member_id
 * @property int $task_completed
 * @property int $task_overdue
 * @property int $task_all
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $member
 * @property-read int|null $member_count
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereTaskAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereTaskCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereTaskOverdue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Portfolio extends Model
{
    protected $table = 'portfolio';

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }



}
