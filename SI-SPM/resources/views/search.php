<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian No SPM</title>
</head>
<body>
   <!-- Menampilkan hasil pencarian -->
   @if(isset($data) && !$data->isEmpty())
        <h3>Hasil Pencarian:</h3>
        <ul>
            @foreach($data as $spm)
                <li>{{ $spm->no_spm }} - {{ $spm->deskripsi }}</li> <!-- sesuaikan dengan field yang ingin ditampilkan -->
            @endforeach
        </ul>
    @else
        <p>Data tidak ditemukan.</p>
    @endif
</body>
</html>
