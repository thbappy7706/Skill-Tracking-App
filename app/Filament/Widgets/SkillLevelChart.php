<?php

namespace App\Filament\Widgets;

use App\Models\Skill;
use Filament\Widgets\ChartWidget;

class SkillLevelChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Skill Level Chart';

    protected function getData(): array
    {
        $levels = [
            0 => 'Not Started',
            1 => 'Beginner',
            2 => 'Elementary',
            3 => 'Intermediate',
            4 => 'Advanced',
            5 => 'Expert',
        ];

        $counts = Skill::query()
            ->selectRaw('current_level, count(*) as count')
            ->groupBy('current_level')
            ->pluck('count', 'current_level')
            ->toArray();

        $data = [];
        foreach ($levels as $level => $label) {
            $data[] = $counts[$level] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Skills',
                    'data' => $data,
                    'backgroundColor' => [
                        '#9ca3af', // gray
                        '#86efac', // light green
                        '#4ade80', // green
                        '#22c55e', // green-500
                        '#16a34a', // green-600
                        '#15803d', // green-700
                    ],
                ],
            ],
            'labels' => array_values($levels),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
