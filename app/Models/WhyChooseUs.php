<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $table = 'why_choose_uses';

    protected $fillable = ['title', 'desc', 'color', 'icon'];
}
