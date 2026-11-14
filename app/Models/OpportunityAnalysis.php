<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpportunityAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'overall_score',
        'web_score',
        'mobile_score',
        'seo_score',
        'reputation_score',
        'identified_gaps',
        'recommended_services',
        'executive_summary',
        'analyzer_version',
    ];

    protected $casts = [
        'overall_score'        => 'integer',
        'web_score'            => 'integer',
        'mobile_score'         => 'integer',
        'seo_score'            => 'integer',
        'reputation_score'     => 'integer',
        'identified_gaps'      => 'array',
        'recommended_services' => 'array',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
