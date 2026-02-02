<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('current_level')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('target_level')
                    ->required()
                    ->numeric()
                    ->default(5),
                TextInput::make('importance')
                    ->required()
                    ->numeric()
                    ->default(3),
                TextInput::make('status')
                    ->required()
                    ->default('not_started'),
                DatePicker::make('started_at'),
                DatePicker::make('completed_at'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
