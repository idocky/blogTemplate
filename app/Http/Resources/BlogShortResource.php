<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogShortResource extends JsonResource
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
            'description' => $this->description,
            'short_description' => $this->short_description,
            'author' => $this->author,
            'images' => $this->images,
            'category' => $this->category,
            'subcategories' => $this->subcategories,
            'created_at' => Carbon::make($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
