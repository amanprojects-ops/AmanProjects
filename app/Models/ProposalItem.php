<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProposalItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'service_id',
        'plan_id',
        'item_title',
        'item_description',
        'unit_price',
        'quantity',
        'line_total',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity'   => 'integer',
        'line_total' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::saving(function ($item) {
            $item->line_total = $item->unit_price * max(1, $item->quantity);
        });
    }

    public function proposal(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
