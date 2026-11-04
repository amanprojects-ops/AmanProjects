<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'badge',
        'desc',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'features',
        'pricing_tiers',
        'process_steps',
        'faqs',
        'color',
        'bg',
        'icon_path',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features'      => 'array',
        'pricing_tiers' => 'array',
        'process_steps' => 'array',
        'faqs'          => 'array',
        'is_active'     => 'boolean',
        'sort_order'    => 'integer',
    ];

    /**
     * Scope for active services ordered by sort order
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Dynamic URL attribute for canonical link
     */
    public function getUrlAttribute(): string
    {
        if (!empty($this->slug)) {
            return url('/' . ltrim($this->slug, '/'));
        }

        return match ($this->id) {
            1       => url('/website-developer-in-saharsa'),
            2       => url('/saas-development-in-saharsa'),
            3       => url('/cybersecurity-services-in-saharsa'),
            4       => url('/api-development-in-saharsa'),
            5       => url('/software-developer-in-saharsa'),
            default => url('/services/' . $this->id),
        };
    }

    /**
     * Auto-generate slug if not provided on save
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($service) {
            if (empty($service->slug) && !empty($service->title)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }
}
