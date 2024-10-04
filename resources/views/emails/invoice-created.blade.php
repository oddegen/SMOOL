<!DOCTYPE html>
<html>

<head>
    <title>Invoice Created</title>
</head>

<body>
    <h1>Invoice {{ $invoice->uuid }} Created</h1>
    <p>Dear {{ $invoice->billedFor->name ?? $invoice->name }},</p>
    <p>Your invoice has been created. Here are the details:</p>
    <ul>
        <li>Invoice Number: {{ $invoice->uuid }}</li>
        <li>Total Amount: {{ number_format(100, 2) }} {{ $invoice->currency->iso }}</li>
        <li>Due Date: {{ $invoice->due_date->format('Y-m-d') }}</li>
    </ul>
    @if ($checkoutUrl)
        <p>To pay your invoice, please <a href="{{ $checkoutUrl }}">click here</a>.</p>
    @endif
    <p>If you have any questions, please don't hesitate to contact us.</p>
    <p>Thank you for your business!</p>
</body>

</html>
