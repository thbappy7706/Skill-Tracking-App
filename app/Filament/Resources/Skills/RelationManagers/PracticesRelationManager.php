<?php

namespace App\Filament\Resources\Skills\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PracticesRelationManager extends RelationManager
{
    protected static string $relationship = 'practices';

    protected static ?string $title = 'Practice Sessions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->placeholder('e.g., Built a REST API with Laravel'),

                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('What did you work on?'),

                DateTimePicker::make('practiced_at')
                    ->label('Practice Date & Time')
                    ->required()
                    ->default(now())
                    ->native(false)
                    ->displayFormat('M d, Y H:i'),

                TextInput::make('duration_minutes')
                    ->label('Duration (minutes)')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(1440)
                    ->suffix('minutes')
                    ->default(60),

                Select::make('difficulty')
                    ->options([
                        1 => '1 - Very Easy',
                        2 => '2 - Easy',
                        3 => '3 - Moderate',
                        4 => '4 - Challenging',
                        5 => '5 - Very Challenging',
                    ])
                    ->required()
                    ->default(3)
                    ->native(false),

                Select::make('quality_rating')
                    ->label('Quality Rating')
                    ->options([
                        1 => '⭐ 1 - Poor',
                        2 => '⭐⭐ 2 - Fair',
                        3 => '⭐⭐⭐ 3 - Good',
                        4 => '⭐⭐⭐⭐ 4 - Very Good',
                        5 => '⭐⭐⭐⭐⭐ 5 - Excellent',
                    ])
                    ->required()
                    ->default(3)
                    ->native(false),

                TextInput::make('repository_url')
                    ->label('Repository/Project URL')
                    ->url()
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->placeholder('https://github.com/...'),

                Textarea::make('notes')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Any additional notes, learnings, or reflections...'),
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

                TextColumn::make('practiced_at')
                    ->label('Date')
                    ->dateTime('M d, Y')
                    ->sortable(),

                TextColumn::make('duration_minutes')
                    ->label('Duration')
                    ->formatStateUsing(function ($state) {
                        $hours = floor($state / 60);
                        $minutes = $state % 60;
                        if ($hours > 0) {
                            return "{$hours}h {$minutes}m";
                        }
                        return "{$minutes}m";
                    })
                    ->sortable(),

                TextColumn::make('difficulty')
                    ->badge()
                    ->colors([
                        'success' => 1,
                        'info' => 2,
                        'warning' => 3,
                        'danger' => 4,
                        'gray' => 5,
                    ])
                    ->formatStateUsing(fn ($state) => "Level {$state}"),

                TextColumn::make('quality_rating')
                    ->label('Quality')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),

                IconColumn::make('repository_url')
                    ->label('Repo')
                    ->boolean()
                    ->trueIcon('heroicon-o-link')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->url(fn ($record) => $record->repository_url)
                    ->openUrlInNewTab(),
            ])
            ->filters([
                SelectFilter::make('difficulty')
                    ->options([
                        1 => 'Level 1',
                        2 => 'Level 2',
                        3 => 'Level 3',
                        4 => 'Level 4',
                        5 => 'Level 5',
                    ]),

                Filter::make('practiced_at')
                    ->form([
                        DateTimePicker::make('practiced_from')
                            ->native(false),
                        DateTimePicker::make('practiced_until')
                            ->native(false),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['practiced_from'], fn ($q, $date) => $q->whereDate('practiced_at', '>=', $date))
                            ->when($data['practiced_until'], fn ($q, $date) => $q->whereDate('practiced_at', '<=', $date));
                    }),
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
            ->defaultSort('practiced_at', 'desc');
    }
}
