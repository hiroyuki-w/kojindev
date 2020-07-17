<?php

namespace App\Services;

use App\Models\TrApplication;
use App\Models\TrApplicationTag;
use App\Models\TrUser;
use App\Services\UploadImage\UploadImageService;
use Arr;

class ApplicationService
{
    /**
     * @var UploadImageService
     */
    private UploadImageService $uploadImageService;

    public function __construct(UploadImageService $uploadImageService)
    {
        $this->uploadImageService = $uploadImageService;
    }

    public function saveApplication(array $request, TrUser $trUser, TrApplication $trApplication): TrApplication
    {
        $request['tr_user_id'] = $trUser->id;

        $trApplication = TrApplication::updateOrCreate(['id' => $trApplication->id], $request);

        $this->deleteAndInsertTags($request['tags'], $trApplication);

        $this->deleteImages($trApplication->id, Arr::get($request, 'image_delete', []));

        $this->saveImages(Arr::get($request, 'application_upload_image', []), $trApplication->id);

        return $trApplication;
    }

    private function deleteAndInsertTags($tagCsv, TrApplication $trApplication): void
    {
        //一旦全部delete
        $tagIds = $trApplication->tr_application_tags->pluck('id');
        TrApplicationTag::destroy($tagIds);

        //リクエストされたデータをすべて追加
        $requestTagArray = explode(',', $tagCsv);
        foreach ($requestTagArray as $tag) {
            $trApplication->tr_application_tags()->create([
                'tag_name' => $tag
            ]);
        }
    }

    private function saveImages(array $images, int $tr_application_id): void
    {
        foreach ($images as $no => $imageFile) {
            $this->uploadImageService->set('Application')
                ->saveImage($imageFile, $tr_application_id, $no);
        }
    }

    private function deleteImages(int $tr_application_id, array $noArray): void
    {
        foreach ($noArray as $no) {
            $this->uploadImageService->set('Application')->deleteImage($tr_application_id, $no);
        }
    }

}
