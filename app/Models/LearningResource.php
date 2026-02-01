<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LearningResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id',
        'title',
        'type',
        'url',
        'description',
        'status',
        'rating',
        'started_at',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'rating' => 'integer',
        'started_at' => 'date',
        'completed_at' => 'date',
    ];

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
