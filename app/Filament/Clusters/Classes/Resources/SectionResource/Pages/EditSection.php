<?php

namespace App\Filament\Clusters\Classes\Resources\SectionResource\Pages;

use App\Filament\Clusters\Classes\Resources\SectionResource;
use App\Models\Section;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditSection extends EditRecord
{
    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('View Schedule')
                ->url(fn(): string => route(Calender::getRouteName(), [
                    'record' => $this->getRecord()
                ]))
                ->label('View Schedule')
        ];
    }
}
