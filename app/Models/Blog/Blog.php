<?php

namespace App\Models\Blog;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\Contracts\Sitemapable;

class Blog extends Model implements Sitemapable
{
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
        'short_description',
        'reading_duration',
        'images',
        'content',
        'faq',
        'seo',
        'subcategories',
        'category_id',
        'author_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'images' => 'array',
        'content' => 'array',
        'faq' => 'array',
        'seo' => 'array',
        'subcategories' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot(): void
    {
        parent::boot();

//        self::saved(function () {
//            if (config('cache.default') === 'redis') {
//                Cache::tags('api_blogs_index')->flush();
//            }
//        });
//
//        self::deleted(function () {
//            if (config('cache.default') === 'redis') {
//                Cache::tags('api_blogs_index')->flush();
//            }
//        });
    }

    public function toSitemapTag(): string|array
    {
        return frontendUrl('/' . trim($this->slug, '/')) . '/';
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategoriesTitles()
    {
        return Subcategory::whereIn('id', $this->subcategories)->get()->pluck('title');
    }
}
