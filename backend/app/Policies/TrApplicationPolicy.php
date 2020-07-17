<?php

namespace App\Policies;

use App\Models\TrUser;
use App\Models\TrApplication;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the tr application.
     *
     * @param  \App\Models\TrUser  $trUser
     * @param  \App\Models\TrApplication  $trApplication
     * @return mixed
     */
    public function viewOwner(TrUser $trUser, TrApplication $trApplication): bool
    {
        return ($trUser->id == $trApplication->tr_user_id);
    }

    public function published(?TrUser $trUser, TrApplication $trApplication)
    {
        if ($trApplication->public_flg == FLG_ON) {
            return true;
        }
        if ($trUser !== null && $trUser->id == $trApplication->tr_user_id) {
            //所有者の場合表示可能
            return true;
        }
        return false;
    }
}
