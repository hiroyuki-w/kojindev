<?php

namespace App\Repositories;

use App\Models\TrApplicationReport;
use Illuminate\Support\Collection;

class TrApplicationReportRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return TrApplicationReport::class;
    }

    public function getPublishedReportList(int $count): Collection
    {
        return $this->model
            ->published()
            ->with('tr_application.tr_application_tags')
            ->with('tr_application.tr_user')
            ->orderByDesc('created_at')
            ->limit($count)
            ->get();
    }

    public function getListByApplicationIds(array $tr_application_ids, int $count = null): Collection
    {
        return $this->model
            ->whereIn('tr_application_id', $tr_application_ids)
            ->orderByDesc('id')
            ->limit($count)
            ->get();
    }

}
