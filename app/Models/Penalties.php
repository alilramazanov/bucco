<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
