<?php

namespace App\Listeners;

use TomatoPHP\FilamentInvoices\Models\Invoice;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceCreated;
use Chapa\Chapa\Facades\Chapa;

class HandleInvoiceCreated
{
    public function handle(Invoice $invoice): void
    {
        $checkoutUrl = $this->integrateWithPaymentGateway($invoice);

        $recipient = $invoice->billedFor->email ?? $invoice->email;
        Mail::to($recipient)->send(new InvoiceCreated($invoice, $checkoutUrl));
    }

    private function integrateWithPaymentGateway(Invoice $invoice): ?string
    {
        $reference = Chapa::generateReference();

        $paymentData = [
            'amount' => $invoice->total,
            'email' => $invoice->billedFor->email ?? $invoice->email,
            'tx_ref' => $reference,
            'currency' => $invoice->currency->iso,
            'callback_url' => route('callback', [$reference]),
            'first_name' => $invoice->billedFor->first_name ?? explode(' ', $invoice->name)[0],
            'last_name' => $invoice->billedFor->last_name ?? (explode(' ', $invoice->name)[1] ?? ''),
            "customization" => [
                "title" => 'Invoice Payment',
                "description" => "Payment for invoice {$invoice->uuid}"
            ]
        ];

        $payment = Chapa::initializePayment($paymentData);

        if ($payment['status'] !== 'success') {
            return null;
        }

        if ($payment['status'] === 'success') {
            $invoice->meta('payment_url', $payment['data']['checkout_url']);
            return $payment['data']['checkout_url'];
        }

        return null;
    }
}
