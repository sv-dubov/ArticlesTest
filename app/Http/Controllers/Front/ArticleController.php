<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::withTranslation()->where('is_public', Article::PUBLIC)->latest('publish_date')->paginate(4);
        return view('front.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $texts = $article->texts()->get();
        $videos = $article->videos()->get();
        $galleries = $article->galleries()->get();
        return view('front.articles.show', compact('article', 'texts', 'videos', 'galleries'));
    }
}
