<?php

namespace App\Providers;

use App\Settings\SchoolSettings;
use Filament\Facades\Filament;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TextEntry::configureUsing(function (TextEntry $textEntry) {
            $textEntry->placeholder('Untitled');
        });
    }
}
