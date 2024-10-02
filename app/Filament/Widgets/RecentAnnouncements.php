<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\HtmlString;

class RecentAnnouncements extends BaseWidget
{
    protected static ?string $maxHeight = '300px';

    public function table(Table $table): Table
    {
        return $table
            ->heading(fn() => new HtmlString('<span class="text-2xl font-bold"> Recent Announcements</span>'))
            ->query(
                fn() => Event::query()
                    ->where('is_announcement', true)
                    ->orderBy('created_at', 'desc')
                    ->limit(6)
            )
            ->columns([
                TextColumn::make('title')
                    ->icon('heroicon-o-megaphone')
                    ->size(TextColumnSize::Medium)
                    ->description(fn(Event $record) => $record->description)
                    ->wrap(),
            ])
            ->striped()
            ->paginated(false)
            ->poll('10s');
    }
}
