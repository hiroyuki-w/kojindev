<?php

namespace App\Services\UploadImage;

use Storage;
use Illuminate\Http\UploadedFile;

class UploadImageService
{

    protected string $no_image = 'no_image.png';
    protected string $thumbnail_prefix = 'r_';

    protected UploadImageInterface $target;

    public function set(string $target): UploadImageService
    {
        $className = "App\Services\UploadImage\\{$target}Image";
        $this->target = new $className;
        return $this;
    }

    public function getSavedImages(int $id): array
    {
        $images = [
            'main' => [],
            'thum' => [],
        ];
        for ($count = 1; $count <= $this->target->getMaxImageCount(); $count++) {
            $filename = $this->target->getFormatedFilename($id, $count);
            if (file_exists($this->getPath($filename))) {
                $images['main'][$count] = $this->getUrl($filename);
                $images['thum'][$count] = $this->getUrl($this->thumbnail_prefix.$filename);
            }
        }
        if (count($images['main']) === 0) {
            $images['main'][1] = $this->getUrl($this->no_image);
            $images['thum'][1] = $this->getUrl($this->thumbnail_prefix.$this->no_image);
        }
        return $images;
    }

    public function saveImage(UploadedFile $imageFile, int $group, int $no = 0): void
    {
        $filename = $this->target->getFormatedFilename($group, $no);
        $this->target->saveMain($imageFile, $this->getPath($filename));
        $this->target->saveThumbnail($imageFile, $this->getPath($this->thumbnail_prefix.$filename));
    }

    public function deleteImage(int $group, int $no = 0): void
    {
        $filename = $this->target->getFormatedFilename($group, $no);
        Storage::disk('public')->delete($this->target->getImageBasePath().'/'.$filename);
    }

    protected function getPath(string $filename): string
    {
        return Storage::disk('public')->path($this->target->getImageBasePath().'/'.$filename);
    }

    protected function getUrl(string $filename): string
    {
        return Storage::disk('public')->url($this->target->getImageBasePath().'/'.$filename);
    }
}
