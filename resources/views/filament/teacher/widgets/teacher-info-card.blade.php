<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                @if ($this->getUser()->avatar_url)
                    <img class="h-24 w-24 rounded-full object-cover pr-2"
                        src="{{ Storage::url($this->getUser()->avatar_url) }}" alt="{{ $this->getUser()->name }}">
                @else
                    <div
                        class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-2xl font-bold">
                        {{ strtoupper(substr($this->getUser()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="flex-grow">
                <h2 class="text-2xl font-bold text-gray-900">{{ $this->getUser()->full_name }}</h2>
                <p class="text-gray-500">{{ $this->getUser()->role->name ?? 'Teacher' }}</p>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Email</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $this->getUser()->email }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Phone</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $this->getUser()->phone ?? 'Not provided' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Address</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $this->getUser()->address ?? 'Not provided' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Gender</h3>
                <p class="mt-1 text-sm text-gray-900">{{ ucfirst($this->getUser()->gender) ?? 'Not specified' }}</p>
            </div>
        </div>
        @if ($this->getUser()->bio)
            <div class="mt-4">
                <h3 class="text-sm font-medium text-gray-500">Bio</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $this->getUser()->bio }}</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
