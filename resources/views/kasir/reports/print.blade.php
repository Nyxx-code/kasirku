<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk TRX-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page { size: 80mm auto; margin: 0; }
        body { font-family: 'Courier New', Courier, monospace; margin: 0; padding: 10px; color: #000; font-size: 13px; line-height: 1.4; }
        .receipt { width: 100%; max-width: 300px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h2 { font-size: 18px; margin: 0; }
        .divider { border-top: 1px dashed #000; margin: 8px 0; }
        .info { width: 100%; font-size: 12px; }
        .items { width: 100%; margin-top: 8px; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        .total-row { font-size: 15px; border-top: 1px solid #000; padding-top: 5px; margin-top: 5px; }
        .footer { text-align: center; margin-top: 15px; font-size: 11px; }
    </style>
</head>
<body onload="window.print();">

    <div class="receipt">
        <div class="header">
            <h2>KASIRKU</h2>
            <p style="margin: 2px 0;">Jl. Jenderal A. Yani No.47, Langkai, Kec. Pahandut</p>
            <p style="margin: 2px 0;">Kota Palangka Raya, Kalimantan Tengah 73111</p>
            <p style="margin: 2px 0;">Telp: 0895-1357-9525</p>
        </div>

        <div class="divider"></div>

        <table class="info">
            <tr><td>Waktu</td><td>: {{ $sale->created_at->format('d/m/Y H:i') }}</td></tr>
            <tr><td>No. Trx</td><td>: TRX-{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td></tr>
            <tr><td>Kasir</td><td>: {{ optional($sale->user)->name ?? 'Sistem' }}</td></tr>
        </table>

        <div class="divider"></div>

        <table class="items">
            @foreach($sale->saleItems as $item)
            <tr>
                <td colspan="3" class="bold">{{ optional($item->product)->name ?? 'Produk' }}</td>
            </tr>
            <tr>
                <td width="30%">{{ $item->qty }} x</td>
                <td width="40%">{{ number_format($item->price, 0, ',', '.') }}</td>
                <td width="30%" class="right">{{ number_format($item->qty * $item->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <div class="divider"></div>

        <table class="info total-row">
            <tr>
                <td class="bold">TOTAL</td>
                <td class="bold right">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Terima Kasih Atas Kunjungan Anda</p>
            <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</p>
        </div>
    </div>
</body>
</html>