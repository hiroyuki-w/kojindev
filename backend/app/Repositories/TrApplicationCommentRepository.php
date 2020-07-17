<?php

namespace App\Repositories;

use App\Models\TrApplicationComment;
use Illuminate\Support\Collection;

/**
 * @property  TrApplicationComment $model
 *
 *
 */
class TrApplicationCommentRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return TrApplicationComment::class;
    }

    public function getListByApplicationId(int $tr_application_id, $count = null): Collection
    {
        return $this->model
            ->with('tr_user')
            ->where('tr_application_id', $tr_application_id)
            ->orderByDesc('created_at')
            ->limit($count)
            ->get();
    }
}
