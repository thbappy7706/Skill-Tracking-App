<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class, 'category_id');
    }

    public function getProgressPercentageAttribute(): float
    {
        $skills = $this->skills;

        if ($skills->isEmpty()) {
            return 0;
        }

        $totalProgress = $skills->sum('current_level');
        $maxProgress = $skills->count() * 5; // Assuming max level is 5

        return round(($totalProgress / $maxProgress) * 100, 2);
    }
}
