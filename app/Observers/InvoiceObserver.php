<?php

namespace App\Observers;

use App\Listeners\HandleInvoiceCreated;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use TomatoPHP\FilamentInvoices\Models\Invoice;

class InvoiceObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        (new HandleInvoiceCreated)->handle($invoice);
    }

    /**
     * Handle the Invoice "deleted" event.
     */
    public function deleted(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     */
    public function restored(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     */
    public function forceDeleted(Invoice $invoice): void
    {
        //
    }
}
