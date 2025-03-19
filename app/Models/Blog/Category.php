<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'blog_categories';

    protected $fillable = [
        'title',
        'is_active',
        'slug',
        'description',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
