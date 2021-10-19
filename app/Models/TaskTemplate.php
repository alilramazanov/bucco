<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TaskTemplate
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TaskTemplate extends Model
{
    protected $table = 'task_templates';


    public function tasks(){
        return $this->hasMany(Task::class);
    }


}
