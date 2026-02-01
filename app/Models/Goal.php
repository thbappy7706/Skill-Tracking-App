<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
        'priority',
        'start_date',
        'target_date',
        'completed_at',
        'progress_percentage',
        'notes',
    ];

    protected $casts = [
        'priority' => 'integer',
        'start_date' => 'date',
        'target_date' => 'date',
        'completed_at' => 'date',
        'progress_percentage' => 'integer',
    ];

    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->target_date || $this->status === 'completed') {
            return null;
        }

        $today = now()->startOfDay();
        $targetDate = $this->target_date->startOfDay();

        return $targetDate->diffInDays($today, false);
    }

    public function getIsOverdueAttribute(): bool
    {
        if (!$this->target_date || $this->status === 'completed') {
            return false;
        }

        return now()->isAfter($this->target_date);
    }
}
