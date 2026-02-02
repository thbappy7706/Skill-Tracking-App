<?php

namespace App\Livewire;

use App\Models\Goal;
use App\Models\Practice;
use App\Models\Skill;
use App\Models\SkillCategory;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('My Skill Dashboard - SkillUpx')]
class Dashboard extends Component
{
    public array $stats = [];
    public $recentPractices;
    public $categories;
    public $skillsByLevel;
    public $upcomingGoals;

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Get user stats
        $this->stats = [
            'total_skills' => Skill::count(),
            'proficient_skills' => Skill::whereIn('status', ['proficient', 'expert'])->count(),
            'learning_skills' => Skill::whereIn('status', ['learning', 'practicing'])->count(),
            'total_practice_hours' => round(Practice::sum('duration_minutes') / 60, 1),
            'this_week_hours' => round(Practice::where('practiced_at', '>=', now()->startOfWeek())
                    ->sum('duration_minutes') / 60, 1),
            'active_goals' => Goal::where('status', 'in_progress')->count(),
            'avg_practice_quality' => round(Practice::avg('quality_rating'), 1),
            'current_streak' => $this->calculateStreak(),
        ];

        // Get recent practices
        $this->recentPractices = Practice::with('skill')
            ->latest('practiced_at')
            ->limit(5)
            ->get();

        // Get categories with progress
        $this->categories = SkillCategory::withCount('skills')
            ->orderBy('order')
            ->get()
            ->map(function ($category) {
                $category->progress = $this->calculateCategoryProgress($category);
                return $category;
            });

        // Get skills by level for chart
        $this->skillsByLevel = Skill::selectRaw('current_level, COUNT(*) as count')
            ->groupBy('current_level')
            ->get()
            ->pluck('count', 'current_level');

        // Get upcoming goals
        $this->upcomingGoals = Goal::whereIn('status', ['planned', 'in_progress'])
            ->whereNotNull('target_date')
            ->orderBy('target_date')
            ->limit(3)
            ->get();
    }

    private function calculateStreak(): int
    {
        $practices = Practice::orderBy('practiced_at', 'desc')->get();

        if ($practices->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $currentDate = now()->startOfDay();

        foreach ($practices as $practice) {
            $practiceDate = $practice->practiced_at->startOfDay();

            if ($practiceDate->equalTo($currentDate) || $practiceDate->equalTo($currentDate->copy()->subDay())) {
                $streak++;
                $currentDate = $practiceDate;
            } else {
                break;
            }
        }

        return $streak;
    }

    private function calculateCategoryProgress(?SkillCategory $category = null): float
    {
        $skills = $category->skills;

        if ($skills->isEmpty()) {
            return 0;
        }

        $totalProgress = $skills->sum('current_level');
        $maxProgress = $skills->count() * 5; // Assuming max level is 5

        return round(($totalProgress / $maxProgress) * 100, 2);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
