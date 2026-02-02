<?php

namespace App\Filament\Resources\SkillCategories;

use App\Filament\Resources\SkillCategories\Pages\CreateSkillCategory;
use App\Filament\Resources\SkillCategories\Pages\EditSkillCategory;
use App\Filament\Resources\SkillCategories\Pages\ListSkillCategories;
use App\Filament\Resources\SkillCategories\Pages\ViewSkillCategory;
use App\Filament\Resources\SkillCategories\Schemas\SkillCategoryForm;
use App\Filament\Resources\SkillCategories\Schemas\SkillCategoryInfolist;
use App\Filament\Resources\SkillCategories\Tables\SkillCategoriesTable;
use App\Models\SkillCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SkillCategoryResource extends Resource
{
    protected static ?string $model = SkillCategory::class;
    protected static ?int $navigationSort = 1;
    protected static string|null|\UnitEnum $navigationGroup = 'Skills Management';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'SkillCategory';

    public static function form(Schema $schema): Schema
    {
        return SkillCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SkillCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SkillCategoriesTable::configure($table);
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
            'index' => ListSkillCategories::route('/'),
            'create' => CreateSkillCategory::route('/create'),
            'view' => ViewSkillCategory::route('/{record}'),
            'edit' => EditSkillCategory::route('/{record}/edit'),
        ];
    }
}
