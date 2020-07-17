<?php

namespace App\Repositories;

use App\Models\TrUser;

/**
 * @property  TrApplication $model
 *
 *
 */
class TrUserRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return TrUser::class;
    }

    public function findBySocialId(string $socialUserId, string $provider): ?TrUser
    {
        return $this->model
            ->where('social_id', $socialUserId)
            ->where('social_type', $provider)
            ->first();
    }
}
