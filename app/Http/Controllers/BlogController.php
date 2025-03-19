<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogShortResource;
use App\Http\Resources\CategoryBlogResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Blog\Blog;
use App\Models\Blog\Category;
use App\Models\Blog\Subcategory;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at')->cursorPaginate(10);
        $categories = Category::where('is_active', true)->limit(3)->get();

        return Inertia::render('Blog/Blog', [
            'blogs' => BlogShortResource::collection($blogs),
            'categories' => CategoryBlogResource::collection($categories),
        ]);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $categories = Category::where('is_active', true)->limit(3)->get();

        return Inertia::render('Blog/Article', [
            'blog' => new BlogResource($blog),
            'categories' => CategoryBlogResource::collection($categories),
        ]);
    }

    public function category($slug)
    {
        $subCategory = Subcategory::where('slug', $slug)->firstOrFail();
        $categories = Category::where('is_active', true)->limit(3)->get();
        $articles = Blog::cursorPaginate(15);

        return Inertia::render('Blog/Category', [
            'categories' => CategoryBlogResource::collection($categories),
            'subCategory' => new SubcategoryResource($subCategory),
            'articles' => BlogShortResource::collection($articles)->toArray(request())
        ]);
    }
}
