<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'type',
        'value',
        'normalized_value',
        'is_primary',
        'is_offline_valid',
        'is_online_valid',
        'validation_provider',
        'validation_details',
    ];

    protected $casts = [
        'is_primary'         => 'boolean',
        'is_offline_valid'   => 'boolean',
        'is_online_valid'    => 'boolean',
        'validation_details' => 'array',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
