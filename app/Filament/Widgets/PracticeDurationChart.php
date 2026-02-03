<?php

namespace App\Filament\Widgets;

use App\Models\Practice;
use Filament\Widgets\ChartWidget;

class PracticeDurationChart extends ChartWidget

{
    protected static ?int $sort = 4;
    protected ?string $heading = 'Practice Duration Chart';

    protected function getData(): array
    {
        $data = Practice::query()
            ->selectRaw('DATE(practiced_at) as date, SUM(duration_minutes) as total_minutes')
            ->where('practiced_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->pluck('total_minutes', 'date')
            ->toArray();

        $labels = [];
        $values = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = $date;
            $values[] = $data[$date] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Practice Minutes',
                    'data' => $values,
                    'borderColor' => '#3b82f6',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
