<?php

namespace App\Helper\admin;

use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ImageUpload
{
    public static function updateImage($oldImage, string $path, $newImage): ?string
    {
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        if ($oldImage && file_exists($fullPath . $oldImage)) {
            unlink($fullPath . $oldImage);
        }

        if ($newImage) {
            $originalExt = strtolower($newImage->getClientOriginalExtension());
            $fileName = self::uniqueFileName($newImage, '', $originalExt);
            $newImage->move($fullPath, $fileName);
            return $fileName;
        }

        return null;
    }

    public static function saveImage(string $path, $newImage): ?string
    {
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        if ($newImage) {
            $originalExt = strtolower($newImage->getClientOriginalExtension());
            $fileName = self::uniqueFileName($newImage, '', $originalExt);
            $newImage->move($fullPath, $fileName);
            return $fileName;
        }

        return null;
    }

    public static function addImage(int $height, int $width, string $path, $newImage, string $prefix = ''): ?string
    {
        if ($newImage) {
            $ext = strtolower($newImage->getClientOriginalExtension());
            $fileName = self::uniqueFileName($newImage, $prefix, $ext);

            $manager = new ImageManager(new GdDriver());
            $image = $manager->read($newImage->getRealPath());

            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $fullPath = public_path($path);
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            $imageStream = self::encodeByExtension($image, $ext);
            file_put_contents($fullPath . $fileName, $imageStream);

            return $fileName;
        }

        return null;
    }

    public static function myUpdateImage(?string $oldImage, int $height, int $width, string $path, $newImage): ?string
    {
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        if ($oldImage && file_exists($fullPath . $oldImage)) {
            unlink($fullPath . $oldImage);
        }

        if ($newImage) {
            $ext = strtolower($newImage->getClientOriginalExtension());
            $fileName = self::uniqueFileName($newImage, '', $ext);

            $manager = new ImageManager(new GdDriver());
            $image = $manager->read($newImage->getRealPath());

            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageStream = self::encodeByExtension($image, $ext);
            file_put_contents($fullPath . $fileName, $imageStream);

            return $fileName;
        }

        return null;
    }

    public static function base64(string $img, string $path): ?string
    {
        if (!empty($img)) {
            preg_match('/^data:image\/(\w+);base64,/', $img, $type);
            $img = preg_replace('/^data:image\/\w+;base64,/', '', $img);
            $img = str_replace(' ', '+', $img);

            $extension = strtolower($type[1] ?? 'png');
            $fileName = uniqid() . '.' . $extension;
            $data = base64_decode($img);

            $fullPath = public_path($path);
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            file_put_contents($fullPath . $fileName, $data);

            return asset($path . $fileName);
        }

        return null;
    }

    public static function uploadMultipleImages(array $images, int $height, int $width, string $path, string $prefix = ''): array
    {
        $savedImages = [];
        $manager = new ImageManager(new GdDriver());
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        foreach ($images as $image) {
            $ext = strtolower($image->getClientOriginalExtension());
            $fileName = self::uniqueFileName($image, $prefix, $ext);
            $resized = $manager->read($image->getRealPath());

            $resized->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imageStream = self::encodeByExtension($resized, $ext);
            file_put_contents($fullPath . $fileName, $imageStream);

            $savedImages[] = $fileName;
        }

        return $savedImages;
    }

    public static function uploadMultipleImagesOriginal(
        array $images,
        string $path,
        string $prefix = ''
    ): array {
        $savedImages = [];
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        foreach ($images as $image) {
            $ext = strtolower($image->getClientOriginalExtension());
            $fileName = self::uniqueFileName($image, $prefix, $ext);

            // Move without resizing (original quality)
            $image->move($fullPath, $fileName);

            $savedImages[] = $fileName;
        }

        return $savedImages;
    }


    private static function uniqueFileName($image, string $prefix = '', string $ext = ''): string
    {
        $ext = $ext ?: $image->getClientOriginalExtension();
        $name = $prefix . Str::random(10) . '_' . time();
        return strtolower(preg_replace('/[^A-Za-z0-9_\-\.]/', '', $name)) . '.' . $ext;
    }

    private static function encodeByExtension($image, string $ext)
    {
        return match ($ext) {
            'png' => $image->toPng(),
            'gif' => $image->toGif(),
            'webp' => $image->toWebp(90),
            'bmp' => $image->toBmp(),
            default => $image->toJpeg(90), // fallback to JPEG
        };
    }
}
