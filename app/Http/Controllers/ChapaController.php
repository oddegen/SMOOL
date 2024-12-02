<?php

namespace App\Http\Controllers;

use Chapa\Chapa\Chapa;
use Response;
use TomatoPHP\FilamentInvoices\Models\Invoice;

class ChapaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($reference)
    {
        $data = new Chapa()->verifyTransaction($reference);

        if ($data['status'] === 'success') {
            $invoice = Invoice::latest()->first();

            $invoice->meta('payments', $invoice->total)->saveQuietly();
        }

        return Response::noContent();
    }
}
