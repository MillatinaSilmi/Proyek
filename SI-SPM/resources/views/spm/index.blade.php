
@if($dataSpm->isEmpty())
    <p>Data tidak ditemukan</p>
@else
    <table>
        <thead>
            <tr>
                <th>No SPM</th>
                <th>Unit</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataSpm as $spm)
                <tr>
                    <td>{{ $spm->nospm }}</td>
                    <td>{{ $spm->unit->name }}</td>
                    <td>{{ $spm->tanggal }}</td>
                    <td>{{ $spm->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
