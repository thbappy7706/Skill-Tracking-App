<?php

namespace App\Filament\Resources\Learnings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LearningForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Resource Information')
                    ->schema([
                        Select::make('skill_id')
                            ->label('Skill')
                            ->relationship(
                                name: 'skill',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn ($query) => $query->where('user_id', auth()->id())
                            )
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Select::make('type')
                            ->required()
                            ->options([
                                'course' => 'Course',
                                'book' => 'Book',
                                'video' => 'Video',
                                'article' => 'Article',
                                'tutorial' => 'Tutorial',
                                'documentation' => 'Documentation',
                                'podcast' => 'Podcast',
                                'other' => 'Other',
                            ])
                            ->default('course')
                            ->native(false),

                        TextInput::make('url')
                            ->label('URL')
                            ->url()
                            ->placeholder('https://...')
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Progress')
                    ->schema([
                        Select::make('status')
                            ->required()
                            ->options([
                                'planned' => 'Planned',
                                'in_progress' => 'In Progress',
                                'completed' => 'Completed',
                                'abandoned' => 'Abandoned',
                            ])
                            ->default('planned')
                            ->native(false),

                        TextInput::make('rating')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->suffix('/ 5')
                            ->helperText('Rate this resource (1-5)'),

                        DatePicker::make('started_at')
                            ->label('Started Date')
                            ->native(false),

                        DatePicker::make('completed_at')
                            ->label('Completed Date')
                            ->native(false),
                    ])
                    ->columns(2),

                Section::make('Notes')
                    ->schema([
                        Textarea::make('notes')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
