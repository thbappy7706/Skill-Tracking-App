<?php

namespace App\Filament\Resources\Learnings\Pages;

use App\Filament\Resources\Learnings\LearningResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLearning extends CreateRecord
{
    protected static string $resource = LearningResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        
        return $data;
    }
}
