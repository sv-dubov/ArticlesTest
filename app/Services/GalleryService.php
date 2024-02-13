<?php

namespace App\Services;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GalleryService
{
    protected Gallery $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function uploadGalleryImages(Gallery $gallery, $images)
    {
        $currentImages = $gallery->images ?: [];

        foreach ($images as $image) {
            $filename = 'gallery_' . Str::random(8);
            $image->storeAs('public/uploads/galleries/' . $gallery->id, $filename . '.' . $image->extension());

            $this->resizeAndStoreImage($gallery, $image, $filename, 1280);
            $this->resizeAndStoreImage($gallery, $image, $filename, 218, 218);

            $currentImages[] = $filename;
        }

        $gallery->images = $currentImages;
        $gallery->save();
    }

    public function removeGalleryImages($gallery)
    {
        if (!is_null($gallery->images)) {
            foreach ($gallery->images as $image) {
                $path = 'public/uploads/galleries/' . $gallery->id;
                Storage::deleteDirectory($path);
            }
        }
    }

    public function removeGalleryImage($gallery, $image)
    {
        if (!is_null($image)) {
            Storage::delete([
                'public/uploads/galleries/' . $gallery->id . '/' . $image . '.jpg',
                'public/uploads/galleries/' . $gallery->id . '/' . $image . '_1280.jpg',
                'public/uploads/galleries/' . $gallery->id . '/' . $image . '_1280.webp',
                'public/uploads/galleries/' . $gallery->id . '/' . $image . '_218.jpg',
                'public/uploads/galleries/' . $gallery->id . '/' . $image . '_218.webp',
            ]);
        }
    }

    protected function resizeAndStoreImage($gallery, $image, $filename, $width, $height = null)
    {
        $img = Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->encode('jpg')->save(storage_path('app/public/uploads/galleries/' . $gallery->id . '/' . $filename . '_' . $width . '.jpg'));
        $img->encode('webp')->save(storage_path('app/public/uploads/galleries/' . $gallery->id . '/' . $filename . '_' . $width . '.webp'));
    }
}
