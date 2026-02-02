<?php

namespace App\Filament\Resources\Skills\RelationManagers;

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

class LearningResourcesRelationManager extends RelationManager
{
    protected static string $relationship = 'learningResources';

    protected static ?string $title = 'Learning Resources';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->placeholder('e.g., Laravel Documentation, Vue.js Course'),

                Select::make('type')
                    ->options([
                        'course' => 'Course',
                        'book' => 'Book',
                        'tutorial' => 'Tutorial',
                        'documentation' => 'Documentation',
                        'video' => 'Video',
                        'article' => 'Article',
                        'other' => 'Other',
                    ])
                    ->required()
                    ->default('course')
                    ->native(false),

                Select::make('status')
                    ->options([
                        'planned' => 'Planned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'paused' => 'Paused',
                    ])
                    ->required()
                    ->default('planned')
                    ->native(false),

                TextInput::make('url')
                    ->url()
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->placeholder('https://...'),

                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Brief description of this resource...'),

                Select::make('rating')
                    ->options([
                        1 => '⭐ 1 - Poor',
                        2 => '⭐⭐ 2 - Fair',
                        3 => '⭐⭐⭐ 3 - Good',
                        4 => '⭐⭐⭐⭐ 4 - Very Good',
                        5 => '⭐⭐⭐⭐⭐ 5 - Excellent',
                    ])
                    ->native(false)
                    ->placeholder('Rate this resource'),

                DatePicker::make('started_at')
                    ->native(false)
                    ->displayFormat('M d, Y'),

                DatePicker::make('completed_at')
                    ->native(false)
                    ->displayFormat('M d, Y'),

                Textarea::make('notes')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Additional notes about this resource...'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'primary' => 'course',
                        'success' => 'book',
                        'info' => 'tutorial',
                        'warning' => 'documentation',
                        'danger' => 'video',
                        'gray' => 'article',
                    ])
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'planned',
                        'warning' => 'in_progress',
                        'success' => 'completed',
                        'danger' => 'paused',
                    ])
                    ->sortable(),

                TextColumn::make('rating')
                    ->formatStateUsing(fn ($state) => $state ? str_repeat('⭐', $state) : '-')
                    ->sortable(),

                TextColumn::make('started_at')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('completed_at')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'course' => 'Course',
                        'book' => 'Book',
                        'tutorial' => 'Tutorial',
                        'documentation' => 'Documentation',
                        'video' => 'Video',
                        'article' => 'Article',
                        'other' => 'Other',
                    ]),

                SelectFilter::make('status')
                    ->options([
                        'planned' => 'Planned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'paused' => 'Paused',
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
            ->defaultSort('created_at', 'desc');
    }
}
