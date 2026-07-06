<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'price', 'period', 'desc', 'color', 'btn_style', 'featured', 'features'];

    protected $casts = [
        'features' => 'array',
        'featured' => 'boolean',
    ];
}
