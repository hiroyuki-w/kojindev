<?php

namespace App\Repositories;

use App\Models\TrApplication;
use Illuminate\Support\Collection;

/**
 * @property  TrApplication $model
 *
 *
 */
class TrApplicationRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return TrApplication::class;
    }

    public function getPublishedApplicationList(int $count): Collection
    {
        return $this->model->published()
            ->with('tr_user')
            ->with('tr_application_tags')
            ->orderByDesc('created_at')
            ->limit($count)
            ->get();
    }

    public function getListByTrUserId(int $tr_user_id, int $count = null): Collection
    {
        return $this->model
            ->with('tr_user')
            ->with('tr_application_tags')
            ->where('tr_user_id', $tr_user_id)
            ->orderByDesc('created_at')
            ->limit($count)
            ->get();
    }
}
