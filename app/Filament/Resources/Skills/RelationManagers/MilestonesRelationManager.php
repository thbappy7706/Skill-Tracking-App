<?php

namespace App\Filament\Resources\Skills\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MilestonesRelationManager extends RelationManager
{
    protected static string $relationship = 'milestones';

    protected static ?string $title = 'Milestones';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->placeholder('e.g., Built first full-stack application'),

                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Describe this milestone...'),

                DatePicker::make('target_date')
                    ->label('Target Date')
                    ->native(false)
                    ->displayFormat('M d, Y'),

                DatePicker::make('completed_at')
                    ->label('Completed Date')
                    ->native(false)
                    ->displayFormat('M d, Y'),

                Toggle::make('is_completed')
                    ->label('Mark as Completed')
                    ->default(false)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state && !request()->input('completed_at')) {
                            $set('completed_at', now()->format('Y-m-d'));
                        }
                    }),

                TextInput::make('proof_url')
                    ->label('Proof/Evidence URL')
                    ->url()
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->placeholder('https://... (e.g., certificate, project link, etc.)'),

                Textarea::make('notes')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Additional notes or reflections...'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                IconColumn::make('is_completed')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                TextColumn::make('target_date')
                    ->label('Target')
                    ->date('M d, Y')
                    ->sortable()
                    ->color(function ($record) {
                        if ($record->is_completed) {
                            return 'success';
                        }
                        if ($record->target_date && $record->target_date->isPast()) {
                            return 'danger';
                        }
                        return 'gray';
                    }),

                TextColumn::make('completed_at')
                    ->label('Completed')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),

                IconColumn::make('proof_url')
                    ->label('Proof')
                    ->boolean()
                    ->trueIcon('heroicon-o-link')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('info')
                    ->falseColor('gray')
                    ->url(fn ($record) => $record->proof_url)
                    ->openUrlInNewTab(),
            ])
            ->filters([
                TernaryFilter::make('is_completed')
                    ->label('Completion Status')
                    ->placeholder('All milestones')
                    ->trueLabel('Completed only')
                    ->falseLabel('Incomplete only'),

                Filter::make('overdue')
                    ->label('Overdue')
                    ->query(fn ($query) => $query
                        ->where('is_completed', false)
                        ->whereNotNull('target_date')
                        ->where('target_date', '<', now())
                    ),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id();
                        return $data;
                    }),
            ])
            ->recordActions([
                Action::make('toggle_complete')
                    ->label(fn ($record) => $record->is_completed ? 'Mark Incomplete' : 'Mark Complete')
                    ->icon(fn ($record) => $record->is_completed ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn ($record) => $record->is_completed ? 'warning' : 'success')
                    ->action(function ($record) {
                        $record->update([
                            'is_completed' => !$record->is_completed,
                            'completed_at' => !$record->is_completed ? now() : null,
                        ]);
                    }),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('target_date', 'asc');
    }
}
