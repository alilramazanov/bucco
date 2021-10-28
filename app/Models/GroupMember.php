<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{

    protected $table = 'group_members';
    protected $fillable = [
        'member_id',
        'group_id',
        'position'
    ];



}
