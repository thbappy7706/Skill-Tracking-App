<?php

namespace App\Filament\Widgets;

use App\Models\Goal;
use App\Models\LearningResource;
use App\Models\Practice;
use App\Models\Skill;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;


    protected function getStats(): array
    {
        $totalSkills = Skill::count();
        $proficientSkills = Skill::whereIn('status', ['proficient', 'expert'])->count();
        $learningSkills = Skill::whereIn('status', ['learning', 'practicing'])->count();

        $totalPracticeHours = Practice::sum('duration_minutes') / 60;
        $thisWeekPractice = Practice::where('practiced_at', '>=', now()->startOfWeek())
                ->sum('duration_minutes') / 60;

        $activeResources = LearningResource::where('status', 'in_progress')->count();
        $completedResources = LearningResource::where('status', 'completed')->count();

        $activeGoals = Goal::where('status', 'in_progress')->count();
        $completedGoals = Goal::where('status', 'completed')->count();

        return [
            Stat::make('Total Skills', $totalSkills)
                ->description("{$proficientSkills} Proficient/Expert")
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Learning in Progress', $learningSkills)
                ->description('Skills being actively learned')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),

            Stat::make('Practice Hours (Total)', number_format($totalPracticeHours, 1))
                ->description(number_format($thisWeekPractice, 1) . ' hours this week')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),

            Stat::make('Learning Resources', $activeResources)
                ->description("{$completedResources} completed")
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary'),

            Stat::make('Active Goals', $activeGoals)
                ->description("{$completedGoals} completed")
                ->descriptionIcon('heroicon-m-flag')
                ->color('success'),

            Stat::make('Avg. Practice Quality', $this->getAveragePracticeQuality())
                ->description('Out of 5 stars')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }

    protected function getAveragePracticeQuality(): string
    {
        $average = Practice::avg('quality_rating');
        return $average ? number_format($average, 1) . '/5' : 'N/A';
    }
}
