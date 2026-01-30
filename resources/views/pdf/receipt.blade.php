<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111 }
        h1 { font-size: 18px; margin-bottom: 4px }
        .muted { color: #666 }
        table { width: 100%; border-collapse: collapse; margin-top: 12px }
        th, td { padding: 8px; border-bottom: 1px solid #ddd }
        th { text-align: left }
        .right { text-align: right }
        .total { font-weight: bold; font-size: 14px }
    </style>
</head>
<body>

<h1>Resit Pembayaran</h1>
<p class="muted">Rujukan: {{ $order->ref_no }}</p>
<p class="muted">Tarikh: {{ $order->created_at->timezone('Asia/Kuala_Lumpur')->format('d/m/Y h:i A') }}</p>

<hr>

<p>
    <strong>Pelanggan:</strong><br>
    {{ $order->customer_name }}<br>
    {{ $order->customer_email }}<br>
    {{ $order->customer_phone }}
</p>

<table>
    <thead>
        <tr>
            <th>Produk</th>
            <th class="right">Kuantiti</th>
            <th class="right">Harga</th>
            <th class="right">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td class="right">{{ $product->quantity }}</td>
            <td class="right">RM {{ number_format($product->price, 2) }}</td>
            <td class="right">RM {{ number_format($product->subtotal, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p class="right total">
    Jumlah Keseluruhan: RM {{ number_format($order->total_amount, 2) }}
</p>

<hr>

<p class="muted">
    Terima kasih atas pembelian anda.
</p>

</body>
</html>
