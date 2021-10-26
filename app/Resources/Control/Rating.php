<?php

namespace App\Resources\Control;

use Illuminate\Database\Eloquent\Model;


interface Rating
{
    public function getRating(Model $model);

}
