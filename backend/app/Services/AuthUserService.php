<?php

namespace App\Services;

use App\Models\TrUser;
use App\Models\TrUserProfile;
use App\Services\UploadImage\UploadImageService;
use Arr;

class AuthUserService
{
    /**
     * @var UploadImageService
     */
    private UploadImageService $uploadImageService;

    public function __construct(UploadImageService $uploadImageService)
    {
        $this->uploadImageService = $uploadImageService;
    }

    public function saveUserProfile(array $request, TrUser $trUser, array $provider): TrUser
    {
        if ($provider) {
            $request['social_type'] = $provider['provider'];
            $request['social_id'] = $provider['social_id'];
        }
        $trUser = TrUser::updateOrCreate(['id' => $trUser->id], $request);
        TrUserProfile::updateOrCreate(['tr_user_id' => $trUser->id], $request);

        if (Arr::get($request, 'delete_image')) {
            $this->deleteImage($trUser->id);
        }

        if (Arr::get($request, 'profile_upload_image')) {
            app(UploadImageService::class)
                ->set('ProfileIcon')->saveImage($request['profile_upload_image'], $trUser->id);
        }
        return $trUser;
    }

    private function deleteImage(int $tr_user_id)
    {
        $this->uploadImageService->set('ProfileIcon')->deleteImage($tr_user_id, 1);
    }

}
