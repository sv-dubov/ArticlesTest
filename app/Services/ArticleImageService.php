<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ArticleImageService
{
    protected Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function uploadArticleImage(Article $article, $image)
    {
        if (is_null($image)) {
            return;
        }

        $filename = 'article_' . Str::random(8);

        $image->storeAs('public/uploads/articles', $filename . '.' . $image->extension());

        $this->resizeAndStoreImage($image, $filename, 1280);
        $this->resizeAndStoreImage($image, $filename, 636);

        $article->image = $filename;
        $article->save();
    }

    public function removeArticleImage($image)
    {
        if (!is_null($image)) {
            Storage::delete([
                'public/uploads/articles/' . $image . '.jpg',
                'public/uploads/articles/' . $image . '_1280.jpg',
                'public/uploads/articles/' . $image . '_1280.webp',
                'public/uploads/articles/' . $image . '_636.jpg',
                'public/uploads/articles/' . $image . '_636.webp',
            ]);
        }
    }

    protected function resizeAndStoreImage($image, $filename, $width, $height = null)
    {
        $img = Image::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->encode('jpg')->save(storage_path('app/public/uploads/articles/' . $filename . '_' . $width . '.jpg'));
        $img->encode('webp')->save(storage_path('app/public/uploads/articles/' . $filename . '_' . $width . '.webp'));
    }
}
