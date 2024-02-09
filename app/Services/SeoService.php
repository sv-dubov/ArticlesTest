<?php

namespace App\Services;

use App\Models\Article;

class SeoService
{
    public function saveSeo(Article $article, $request)
    {
        $locales = config('translatable.locales');
        $seoData = [];

        foreach ($locales as $locale) {
            $seoData[$locale] = [
                'title' => $request->input("{$locale}.seo_title"),
                'description' => $request->input("{$locale}.seo_description"),
            ];
        }

        $article->seo()->updateOrCreate(['article_id' => $article->id], $seoData);
    }
}
