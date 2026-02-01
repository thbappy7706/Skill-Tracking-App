<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id',
        'title',
        'description',
        'is_completed',
        'target_date',
        'completed_at',
        'proof_url',
        'notes',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'target_date' => 'date',
        'completed_at' => 'date',
    ];

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
