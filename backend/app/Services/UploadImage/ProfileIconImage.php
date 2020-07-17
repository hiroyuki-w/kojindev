<?php

namespace App\Services\UploadImage;

use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class ProfileIconImage implements UploadImageInterface
{

    public function saveMain(UploadedFile $imageFile, string $filename): void
    {
        $image = Image::make($imageFile);
        $image->encode('png');
        $image->fit(150, 150);
        $image->save($filename);
    }

    public function saveThumbnail(UploadedFile $imageFile, string $filename): void
    {
        //サムネイル画像なし
        return;
    }

    public function getMaxImageCount(): int
    {
        return 1;
    }

    public function getFormatedFilename(int $group, int $no): string
    {
        return sprintf('%06d', $group).'.png';
    }

    public function getImageBasePath(): string
    {
        return 'img/users';
    }
}
