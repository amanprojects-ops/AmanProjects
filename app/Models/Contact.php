<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'read',
        'replied_at',
    ];

    protected $casts = [
        'read' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }
}
