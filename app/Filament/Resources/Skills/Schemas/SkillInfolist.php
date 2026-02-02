<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SkillInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('current_level')
                    ->numeric(),
                TextEntry::make('target_level')
                    ->numeric(),
                TextEntry::make('importance')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('started_at')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('completed_at')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
