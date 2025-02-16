<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Arsip SPM</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f8f4;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #a7c8b6;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: #8aae92;
        }

        .sidebar .menu {
            flex-grow: 1;
        }

        .sidebar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .sidebar ul li {
            position: relative;
        }

        .sidebar ul li button {
            width: 100%;
            background: none;
            border: none;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 16px;
            cursor: pointer;
            outline: none;
        }

        .sidebar ul li button.active, .sidebar ul li button:hover {
            background-color: #8aae92;
        }

        .sidebar ul li ul {
            display: none; /* Submenu disembunyikan secara default */
            padding-left: 20px;
            background-color: #93b6a0;
        }

        .sidebar ul li ul li a {
            padding: 10px;
            display: block;
            color: white;
            text-decoration: none;
        }

        .sidebar ul li ul li a:hover {
            background-color: #8aae92;
        }

        .sidebar .logout {
            margin-top: auto;
            background-color: #8aae92;
            padding: 15px;
            text-align: center;
        }

        .sidebar .logout button {
            width: 100%;
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        /* Main Content */
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        .content .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .content .home-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #8aae92;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .content .search {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }

        .content .search input {
            flex-grow: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .content .search button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #8aae92;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .table-container {
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #8aae92;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination a, .pagination span {
            margin: 0 5px;
            padding: 8px 12px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #f1f1f1;
        }

        .pagination .active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination .disabled {
            color: #ccc;
            pointer-events: none;
            border-color: #ddd;
        }

        /* Alert */
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <!-- Logo Section -->
        </div>
        <div class="menu">
            <ul>
                <li>
                    <button onclick="toggleMenu('laporan-spm')">Laporan SPM</button>
                    <ul id="laporan-spm">
                        <li><a href="{{ url('indexfilter') }}" class="menu-link">Laporan By No SPM</a></li>
                        <li><a href="{{ url('laporanunitpegawai') }}" class="menu-link">Laporan By Unit</a></li>
                        <li><a href="{{ url('laporankualifikasipegawai') }}" class="menu-link">Laporan By Klasifikasi Pembayaran</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <button class="home-button" onclick="window.location.href='{{ url('home') }}'">Home</button>

        <h2>Laporan SPM Berdasarkan Nomor SPM</h2>

        <!-- Form Pencarian -->
        <div class="search">
            <form method="GET" action="{{ route('indexfilter.searchNoPegawai') }}" style="display: flex; align-items: center; width: 100%;">
                <input type="text" name="nospm" placeholder="Masukkan nomor SPM..." value="{{ request('nospm') }}" style="flex-grow: 1;">
                <button type="submit">Cari</button>
            </form>
        </div>

        <!-- Menampilkan Pesan Error jika ada -->
        @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Menampilkan Hasil Pencarian -->
        @if(isset($data) && !$data->isEmpty())
            <h3>Hasil Pencarian</h3>
            <div class="table-container">
                <table>
                    @foreach($data as $spm)
                        <thead>
                            <tr>
                                <td>No. SPM</td>
                                <td>{{ $spm->nospm }}</td>
                            </tr>
                            <tr><td>Tanggal SPM</td>
                                <td>{{ $spm->tanggal_spm }}</td>
                            </tr>
                            <tr>
                                <td>Nominal SPM</td>
                                <td>{{ number_format($spm->nominal_spm, 2, ',', '.') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Uraian</td>
                                <td>{{ $spm->uraian }}</td>
                            </tr>
                            <tr><td>Unit</td>
                                <td>{{ $spm->unit->nama_unit ?? 'Unit Tidak Ditemukan' }}</td></tr>                          
                            <tr><td>Kualifikasi Pembayaran</td>
                                <td>{{ $spm->kualifikasi_pembayaran}}</td></tr>                          
                            <tr><td>Nama Rak</td>
                                <td>{{ $spm->rak->nama_rak ?? 'Rak Tidak Ditemukan' }}</td></tr> 
                            <tr>
                                <td>Dokumen</td>
                                <td>@if($spm->dokumen)
                                    <a href="{{ Storage::url($spm->dokumen) }}" target="_blank">Lihat Dokumen</a>
                                @else
                                    Tidak ada dokumen
                                @endif</td>
                            </tr>
                            <tr>
                                <td>Tanggal Input</td>
                                <td>{{ $spm->create_at}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Update</td>
                                <td>{{ $spm->update_at}}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>

            <!-- PDF Conversion Button -->
            @foreach($data as $spm)
                <a href="{{ route('indexfilter.convertToPdf', ['nospm' => $spm->nospm]) }}" class="btn btn-primary">
                    Unduh Laporan dalam PDF
                </a>
            @endforeach
        @else
            <p>Data tidak ditemukan.</p>
        @endif
    </div>

    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            if (menu.style.display === 'block') {
                menu.style.display = 'none';  // Sembunyikan jika sudah terbuka
            } else {
                menu.style.display = 'block';  // Tampilkan jika tersembunyi
            }
        }
    </script>

</body>
</html>
