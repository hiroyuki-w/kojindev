<?php

namespace App\Repositories;

use App\Models\TrApplication;
use App\Models\TrApplicationTag;

class TrApplicationTagRepository extends AbstractRepository
{

    public function getModelClass(): string
    {
        return TrApplicationTag::class;
    }

    public function saveTags(TrApplication $trApplication, string $tags): void
    {
        $tagArray = explode(',', $tags);
        $ids = $trApplication->tr_application_tags->pluck('id');

        $this->model->destroy($ids);
        foreach ($tagArray as $tag) {
            $this->model->create(['tr_application_id' => $trApplication->id, 'tag_name' => $tag]);
        }
    }
}
