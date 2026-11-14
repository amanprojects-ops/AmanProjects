<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_name',
        'slug',
        'status',
        'category',
        'website',
        'normalized_domain',
        'primary_phone',
        'primary_email',
        'address',
        'latitude',
        'longitude',
        'google_place_id',
        'google_cid',
        'rating',
        'review_count',
        'provenance_source',
        'provenance_url',
        'captured_at',
        'is_opted_out',
        'retention_until',
        'assigned_user_id',
    ];

    protected $casts = [
        'latitude'        => 'decimal:7',
        'longitude'       => 'decimal:7',
        'rating'          => 'decimal:2',
        'review_count'    => 'integer',
        'is_opted_out'    => 'boolean',
        'captured_at'     => 'datetime',
        'retention_until' => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function ($lead) {
            if (empty($lead->slug)) {
                $lead->slug = Str::slug($lead->business_name ?? 'lead-' . time());
            }
            if (!empty($lead->website) && empty($lead->normalized_domain)) {
                $parsed = parse_url($lead->website, PHP_URL_HOST);
                $lead->normalized_domain = strtolower(preg_replace('/^www\./i', '', $parsed ?: $lead->website));
            }
            if (empty($lead->retention_until)) {
                $lead->retention_until = now()->addDays(90);
            }
        });
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(LeadContact::class);
    }

    public function socialProfiles(): HasMany
    {
        return $this->hasMany(LeadSocialProfile::class);
    }

    public function opportunityAnalyses(): HasMany
    {
        return $this->hasMany(OpportunityAnalysis::class);
    }

    public function latestAnalysis(): HasOne
    {
        return $this->hasOne(OpportunityAnalysis::class)->latestOfMany();
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    public function integrationLogs(): HasMany
    {
        return $this->hasMany(IntegrationLog::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_opted_out', false);
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    public function scopeNewLeads($query)
    {
        return $query->where('status', 'new');
    }
}
