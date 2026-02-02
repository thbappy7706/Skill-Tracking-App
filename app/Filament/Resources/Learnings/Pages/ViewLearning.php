<?php

namespace App\Filament\Resources\Learnings\Pages;

use App\Filament\Resources\Learnings\LearningResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLearning extends ViewRecord
{
    protected static string $resource = LearningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
