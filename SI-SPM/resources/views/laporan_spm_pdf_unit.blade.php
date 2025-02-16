<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SPM</title>
</head>
<body>
<h1>Laporan SPM</h1>
<h2>Unit: {{ $laporanSpm[0]->unit->nama_unit ?? 'No unit found' }}</h2>  <!-- Display unit name safely -->
    
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No. SPM</th>
            <th>Uraian</th>
            <th>Nominal</th>
            <th>Tanggal SPM</th>
            <th>Kualifikasi Pembayaran</th>
            <th>Unit</th>
            <th>Nama Rak</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporanSpm as $spm)
        <tr>
            <td>{{ $spm->nospm }}</td>
            <td>{{ $spm->uraian }}</td>
            <td>{{ number_format($spm->nominal_spm, 2) }}</td>
            <td>{{ $spm->tanggal_spm ? \Carbon\Carbon::parse($spm->tanggal_spm)->format('d-m-Y') : 'Tanggal tidak tersedia' }}</td>
            <td>{{ $spm->kualifikasi_pembayaran }}</td>
            <td>{{ $spm->unit ? $spm->unit->nama_unit : 'Tidak ada unit' }}</td> <!-- Check if unit exists -->
            <td>{{ $spm->rak ? $spm->rak->nama_rak : 'Tidak ada rak' }}</td> <!-- Check if rak exists -->
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
