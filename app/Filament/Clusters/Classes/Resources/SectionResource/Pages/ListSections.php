<?php

namespace App\Filament\Clusters\Classes\Resources\SectionResource\Pages;

use App\Filament\Clusters\Classes\Resources\SectionResource;
use App\Models\Section;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListSections extends ListRecords
{
    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
