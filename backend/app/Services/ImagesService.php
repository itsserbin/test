<?php

namespace App\Services;

use App\Enums\ImageExtensionsEnum;
use App\Exceptions\JsonResponseException;
use App\Repositories\ImagesRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\Response;

class ImagesService
{
    /**
     * @throws JsonResponseException
     */
    final public function uploadImage(
        mixed       $image,
        string      $path = '/',
        string|null $filename = null,
        int         $quality = 100
    )
    {
        if (!$filename) {
            $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        }

        if (!$this->isUnique($path, $filename)) {
            throw new JsonResponseException('Image duplicated.', Response::HTTP_CONFLICT);
        }

        $this->upload($path, $filename, $image, $quality);
    }

    /**
     * @throws JsonResponseException
     */
    private function upload(string $path, string $filename, mixed $image, int $quality): void
    {
        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->save(quality: $quality);
            $path = $path . $filename;
            Storage::put($path . '.' . ImageExtensionsEnum::JPEG->value, $image->toJpeg());
            Storage::put($path . '.' . ImageExtensionsEnum::WEBP->value, $image->toWebp());
        } catch (Exception $e) {
            throw new JsonResponseException('Error loading image: ' . $e->getMessage() , Response::HTTP_CONFLICT);
        }
    }

    private function isUnique(string $path, string $filename): bool
    {
        return $this->isUniqueFiles($path . $filename) && $this->isUniqueDB($path, $filename);
    }

    private function isUniqueFiles(string $path): bool
    {
        $jpeg = !Storage::exists($path . ImageExtensionsEnum::JPEG->value);
        $webp = !Storage::exists($path . ImageExtensionsEnum::WEBP->value);

        return $jpeg && $webp;
    }

    private function isUniqueDB(string $path, string $filename): bool
    {
        return !(new ImagesRepository())->getModelClass()::where(function ($q) use ($path, $filename) {
            $q->where('path', $path);
            $q->where('filename', $filename);
        })->first();
    }

    private function createFilename(string $filename): string
    {
        return $filename . '_' . preg_replace('/[^0-9]/', '', Carbon::now()->format('dmYH:i'));
    }

}
