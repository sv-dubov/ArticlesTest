<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleSaveRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleImageService;
use App\Services\SeoService;
use App\Services\VideoService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
        public ArticleImageService $articleImageService,
        public SeoService $seoService,
        public VideoService $videoService
    )
    {
    }

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

    public function store(ArticleSaveRequest $request)
    {
        $dataArticle = $request->except('image');
        $article = Article::create($dataArticle);
        $this->articleImageService->uploadArticleImage($article, $request->validated()['image'] ?? []);

        $this->seoService->saveSeo($article, $request);

        $this->videoService->saveVideo($dataArticle, $article);

        return redirect()->route('articles.index')->with('status', __('messages.successfully_added'));
    }

    public function edit(Article $article)
    {
        $categories = Category::listsTranslations('title')->pluck('title', 'id');
        return view('admin.articles.edit', compact('categories','article'));
    }

    public function update(Article $article, ArticleSaveRequest $request)
    {
        $dataArticle = $request->except('image');

        if ($request->has('image')) {
            $this->articleImageService->removeArticleImage($article->image);
        }

        $article->update($request->except('image'));
        $this->articleImageService->uploadArticleImage($article, $request->validated()['image'] ?? []);

        $this->seoService->saveSeo($article, $request);

        $this->videoService->updateVideo($dataArticle, $article);

        return redirect()->route('articles.index')->with('status', __('messages.successfully_edited'));
    }

    public function destroy(Article $article)
    {
        $this->articleImageService->removeArticleImage($article->image);
        $article->delete();
        return redirect()->route('articles.index')->with('status', __('messages.successfully_deleted'));
    }
}
