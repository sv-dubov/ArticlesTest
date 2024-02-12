<?php

namespace App\Services;

use App\Models\Text;

class TextService
{
    public function saveText($dataArticle, $article)
    {
        $hasContent = collect($dataArticle['text'])->some(function ($item) {
            return collect($item)->has('content') && $item['content'] !== null;
        });

        if ($hasContent) {
            foreach ($dataArticle['text'] as $value) {
                $value['article_id'] = $article->id;
                Text::create($value);
            }
        }
    }

    public function updateText($dataArticle, $article)
    {
        $dataText = $dataArticle['text'];

        $hasContent = collect($dataText)->some(function ($item) {
            return collect($item)->has('content') && $item['content'] !== null;
        });

        $article->texts->each(function ($text, $key) use (&$dataText) {
            if (isset($dataText[$key])) {
                $text->update([
                    'sequence_number' => $dataText[$key]['sequence_number'],
                    'pl' => [
                        'content' => $dataText[$key]['pl']['content'],
                    ],
                    'uk' => [
                        'content' => $dataText[$key]['uk']['content'],
                    ],
                    'en' => [
                        'content' => $dataText[$key]['en']['content'],
                    ],
                ]);
                unset($dataText[$key]);
            } else {
                $text->delete();
            }
        });

        if ($hasContent) {
            foreach ($dataText as $value) {
                $value['article_id'] = $article->id;
                Text::create($value);
            }
        }
    }
}
