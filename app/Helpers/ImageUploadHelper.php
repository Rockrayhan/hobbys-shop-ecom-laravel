<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\WebpEncoder;

class ImageUploadHelper
{
    /**
     * Upload & compress image as WebP (no resize)
     */
    public static function uploadWebp(
        ?UploadedFile $file,
        string $folder = 'uploads/products',
        string $namePrefix = 'product',
        int $quality = 75
    ): ?string {
        if (!$file) {
            return null;
        }

        $path = public_path($folder);

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $filename = "{$namePrefix}-" . uniqid() . ".webp";
        $fullPath = $path . '/' . $filename;

        Image::read($file)
            ->encode(new WebpEncoder(quality: $quality))
            ->save($fullPath);

        return "{$folder}/{$filename}";
    }

    /**
     * Safe delete
     */
    public static function delete(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
