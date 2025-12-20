<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'stories';

    protected $fillable = [
        'title',
        'images',
        'cover',
        'order',
        'active'
    ];

    protected $casts = [
        'images' => 'array',
        'active' => 'boolean',
    ];
}
