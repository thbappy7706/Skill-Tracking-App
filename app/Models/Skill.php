<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'current_level',
        'target_level',
        'importance',
        'status',
        'started_at',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'current_level' => 'integer',
        'target_level' => 'integer',
        'importance' => 'integer',
        'started_at' => 'date',
        'completed_at' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class, 'category_id');
    }

    public function learningResources(): HasMany
    {
        return $this->hasMany(LearningResource::class, 'skill_id');
    }

    public function practices(): HasMany
    {
        return $this->hasMany(Practice::class, 'skill_id');
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(Milestone::class, 'skill_id');
    }

    public function getProgressPercentageAttribute(): float
    {
        if ($this->target_level == 0) {
            return 0;
        }

        return round(($this->current_level / $this->target_level) * 100, 2);
    }

    public function getLevelNameAttribute(): string
    {
        return match($this->current_level) {
            0 => 'Not Started',
            1 => 'Beginner',
            2 => 'Elementary',
            3 => 'Intermediate',
            4 => 'Advanced',
            5 => 'Expert',
            default => 'Unknown',
        };
    }
}
