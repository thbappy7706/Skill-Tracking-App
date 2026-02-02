<?php

namespace App\Filament\Resources\SkillCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ColorPicker;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SkillCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter category name')
                            ->autofocus()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->placeholder('Enter a brief description')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Appearance')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('icon')
                                    ->placeholder('heroicon-o-star')
                                    ->helperText('Enter Heroicon name')
                                    ->prefix('Icon:'),

                                ColorPicker::make('color')
                                    ->placeholder('#3B82F6')
                                    ->helperText('Pick a color for this category'),

                                TextInput::make('order')
                                    ->required()
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->helperText('Display order (lower numbers first)'),
                            ]),
                    ]),
            ]);
    }
}
