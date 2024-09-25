<?php

namespace App\Filament\Teacher\Resources\SectionResource\Pages;

use App\Filament\Teacher\Resources\SectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSections extends ManageRecords
{
    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
