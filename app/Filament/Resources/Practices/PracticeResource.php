<?php

namespace App\Filament\Resources\Practices;

use App\Filament\Resources\Practices\Pages\CreatePractice;
use App\Filament\Resources\Practices\Pages\EditPractice;
use App\Filament\Resources\Practices\Pages\ListPractices;
use App\Filament\Resources\Practices\Pages\ViewPractice;
use App\Filament\Resources\Practices\Schemas\PracticeForm;
use App\Filament\Resources\Practices\Schemas\PracticeInfolist;
use App\Filament\Resources\Practices\Tables\PracticesTable;
use App\Models\Practice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PracticeResource extends Resource
{
    protected static ?string $model = Practice::class;

    protected static ?int $navigationSort = 4;
    protected static string|null|\UnitEnum $navigationGroup = 'Learning Journey';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBeaker;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PracticeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PracticeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PracticesTable::configure($table);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPractices::route('/'),
            'create' => CreatePractice::route('/create'),
            'view' => ViewPractice::route('/{record}'),
            'edit' => EditPractice::route('/{record}/edit'),
        ];
    }
}
