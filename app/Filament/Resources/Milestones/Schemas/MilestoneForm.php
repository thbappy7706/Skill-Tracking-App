<?php

namespace App\Filament\Resources\Milestones\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MilestoneForm
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
                TextInput::make('title')->required(),
                Textarea::make('description')->columnSpanFull(),
                DatePicker::make('target_date'),
                DatePicker::make('completed_at'),
                TextInput::make('proof_url')->url()->columnSpanFull(),
                Textarea::make('notes')->columnSpanFull(),
                Toggle::make('is_completed')->required(),

            ]);
    }
}
