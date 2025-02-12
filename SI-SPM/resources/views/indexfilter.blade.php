<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian No SPM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            word-wrap: break-word;
        }
        .alert {
            padding: 15px;
            background-color: red;
            color: white;
            margin-bottom: 20px;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .pagination a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Form Pencarian -->
    <h2>Cari Nomor SPM</h2>
    <form method="GET" action="{{ route('indexfilter.search') }}">
        <input type="text" name="nospm" placeholder="Masukkan nomor SPM..." value="{{ request('nospm') }}">
        <button type="submit">Cari</button>
    </form>

    <!-- Menampilkan Pesan Error jika ada -->
    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Menampilkan Hasil Pencarian -->
    <!-- Menampilkan Hasil Pencarian dalam Tabel -->
    @if(isset($data) && !$data->isEmpty())
        <h3>Hasil Pencarian</h3>
        <table> @foreach($data as $spm)
            <thead>
                <tr>
                    <th>No SPM</th>
                    <th>{{ $spm->nospm }}</th>
                    <th>Uraian</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
               
                    <tr>
                        <td></td>
                        <td>{{ $spm->unit->nama_unit ?? 'Unit Tidak Ditemukan' }}</td>
                        <td>{{ $spm->uraian }}</td>
                        <td><a href="{{ route('detail.show', $spm->nospm) }}">Lihat Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Data tidak ditemukan.</p>
    @endif

</body>
</html>
