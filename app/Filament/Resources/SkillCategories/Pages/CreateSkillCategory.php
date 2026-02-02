<?php

namespace App\Filament\Resources\SkillCategories\Pages;

use App\Filament\Resources\SkillCategories\SkillCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSkillCategory extends CreateRecord
{
    protected static string $resource = SkillCategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        
        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'SuccessFully created skill category!';
    }
}
