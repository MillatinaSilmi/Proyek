<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SPM</title>
</head>
<body>
    <h1>Laporan SPM - Kualifikasi Pembayaran: {{ $kualifikasiPembayaran }}</h1>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Nomor SPM</th>
                <th>Kualifikasi Pembayaran</th>
                <th>Uraian</th>
                <th>Unit</th>
                <th>Nominal SPM</th>
                <th>Nama Rak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanSpm as $spm)
                <tr>
                    <td>{{ $spm->nospm }}</td>
                    <td>{{ $spm->kualifikasi_pembayaran }}</td>
                    <td>{{ $spm->uraian }}</td>
                    <td>{{ $spm->unit ? $spm->unit->nama_unit : 'Tidak ada unit' }}</td> <!-- Mengakses relasi unit untuk setiap laporan -->
                    <td>{{ number_format($spm->nominal_spm, 0, ',', '.') }}</td> <!-- Format nominal spm -->
                    <td>{{ $spm->rak ? $spm->rak->nama_rak : 'Tidak ada rak' }}</td> <!-- Mengakses relasi rak -->
                </tr>
            @endforeach

         
        </tbody>
    </table>
</body>
</html>
