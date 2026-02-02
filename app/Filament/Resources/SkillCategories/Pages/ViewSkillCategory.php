<?php

namespace App\Filament\Resources\SkillCategories\Pages;

use App\Filament\Resources\SkillCategories\SkillCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSkillCategory extends ViewRecord
{
    protected static string $resource = SkillCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
