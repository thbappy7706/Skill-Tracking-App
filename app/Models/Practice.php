<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Practice extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id',
        'title',
        'description',
        'duration_minutes',
        'practiced_at',
        'difficulty',
        'quality_rating',
        'notes',
        'repository_url',
    ];

    protected $casts = [
        'duration_minutes' => 'integer',
        'practiced_at' => 'datetime',
        'difficulty' => 'integer',
        'quality_rating' => 'integer',
    ];

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function getDurationFormattedAttribute(): string
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;

        if ($hours > 0) {
            return "{$hours}h {$minutes}m";
        }

        return "{$minutes}m";
    }
}
