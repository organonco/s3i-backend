<?php

namespace App\Http\Controllers\Web\Course;

use App\Http\Controllers\Web\Controller;
use App\Http\Resources\Model\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Category/Index', [
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Category/Edit', [
            'category' => new CategoryResource($category)
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $request->validate(['name' => 'required']);
        $category->update($request->all());
        return redirect()->route('category.index');
    }

    public function create()
    {
        return Inertia::render('Category/Create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create($request->all());
        return redirect()->route('category.index');
    }
}
