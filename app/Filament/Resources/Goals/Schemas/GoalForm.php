<?php

namespace App\Filament\Resources\Goals\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GoalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->maxLength(255),
                Select::make('type')
                    ->options([
                        'daily' => 'Daily',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                        'quarterly' => 'Quarterly',
                        'yearly' => 'Yearly',
                        'career' => 'Career',
                    ])->required()->default('monthly'),

                Select::make('status')
                    ->options([
                        'planned' => 'Planned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'abandoned' => 'Abandoned',
                    ])->required()->default('planned'),

                Select::make('priority')
                    ->options([
                        1 => '⭐ Low',
                        2 => '⭐⭐ Medium-Low',
                        3 => '⭐⭐⭐ Medium',
                        4 => '⭐⭐⭐⭐ High',
                        5 => '⭐⭐⭐⭐⭐ Critical',
                    ])
                    ->required()
                    ->default(3),

                DatePicker::make('start_date'),
                DatePicker::make('target_date')->label('Target Completion Date'),
                DatePicker::make('completed_at') ->label('Actual Completion Date'),
                TextInput::make('progress_percentage')->label('Progress (%)')->numeric()->minValue(0)->maxValue(100)->default(0)->suffix('%'),
                Textarea::make('description')->rows(3) ,
                Textarea::make('notes')->rows(3) ,
            ]);
    }
}
