<?php


use Illuminate\Contracts\View\View;

class QuotationExport implements FromView
{
    protected $quotation;

    public function __construct($quotation)
    {
        $this->quotation = $quotation;
    }

    public function view(): View
    {
        return \view('exports.quotation', [
            'quotation' => $this->quotation,
        ]);
    }
}
