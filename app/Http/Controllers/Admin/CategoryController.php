<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorySaveRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withTranslation()->filter($request)->latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategorySaveRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')->with('status', __('messages.successfully_added'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Category $category, CategorySaveRequest $request)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')->with('status', __('messages.successfully_edited'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('status', __('messages.successfully_deleted'));
    }
}
