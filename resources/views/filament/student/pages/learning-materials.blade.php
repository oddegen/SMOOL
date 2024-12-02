    <x-filament-panels::page>
        <x-filament::section>
            @if ($generatedContent)
            <div class="space-y-4">
                <div wire:stream="generatedContent">
                    {!! $generatedContent !!}
                </div>
                {{ $this->generateAction() }}
            </div>
        @else
            {{ $this->generateAction() }}
        @endif
        <x-filament-actions::modals />
        </x-filament::section>
    </x-filament-panels::page>
