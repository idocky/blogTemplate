<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'second_name',
        'description',
        'image',
    ];

    protected $casts = [
        'image' => 'array',
    ];
}
