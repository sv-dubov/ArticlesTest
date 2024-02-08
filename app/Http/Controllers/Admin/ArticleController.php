<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleSaveRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleImageService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::listsTranslations('title')->pluck('title', 'id');
        $articles = Article::withTranslation()->latest()->paginate(20);
        return view('admin.articles.index', compact('categories', 'articles'));
    }

    public function create()
    {
        $categories = Category::listsTranslations('title')->pluck('title', 'id');
        return view('admin.articles.create', compact('categories'));
    }

    public function store(ArticleSaveRequest $request, ArticleImageService $articleImageService)
    {
        $article = Article::create($request->except('image'));
        $articleImageService->uploadArticleImage($article, $request->validated()['image'] ?? []);
        return redirect()->route('articles.index')->with('status', __('messages.successfully_added'));
    }

    public function edit(Article $article)
    {
        $categories = Category::listsTranslations('title')->pluck('title', 'id');
        return view('admin.articles.edit', compact('categories','article'));
    }

    public function update(Article $article, ArticleSaveRequest $request, ArticleImageService $articleImageService)
    {
        if ($request->has('image')) {
            $articleImageService->removeArticleImage($article->image);
        }

        $article->update($request->except('image'));
        $articleImageService->uploadArticleImage($article, $request->validated()['image'] ?? []);
        return redirect()->route('articles.index')->with('status', __('messages.successfully_edited'));
    }

    public function destroy(Article $article, ArticleImageService $articleImageService)
    {
        $articleImageService->removeArticleImage($article->image);
        $article->delete();
        return redirect()->route('articles.index')->with('status', __('messages.successfully_deleted'));
    }
}
