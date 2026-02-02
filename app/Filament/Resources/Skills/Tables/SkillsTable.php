<?php

namespace App\Filament\Resources\Skills\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('category.name')->sortable()->searchable(),
                TextColumn::make('current_level')->label('Level')->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        0 => 'Not Started',
                        1 => 'Beginner',
                        2 => 'Elementary',
                        3 => 'Intermediate',
                        4 => 'Advanced',
                        5 => 'Expert',
                        default => 'Unknown',
                    })
                    ->color(fn($state) => match ($state) {
                        0 => 'gray',
                        1 => 'warning',
                        2 => 'info',
                        3 => 'primary',
                        4 => 'success',
                        5 => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('progress_percentage')->label('Progress')->suffix('%')->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn($state) => ucwords(str_replace('_', ' ', $state)))
                    ->color(fn($state) => match ($state) {
                        'not_started' => 'gray',
                        'learning' => 'info',
                        'practicing' => 'warning',
                        'proficient' => 'success',
                        'expert' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('importance')->sortable()
                    ->formatStateUsing(fn($state) => str_repeat('⭐', $state)),


                TextColumn::make('started_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('completed_at')
                    ->date()
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('category')->relationship('category', 'name'),
                SelectFilter::make('status')->options([
                    'not_started' => 'Not Started',
                    'learning' => 'Learning',
                    'practicing' => 'Practicing',
                    'proficient' => 'Proficient',
                    'expert' => 'Expert',
                ]),

                SelectFilter::make('importance')->options([
                    1 => '⭐ Low',
                    2 => '⭐⭐ Medium-Low',
                    3 => '⭐⭐⭐ Medium',
                    4 => '⭐⭐⭐⭐ High',
                    5 => '⭐⭐⭐⭐⭐ Critical',
                ]),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])    ->defaultSort('importance', 'desc');
    }
}
