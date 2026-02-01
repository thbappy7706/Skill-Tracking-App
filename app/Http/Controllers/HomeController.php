<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Practice;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user) {
            // Get user stats
            $stats = [
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
            $recentPractices = Practice::with('skill')
                ->latest('practiced_at')
                ->limit(5)
                ->get();

            // Get categories with progress
            $categories = SkillCategory::withCount('skills')
                ->orderBy('order')
                ->get()
                ->map(function ($category) {
                    $category->progress = $category->progress_percentage;
                    return $category;
                });

            // Get skills by level for chart
            $skillsByLevel = Skill::selectRaw('current_level, COUNT(*) as count')
                ->groupBy('current_level')
                ->get()
                ->pluck('count', 'current_level');

            // Get upcoming goals
            $upcomingGoals = Goal::whereIn('status', ['planned', 'in_progress'])
                ->whereNotNull('target_date')
                ->orderBy('target_date')
                ->limit(3)
                ->get();

            return view('home.dashboard', compact(
                'stats',
                'recentPractices',
                'categories',
                'skillsByLevel',
                'upcomingGoals'
            ));
        }

        // Show landing page for guests
        return view('home.landing');
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
}
