<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentInvoices\Models\Invoice;
use App\Listeners\HandleInvoiceCreated;

class InvoiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Invoice::created(function ($invoice) {
            (new HandleInvoiceCreated)->handle($invoice);
        });
    }
}
