<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SyncBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'idempotency_key',
        'payload_hash',
        'client_name',
        'client_version',
        'total_records',
        'inserted_records',
        'updated_records',
        'skipped_records',
        'failed_records',
        'status',
        'response_cache',
    ];

    protected $casts = [
        'total_records'    => 'integer',
        'inserted_records' => 'integer',
        'updated_records'  => 'integer',
        'skipped_records'  => 'integer',
        'failed_records'   => 'integer',
        'response_cache'   => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function integrationLogs(): HasMany
    {
        return $this->hasMany(IntegrationLog::class);
    }
}
