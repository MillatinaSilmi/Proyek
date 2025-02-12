<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SPM</title>
</head>
<body>
    <h1>Laporan SPM</h1>
    
       <!-- Form untuk mencari berdasarkan No. SPM -->
    <form method="GET" action="{{ route('search') }}">
        <label for="no_spm">Cari berdasarkan No. SPM: </label>
        <input type="text" id="no_spm" name="no_spm" placeholder="Masukkan No. SPM" value="{{ request()->get('no_spm') }}">
        <button type="submit">Cari</button>
    </form>

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
            @foreach($laporanSpm as $spm)
                <tr>
                    <td>{{ $spm->nospm }}</td>
                    <td>{{ $spm->uraian }}</td>
                    <td>{{ number_format($spm->nominal_spm, 2) }}</td>
                    <td>{{ $spm->kualifikasi_pembayaran }}</td>
                    <td>{{ $spm->unit ? $spm->unit->nama_unit : 'Tidak ada unit' }}</td> <!-- Mengakses relasi unit -->
                    <td>{{ $spm->rak ? $spm->rak->nama_rak : 'Tidak ada rak' }}</td> <!-- Mengakses relasi rak -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
