<?php

namespace App\Services;

use App\Models\Video;

class VideoService
{
    public function saveVideo($dataArticle, $article)
    {
        foreach ($dataArticle['video'] as $value) {
            $value['article_id'] = $article->id;
            Video::create($value);
        }
    }

    public function updateVideo($dataArticle, $article)
    {
        $dataVideo = $dataArticle['video'];

        $article->videos->each(function ($video, $key) use (&$dataVideo) {
            if (isset($dataVideo[$key])) {
                $video->update([
                    'link' => $dataVideo[$key]['link'],
                    'sequence_number' => $dataVideo[$key]['sequence_number'],
                ]);
                unset($dataVideo[$key]);
            } else {
                $video->delete();
            }
        });

        foreach ($dataVideo as $key => $value) {
            $value['article_id'] = $article->id;
            Video::create($value);
        }
    }
}
