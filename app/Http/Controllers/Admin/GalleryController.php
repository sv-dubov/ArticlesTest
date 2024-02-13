<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GallerySaveRequest;
use App\Models\Article;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct(
        public GalleryService $galleryService,
    )
    {
    }

    public function index(Request $request)
    {
        $articles = Article::listsTranslations('title')->pluck('title', 'id');
        $galleries = Gallery::with('article')->filter($request)->latest()->paginate(20);
        return view('admin.galleries.index', compact('galleries', 'articles'));
    }

    public function create()
    {
        $articles = Article::listsTranslations('title')->pluck('title', 'id');
        return view('admin.galleries.create', compact('articles'));
    }

    public function store(GallerySaveRequest $request)
    {
        $gallery = Gallery::create($request->except('images'));
        $this->galleryService->uploadGalleryImages($gallery, $request->validated()['images'] ?? []);
        return redirect()->route('galleries.index')->with('status', __('messages.successfully_added'));
    }

    public function edit(Gallery $gallery)
    {
        $articles = Article::listsTranslations('title')->pluck('title', 'id');
        return view('admin.galleries.edit', compact('gallery', 'articles'));
    }

    public function update(GallerySaveRequest $request, Gallery $gallery)
    {
        $gallery->update($request->except('images'));

        if ($request->hasFile('images')) {
            $this->galleryService->uploadGalleryImages($gallery, $request->validated()['images'] ?? []);
        }

        return redirect()->route('galleries.index')->with('success', __('messages.successfully_edited'));
    }

    public function destroy(Gallery $gallery)
    {
        $this->galleryService->removeGalleryImages($gallery);
        $gallery->delete();
        return redirect()->route('galleries.index')->with('status', __('messages.successfully_deleted'));
    }

    public function deleteImage(Gallery $gallery, $image)
    {
        $images = $gallery->images;
        $index = array_search($image, $images);

        if ($index !== false) {
            unset($images[$index]);
        }

        $gallery->images = array_values($images);
        $gallery->save();

        $this->galleryService->removeGalleryImage($gallery, $image);

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
