<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SPM</title>
</head>
<body>
<h1>Laporan SPM</h1>

<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No. SPM</th>
            <th>Uraian</th>
            <th>Nominal</th>
            <th>Kualifikasi Pembayaran</th>
            <th>Unit</th>
            <th>Nama Rak</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $laporanSpm->nospm }}</td>
            <td>{{ $laporanSpm->uraian }}</td>
            <td>{{ number_format($laporanSpm->nominal_spm, 2) }}</td>
            <td>{{ $laporanSpm->kualifikasi_pembayaran }}</td>
            <td>{{ $laporanSpm->unit ? $laporanSpm->unit->nama_unit : 'Tidak ada unit' }}</td> <!-- Mengakses relasi unit -->
            <td>{{ $laporanSpm->rak ? $laporanSpm->rak->nama_rak : 'Tidak ada rak' }}</td> <!-- Mengakses relasi rak -->
        </tr>
    </tbody>
</table>
</body>
</html>
