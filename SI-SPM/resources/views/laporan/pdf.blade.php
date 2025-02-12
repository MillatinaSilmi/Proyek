<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SPM</title>
</head>
<body>
    <h1>Laporan SPM - Kualifikasi Pembayaran: {{ ucwords(str_replace('_', ' ', $request->kualifikasi_pembayaran)) }}</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kualifikasi Pembayaran</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanSpms as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $data->kualifikasi_pembayaran)) }}</td>
                    <td>{{ number_format($data->jumlah, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
