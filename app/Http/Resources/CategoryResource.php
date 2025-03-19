<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'link' => env('APP_URL') . '/blog/category/' . $this->slug,
            'description' => $this->description,
            'subcategories' => SubcategoryResource::collection($this->subcategories),
        ];
    }
}
