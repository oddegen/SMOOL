<?php

namespace App\Filament\Clusters\Classes\Resources\SectionResource\Pages;

use App\Filament\Clusters\Classes\Resources\SectionResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class Calender extends Page
{
    use InteractsWithRecord;

    protected static string $resource = SectionResource::class;

    protected static string $view = 'filament.clusters.classes.resources.section-resource.pages.calender';


    protected static ?string $title = 'TimeTable';


    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
