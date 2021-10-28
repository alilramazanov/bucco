<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $task_template_id
 * @property int $task_status_id
 * @property int $group_id
 * @property int $member_id
 * @property string|null $description
 * @property string|null $start_at
 * @property string|null $end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Group $group
 * @property-read \App\Models\Member $member
 * @property-read \App\Models\TaskStatus $taskStatus
 * @property-read \App\Models\TaskTemplate $taskTemplate
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTaskStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTaskTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Task extends Model
{

    use SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'admin_id',
        'task_status_id',
        'name',
        'group_id',
        'member_id',
        'description'
    ];


    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }

    public function taskStatus(){
        return $this->belongsTo(TaskStatus::class);
    }





}
