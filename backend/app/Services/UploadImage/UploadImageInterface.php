<?php

namespace App\Services\UploadImage;

use Illuminate\Http\UploadedFile;

interface UploadImageInterface
{

    public function saveMain(UploadedFile $originImage, string $filename): void;

    public function saveThumbnail(UploadedFile $originImage, string $filename): void;

    public function getFormatedFilename(int $group, int $no): string;

    public function getMaxImageCount(): int;

    public function getImageBasePath(): string;

}
