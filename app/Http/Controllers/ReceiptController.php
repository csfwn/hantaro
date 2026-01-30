<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptController extends Controller
{
    public function download(Order $order)
    {
        // Optional: security check
        // abort_unless($order->payment_status === 1, 403);

        $order->load('products');

        $pdf = Pdf::loadView('pdf.receipt', [
            'order' => $order
        ])->setPaper('a4');

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'Resit_' . $order->ref_no . '.pdf'
        );
    }
}
