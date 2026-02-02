<?php

namespace App\Filament\Resources\Practices\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PracticeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('duration_minutes')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('practiced_at')
                    ->required(),
                TextInput::make('difficulty')
                    ->required()
                    ->numeric()
                    ->default(3),
                TextInput::make('quality_rating')
                    ->required()
                    ->numeric()
                    ->default(3),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('repository_url')
                    ->url(),
            ]);
    }
}
