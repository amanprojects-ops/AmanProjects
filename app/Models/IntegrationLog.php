<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IntegrationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'sync_batch_id',
        'lead_id',
        'event',
        'level',
        'message',
        'payload',
        'response',
        'error_code',
        'retry_count',
    ];

    protected $casts = [
        'payload'     => 'array',
        'response'    => 'array',
        'retry_count' => 'integer',
    ];

    public function syncBatch(): BelongsTo
    {
        return $this->belongsTo(SyncBatch::class);
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
