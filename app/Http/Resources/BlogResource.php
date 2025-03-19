<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'reading_duration' => $this->reading_duration,
            'category' => $this->category,
            'categories' => [$this->category->title, ...$this->subcategoriesTitles()],
            'subcategories' => $this->subcategories,
            'content' => $this->content,
            'created_at' => Carbon::make($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::make($this->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
