<?php

namespace App\Filament\Widgets;

use App\Models\SkillCategory;
use Filament\Widgets\ChartWidget;

class SkillCategoryChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected ?string $heading = 'Skill Category Chart';

    protected function getData(): array
    {
        $categories = SkillCategory::withCount(['skills' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->get();

        return [
            'datasets' => [
                [
                    'label' => 'Skills',
                    'data' => $categories->pluck('skills_count')->toArray(),
                    'backgroundColor' => [
                        '#f87171', '#fb923c', '#facc15', '#4ade80', '#60a5fa', '#a78bfa', '#e879f9', '#94a3b8'
                    ],
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
