<?php

namespace App\Services\UploadImage;

use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

class ApplicationImage implements UploadImageInterface
{

    public function saveMain(UploadedFile $imageFile, string $filename): void
    {
        $image = Image::make($imageFile);
        $image->encode('png');
        $image->widen(1280, function ($constraint) {
            $constraint->upsize();
        });


        $image->save($filename);
    }

    public function saveThumbnail(UploadedFile $imageFile, string $filename): void
    {
        $image = Image::make($imageFile);
        $image->widen(300, function ($constraint) {
            $constraint->upsize();
        });
        $image->heighten(340, function ($constraint) {
            $constraint->upsize();
        });

        $image->save($filename);
    }

    public function getMaxImageCount(): int
    {
        return 3;
    }

    public function getFormatedFilename(int $group, int $no): string
    {
        return sprintf('%06d', $group).'_'.sprintf("%02d", $no).'.png';
    }

    public function getImageBasePath(): string
    {
        return 'img/applications';
    }
}
