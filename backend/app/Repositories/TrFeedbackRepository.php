<?php

namespace App\Repositories;

use App\Models\TrFeedback;
use Illuminate\Support\Collection;

class TrFeedbackRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return TrFeedback::class;
    }

    public function getListByApplicationId(int $tr_application_id, int $count = null): Collection
    {
        return $this->model
            ->where('tr_application_id', $tr_application_id)
            ->orderByDesc('id')
            ->limit($count)
            ->get();
    }

    public function getListByApplicationIds(array $tr_application_ids, int $count = null): array
    {
        $list = [];
        foreach ($tr_application_ids as $tr_application_id) {
            $list[$tr_application_id] = $this->getListByApplicationId($tr_application_id, $count);
        }
        return $list;
    }


}
