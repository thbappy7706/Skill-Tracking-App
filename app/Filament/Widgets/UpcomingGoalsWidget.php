<?php

namespace App\Filament\Widgets;

use App\Models\Goal;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingGoalsWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Goal::query()
                    ->whereIn('status', ['planned', 'in_progress'])
                    ->whereNotNull('target_date')
                    ->orderBy('target_date')
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('priority')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),

                TextColumn::make('progress_percentage')
                    ->label('Progress')
                    ->suffix('%')
                    ->color(fn ($state) => match(true) {
                        $state >= 80 => 'success',
                        $state >= 50 => 'warning',
                        default => 'danger',
                    }),

                TextColumn::make('target_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('days_remaining')
                    ->label('Days Left')
                    ->formatStateUsing(function ($record) {
                        if (!$record->target_date) {
                            return '-';
                        }
                        $days = $record->days_remaining;
                        if ($days === null) {
                            return '-';
                        }
                        if ($days < 0) {
                            return '⚠️ Overdue by ' . abs($days) . 'd';
                        }
                        return $days . ' days';
                    })
                    ->color(fn ($record) => $record->is_overdue ? 'danger' : 'success'),
            ])
            ->heading('Upcoming Goals & Deadlines');
    }
}
