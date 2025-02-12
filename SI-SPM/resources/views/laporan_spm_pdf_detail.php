<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>No SPM</th>
        <td>{{ $data->nospm }}</td>
    </tr>
    <tr>
        <th>Uraian</th>
        <td>{{ $data->uraian }}</td>
    </tr>
    <tr>
        <th>Tanggal SPM</th>
        <td>{{ $data->tanggal_spm }}</td>
    </tr>
    <tr>
        <th>Nominal</th>
        <td>{{ $data->nominal_spm ?? 'Nominal Tidak Tersedia' }}</td>
    </tr>
    <tr>
        <th>Kualifikasi Pembayaran</th>
        <td>{{ $data->kualifikasi_pembayaran }}</td>
    </tr>
    <tr>
        <th>Nama Unit</th>
        <td>{{ $nama_unit }}</td>
    </tr>
    <tr>
        <th>Nama Rak</th>
        <td>{{ $nama_rak }}</td>
    </tr>
    <tr>
        <th>Dokumen</th>
        <td></td>
    </tr>
    <tr>
        <th>Tanggal Input</th>
        <td>{{ $data->created_at }}</td>
    </tr>
</table>
