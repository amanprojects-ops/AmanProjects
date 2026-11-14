<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadSocialProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'platform',
        'profile_url',
        'handle',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
