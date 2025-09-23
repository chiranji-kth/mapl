<?php


use Illuminate\Contracts\View\View;

class InvoiceExport implements FromView
{
    protected $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function view(): View
    {
        return \view('exports.invoice', [
            'invoice' => $this->invoice,
        ]);
    }
}
