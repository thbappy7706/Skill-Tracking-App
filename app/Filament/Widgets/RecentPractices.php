<?php

namespace App\Filament\Widgets;

use App\Models\Practice;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RecentPractices extends TableWidget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(Practice::query()->latest('practiced_at')->limit(5))
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('skill.name')
                    ->label('Skill')
                    ->sortable(),
                TextColumn::make('duration_formatted')
                    ->label('Duration'),
                TextColumn::make('practiced_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('quality_rating')
                    ->label('Rating'),
            ])
            ->paginated();
    }
}
