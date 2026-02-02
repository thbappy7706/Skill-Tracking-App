<?php

namespace App\Filament\Resources\Learnings;

use App\Filament\Resources\Learnings\Pages\CreateLearning;
use App\Filament\Resources\Learnings\Pages\EditLearning;
use App\Filament\Resources\Learnings\Pages\ListLearnings;
use App\Filament\Resources\Learnings\Pages\ViewLearning;
use App\Filament\Resources\Learnings\Schemas\LearningForm;
use App\Filament\Resources\Learnings\Schemas\LearningInfolist;
use App\Filament\Resources\Learnings\Tables\LearningsTable;
use App\Models\LearningResource as LearningResourceModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LearningResource extends Resource
{
    protected static ?string $model = LearningResourceModel::class;

    protected static ?int $navigationSort = 3;
    protected static string|null|\UnitEnum $navigationGroup = 'Learning Journey';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return LearningForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LearningInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LearningsTable::configure($table);
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
            'index' => ListLearnings::route('/'),
            'create' => CreateLearning::route('/create'),
            'view' => ViewLearning::route('/{record}'),
            'edit' => EditLearning::route('/{record}/edit'),
        ];
    }
}
