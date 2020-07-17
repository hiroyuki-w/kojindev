<?php

namespace App\Policies;

use App\Models\TrUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tr users.
     *
     * @param  \App\Models\TrUser  $user
     * @return mixed
     */
    public function edit(TrUser $userOwn, TrUser $userTarget)
    {
        return $userOwn->id == $userTarget->id;
    }

}
