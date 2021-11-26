<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Models\Penalties;
use Illuminate\Http\Request;


class PenaltiesController extends Controller
{


    public function create(Request $request){

        Penalties::create($request->input());

    }

    public function allGroupMemberPenalties($groupId, $memberId){

        $sumOfPenalties = Penalties::where('group_id', $groupId)
            ->where('member_id', $memberId)
            ->sum('amount_of_penalty');

        return $sumOfPenalties;
    }

}
