<?php

namespace App\Resources\Control\Penalties;

use App\Models\Penalties;

class PenaltiesMember
{

    public function __construct()
    {
    }

    public function allGroupMemberPenalties($groupId, $memberId){

        $sumOfPenalties = Penalties::where('group_id', $groupId)
            ->where('member_id', $memberId)
            ->sum('amount_of_penalty');

        return $sumOfPenalties;
    }
}
