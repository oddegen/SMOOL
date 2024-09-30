<?php

namespace App\Filament\Teacher\Resources\GradeComponentResource\Pages;

use App\Filament\Teacher\Resources\GradeComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGradeComponents extends ListRecords
{
    protected static string $resource = GradeComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
