<x-filament-panels::page>
    <div>
        @livewire(\App\Filament\Clusters\Classes\Resources\SectionResource\Widgets\CalendarWidget::class, [
            'section' => $this->record,
        ])
    </div>
</x-filament-panels::page>
