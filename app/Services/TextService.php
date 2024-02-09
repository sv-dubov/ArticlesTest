<?php

namespace App\Services;

use App\Models\Text;

class TextService
{
    public function saveText($dataArticle, $article)
    {
        foreach ($dataArticle['text'] as $value) {
            $value['article_id'] = $article->id;
            Text::create($value);
        }
    }

    public function updateText($dataArticle, $article)
    {
        $dataText = $dataArticle['text'];

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

        foreach ($dataText as $key => $value) {
            $value['article_id'] = $article->id;
            Text::create($value);
        }
    }
}
