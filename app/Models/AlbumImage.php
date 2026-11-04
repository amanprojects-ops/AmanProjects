<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlbumImage extends Model
{
    protected $fillable = [
        'album_id',
        'image_path',
        'caption',
        'sort_order',
        'is_active',
    ];

    /**
     * Get the album that owns the image.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
