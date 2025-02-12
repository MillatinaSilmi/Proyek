<!DOCTYPE html>
<html>
<head>
    <title>Pencarian No SPM</title>
</head>
<body>
    <h2>Pencarian No SPM</h2>

    <!-- Tampilkan pesan error jika nomor SPM tidak ditemukan -->
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('search') }}" method="POST">
        @csrf
        <label for="nospm">Masukkan No SPM:</label>
        <input type="text" id="nospm" name="nospm" required>
        <button type="submit">Cari</button>
    </form>

    <!-- Tampilkan hasil pencarian jika data ditemukan -->
    @if(isset($data))
        @if($data->isEmpty())
            <p>Data tidak ditemukan.</p>
        @else
            <h3>Hasil Pencarian:</h3>
            <ul>
                @foreach($data as $spm)
                    <li>{{ $spm->no_spm }} - {{ $spm->deskripsi }}</li> <!-- sesuaikan dengan atribut data yang ingin ditampilkan -->
                @endforeach
            </ul>
        @endif
    @endif
</body>
</html>
