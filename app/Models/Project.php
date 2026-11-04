<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'tech_stack_tags',
        'github_link',
        'live_demo_link',
        'thumbnail_image',
        'featured',
        'status',
    ];

    protected static function booted()
    {
        static::saving(function ($project) {
            if (empty($project->slug)) {
                $project->slug = \Illuminate\Support\Str::slug($project->title ?? 'project-' . time());
            }
        });
    }

    public function getSlugAttribute($value): string
    {
        return !empty($value) ? $value : \Illuminate\Support\Str::slug($this->title ?? 'project-' . $this->id);
    }

    protected $casts = [
        'featured' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function getTechStackArrayAttribute(): array
    {
        if (!$this->tech_stack_tags) {
            return [];
        }
        return array_map('trim', explode(',', $this->tech_stack_tags));
    }

    /**
     * Get the albums for the project.
     */
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    /**
     * Get all of the images for the project's albums.
     */
    public function albumImages(): HasManyThrough
    {
        return $this->hasManyThrough(AlbumImage::class, Album::class);
    }
}
