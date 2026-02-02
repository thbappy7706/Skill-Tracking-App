<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->description('Define the core details of this skill')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')->required(),
                                Textarea::make('description'),
                            ])
                            ->columnSpan(2),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Laravel Development')
                            ->autofocus()
                            ->columnSpan(2),

                        Textarea::make('description')
                            ->placeholder('Describe what this skill involves...')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns(4)
                    ->collapsible(),

                Section::make('Skill Levels')
                    ->description('Set your current proficiency and goals')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('current_level')
                                    ->label('Current Level')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(10)
                                    ->default(0)
                                    ->suffix('/ 10')
                                    ->helperText('Rate your current skill level (0-10)')
                                    ->live(),

                                TextInput::make('target_level')
                                    ->label('Target Level')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(10)
                                    ->default(5)
                                    ->suffix('/ 10')
                                    ->helperText('Your desired proficiency level')
                                    ->live(),

                                Select::make('importance')
                                    ->label('Priority')
                                    ->required()
                                    ->options([
                                        1 => '⭐ Low',
                                        2 => '⭐⭐ Medium-Low',
                                        3 => '⭐⭐⭐ Medium',
                                        4 => '⭐⭐⭐⭐ High',
                                        5 => '⭐⭐⭐⭐⭐ Critical',
                                    ])
                                    ->default(3)
                                    ->native(false)
                                    ->helperText('How important is this skill?'),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Progress Tracking')
                    ->description('Track your learning journey')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Select::make('status')
                            ->label('Current Status')
                            ->required()
                            ->options([
                                'not_started' => '🔵 Not Started',
                                'learning' => '🟡 Learning',
                                'practicing' => '🟠 Practicing',
                                'proficient' => '🟢 Proficient',
                                'expert' => '🟣 Expert',
                                'on_hold' => '⚪ On Hold',
                            ])
                            ->default('not_started')
                            ->native(false)
                            ->columnSpanFull()
                        ,

                        DatePicker::make('started_at')
                            ->label('Start Date')
                            ->placeholder('When did you start learning?')
                            ->native(false)
                            ->displayFormat('M d, Y')
                            ->columnSpan(2),

                        DatePicker::make('completed_at')
                            ->label('Completion Date')
                            ->placeholder('Target or actual completion date')
                            ->native(false)
                            ->displayFormat('M d, Y')
                            ->columnSpan(2),
                    ])
                    ->columns(4),

                Section::make('Additional Notes')
                    ->description('Add any additional information, resources, or observations')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Textarea::make('notes')
                            ->placeholder('Resources, learning path, observations, achievements...')
                            ->rows(5)
                            ->maxLength(5000)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
