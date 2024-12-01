<?php

namespace App\Providers;

use App\Http\Responses\LoginResponse;
use App\Models\User;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentInvoices\Facades\FilamentInvoices;
use TomatoPHP\FilamentInvoices\Models\Invoice;
use TomatoPHP\FilamentInvoices\Services\Contracts\InvoiceFor;
use TomatoPHP\FilamentInvoices\Services\Contracts\InvoiceFrom;
use App\Services\MarkdownParser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        $this->app->singleton(MarkdownParser::class, function ($app) {
            return new MarkdownParser();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TextEntry::configureUsing(function (TextEntry $textEntry) {
            $textEntry->placeholder('Untitled');
        });

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['am', 'en', 'fr', 'es']); // also accepts a closure
        });

        FilamentInvoices::registerFor([
            InvoiceFor::make(User::class)
                ->label('User')
        ]);
        FilamentInvoices::registerFrom([
            InvoiceFrom::make(User::class)
                ->label('Staff')
                ->column('name')
        ]);
    }
}
