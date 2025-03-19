<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'type',
        'status',
        'data',
        'from',
        'utm',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'utm' => 'array',
        ];
    }
}
