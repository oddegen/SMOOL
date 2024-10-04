<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use TomatoPHP\FilamentInvoices\Models\Invoice;

class InvoiceCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $checkoutUrl;

    public function __construct(Invoice $invoice, ?string $checkoutUrl)
    {
        $this->invoice = $invoice;
        $this->checkoutUrl = $checkoutUrl;
    }

    public function build()
    {
        return $this->view('emails.invoice-created')
            ->subject('New Invoice Created');
    }
}
