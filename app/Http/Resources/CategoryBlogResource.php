<?php

namespace App\Http\Resources;

use App\Models\Blog\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryBlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $articles = $this->subcategories->reduce(function ($carry, $subcategory) {
            $blogs = Blog::whereJsonContains('subcategories', (int)$subcategory->id)->limit(7)->get();
            return $carry->merge($blogs);
        }, collect());

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'link' => '/blog/category/' . $this->slug,
            'description' => $this->description,
            'subcategories' => SubcategoryMiniResource::collection($this->subcategories),
            'articles' => BlogShortResource::collection($articles),
        ];
    }
}
