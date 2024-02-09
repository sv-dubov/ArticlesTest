<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleImageService
{
    protected Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function uploadArticleImage(Article $article, $image)
    {
        if ($image == null) {
            return;
        }

        $filename = 'article_' . Str::random(8) . '.' . $image->extension();
        $image->storeAs('public/uploads/articles', $filename);
        $article->image = $filename;
        $article->save();
    }

    public function removeArticleImage($image)
    {
        if ($image != null) {
            Storage::delete('public/uploads/articles/' . $image);
        }
    }
}
