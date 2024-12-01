<div class="flex justify-center items-center h-full">
    <x-filament-panels::page>
        @if ($generatedContent)
            <div class="space-y-4">
                <div class="styled-content">
                    {!! $generatedContent !!}
                </div>
                {{ $this->generateAction() }}
            </div>
        @else
            {{ $this->generateAction() }}
        @endif
        <x-filament-actions::modals />
    </x-filament-panels::page>
</div>
