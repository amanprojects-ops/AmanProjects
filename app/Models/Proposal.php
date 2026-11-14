<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Proposal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lead_id',
        'approved_by_user_id',
        'proposal_number',
        'title',
        'status',
        'subtotal',
        'discount_amount',
        'tax_amount',
        'total_amount',
        'currency',
        'valid_until',
        'terms_and_conditions',
        'public_view_token',
        'approved_at',
        'sent_at',
        'viewed_at',
        'accepted_at',
    ];

    protected $casts = [
        'subtotal'        => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount'      => 'decimal:2',
        'total_amount'    => 'decimal:2',
        'valid_until'     => 'date',
        'approved_at'     => 'datetime',
        'sent_at'         => 'datetime',
        'viewed_at'       => 'datetime',
        'accepted_at'     => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($proposal) {
            if (empty($proposal->proposal_number)) {
                $proposal->proposal_number = 'PROP-' . date('Y') . '-' . strtoupper(Str::random(6));
            }
            if (empty($proposal->public_view_token)) {
                $proposal->public_view_token = Str::random(48);
            }
            if (empty($proposal->valid_until)) {
                $proposal->valid_until = now()->addDays(30);
            }
        });
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProposalItem::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }

    public function isApproved(): bool
    {
        return !empty($this->approved_at) && !empty($this->approved_by_user_id);
    }
}
