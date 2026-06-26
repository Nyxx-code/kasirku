<!DOCTYPE html>
<html>
<head>
    <title>Laporan Sistem</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #dddddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Ringkasan Sistem KasirKu</h2>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <p><strong>Total Admin Terdaftar:</strong> {{ $totalAdmin }} Toko/Klien</p>
    <p><strong>Estimasi Total Omzet:</strong> Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Admin</th>
                <th>Nama Toko</th>
                <th>Tanggal Mendaftar</th>
                <th>Jam</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->store_name ?? 'Belum Diatur' }}</td>
                <td>{{ \Carbon\Carbon::parse($admin->created_at)->translatedFormat('d F Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($admin->created_at)->format('H:i') }} WIB</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>