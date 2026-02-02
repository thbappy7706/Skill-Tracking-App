<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class SkillInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Skill Information')
                    ->schema([
                        TextEntry::make('name')
                            ->weight(FontWeight::Bold)
                            ->size(TextSize::Large)
                            ->columnSpan(2),

                        TextEntry::make('category.name')
                            ->badge()
                            ->color('info')
                            ->columnSpan(1),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'not_started' => 'gray',
                                'learning' => 'warning',
                                'proficient' => 'success',
                                'expert' => 'primary',
                                default => 'info',
                            })
                            ->columnSpan(1),

                        TextEntry::make('importance')
                            ->label('Priority')
                            ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                            ->columnSpan(2),

                        TextEntry::make('description')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('current_level')
                            ->suffix(' / 10')
                            ->badge()
                            ->color('info')
                            ->columnSpan(1),

                        TextEntry::make('target_level')
                            ->suffix(' / 10')
                            ->badge()
                            ->color('success')
                            ->columnSpan(1),

                        TextEntry::make('started_at')
                            ->date()
                            ->placeholder('-')
                            ->columnSpan(1),

                        TextEntry::make('completed_at')
                            ->date()
                            ->placeholder('-')
                            ->columnSpan(1),

                        TextEntry::make('notes')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->dateTime()
                            ->size(TextSize::Small)
                            ->color('gray')
                            ->columnSpan(2),

                        TextEntry::make('updated_at')
                            ->since()
                            ->size(TextSize::Small)
                            ->color('gray')
                            ->columnSpan(2),
                    ])
                    ->columns(4)
                    ->columnSpanFull(),
            ])
            ->columns(1); // This makes the overall schema single column (full width)
    }
}
