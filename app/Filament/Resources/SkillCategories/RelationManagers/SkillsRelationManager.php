<?php

namespace App\Filament\Resources\SkillCategories\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SkillsRelationManager extends RelationManager
{
    protected static string $relationship = 'skills';

    protected static ?string $title = 'Skills';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->placeholder('e.g., Laravel, React, Docker'),

                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Describe this skill...'),

                Select::make('current_level')
                    ->label('Current Level')
                    ->options([
                        0 => '0 - Not Started',
                        1 => '1 - Beginner',
                        2 => '2 - Elementary',
                        3 => '3 - Intermediate',
                        4 => '4 - Advanced',
                        5 => '5 - Expert',
                    ])
                    ->required()
                    ->default(0)
                    ->native(false),

                Select::make('target_level')
                    ->label('Target Level')
                    ->options([
                        1 => '1 - Beginner',
                        2 => '2 - Elementary',
                        3 => '3 - Intermediate',
                        4 => '4 - Advanced',
                        5 => '5 - Expert',
                    ])
                    ->required()
                    ->default(5)
                    ->native(false),

                Select::make('importance')
                    ->options([
                        1 => '1 - Low',
                        2 => '2 - Medium',
                        3 => '3 - High',
                        4 => '4 - Critical',
                        5 => '5 - Essential',
                    ])
                    ->required()
                    ->default(3)
                    ->native(false),

                Select::make('status')
                    ->options([
                        'not_started' => 'Not Started',
                        'learning' => 'Learning',
                        'practicing' => 'Practicing',
                        'proficient' => 'Proficient',
                        'expert' => 'Expert',
                        'maintaining' => 'Maintaining',
                    ])
                    ->required()
                    ->default('not_started')
                    ->native(false),

                DatePicker::make('started_at')
                    ->label('Started Date')
                    ->native(false)
                    ->displayFormat('M d, Y'),

                DatePicker::make('completed_at')
                    ->label('Completed Date')
                    ->native(false)
                    ->displayFormat('M d, Y'),

                Textarea::make('notes')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Any notes about this skill...'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('current_level')
                    ->label('Level')
                    ->badge()
                    ->colors([
                        'gray' => 0,
                        'danger' => 1,
                        'warning' => 2,
                        'info' => 3,
                        'success' => 4,
                        'primary' => 5,
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        0 => 'Not Started',
                        1 => 'Beginner',
                        2 => 'Elementary',
                        3 => 'Intermediate',
                        4 => 'Advanced',
                        5 => 'Expert',
                        default => 'Unknown',
                    })
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'not_started',
                        'warning' => 'learning',
                        'info' => 'practicing',
                        'success' => 'proficient',
                        'primary' => 'expert',
                        'secondary' => 'maintaining',
                    ])
                    ->sortable(),

                TextColumn::make('importance')
                    ->badge()
                    ->colors([
                        'gray' => 1,
                        'info' => 2,
                        'warning' => 3,
                        'danger' => 4,
                        'primary' => 5,
                    ])
                    ->formatStateUsing(fn ($state) => "Priority {$state}")
                    ->sortable(),

                TextColumn::make('started_at')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('practices_count')
                    ->counts('practices')
                    ->label('Practices')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('milestones_count')
                    ->counts('milestones')
                    ->label('Milestones')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'not_started' => 'Not Started',
                        'learning' => 'Learning',
                        'practicing' => 'Practicing',
                        'proficient' => 'Proficient',
                        'expert' => 'Expert',
                        'maintaining' => 'Maintaining',
                    ]),

                SelectFilter::make('current_level')
                    ->label('Level')
                    ->options([
                        0 => 'Not Started',
                        1 => 'Beginner',
                        2 => 'Elementary',
                        3 => 'Intermediate',
                        4 => 'Advanced',
                        5 => 'Expert',
                    ]),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id();
                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('importance', 'desc');
    }
}
