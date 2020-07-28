<?php

namespace App\Repositories;

use App\Models\TrApplication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(string $tag, int $count): LengthAwarePaginator
    {
        $query = tap($this->searchTag($this->model->newQuery(), $tag), function ($query) {
            return $query
                ->published()
                ->with('tr_user')
                ->with('tr_application_tags')
                ->orderByDesc('created_at');
        });
        return $query->paginate($count);
    }

    private function searchTag(Builder $query, string $tag): Builder
    {
        if (empty($tag)) {
            return $query;
        }
        return $query->whereIn('id',
            function (\Illuminate\Database\Query\Builder $query) use ($tag) {
                $query->select('tr_application_id')->from('tr_application_tags')->where('tag_name', $tag);
            }
        );
    }
}
