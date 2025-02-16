<!-- laporan_spm_pdf_detail.blade.php -->
<h1>Laporan SPM - Kualifikasi Pembayaran: {{ $nospm }}</h1>
<p>{{ var_dump($nospm) }}</p>
<p>No SPM: {{ $nospm }}</p>

<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No SPM</th>
            <th>Uraian</th>
            <th>Tanggal SPM</th>
            <th>Nominal</th>
            <th>Kualifikasi Pembayaran</th>
            <th>Nama Unit</th>
            <th>Nama Rak</th>
            <th>Tanggal Input</th>
            <th>Tanggal Update</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporanSpm as $spm)
        <tr>
            <td>{{ $spm->nospm }}</td>
            <td>{{ $spm->uraian }}</td>
            <td>{{ $spm->tanggal_spm }}</td>
            <td>{{ number_format($spm->nominal_spm, 0, ',', '.') }}</td>
            <td>{{ $spm->kualifikasi_pembayaran }}</td>
            <td>{{ $spm->unit ? $spm->unit->nama_unit : 'Tidak ada unit' }}</td>
            <td>{{ $spm->rak ? $spm->rak->nama_rak : 'Tidak ada rak' }}</td>
            <td>{{ $spm->create_at }}</td>
            <td>{{ $spm->update_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
