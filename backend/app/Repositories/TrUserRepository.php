<?php

namespace App\Repositories;

use App\Models\TrUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(string $keyword, int $count): LengthAwarePaginator
    {
        $query = tap($this->searchProfile($this->model->newQuery(), $keyword), function ($query) {
            return $query
                ->with('tr_user_profile')
                ->with(['tr_applications' => function ($query) {
                    $query->published();
                }])
                ->orderByDesc('created_at');
        });
        return $query->paginate($count);
    }

    private function searchProfile(Builder $query, string $keyword): Builder
    {
        if (empty($keyword)) {
            return $query;
        }
        return $query->whereIn('id',
            function (\Illuminate\Database\Query\Builder $query) use ($keyword) {
                $query->select('tr_user_id')->from('tr_user_profiles')
                    ->where(function (\Illuminate\Database\Query\Builder $query) use ($keyword) {
                        $query->where('user_profile', 'like', '%' . $keyword . '%');
                        $query->orWhere('user_skillset', 'like', '%' . $keyword . '%');
                    });
            }
        );
    }
}
