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

        .sidebar .logo img {
            height: 40px;
            margin-right: 10px;
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
            display: none;
            padding-left: 20px;
            background-color: #93b6a0;
        }

        .sidebar ul li ul li button {
            padding: 10px;
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

        .content .header .user {
            display: flex;
            align-items: center;
        }

        .content .header .user img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }

        .content .search {
            display: flex;
            margin-bottom: 20px;
        }

        .content .search input {
            flex-grow: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .content .search button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #8aae92;
            color: white;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
        }

        .content .data {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
   <!-- Sidebar -->
<div class="sidebar">
    <div class="logo"></div>
    <div class="menu">
        <ul>
            <li>
                <button onclick="toggleMenu('kelola-spm')">Kelola Data SPM</button>
                <ul id="kelola-spm">
                    <li><button onclick="redirectToPage('dataspm')">Data SPM</button></li>
                </ul>
            </li>
            <li>
                <button onclick="toggleMenu('kelola-rak')">Kelola Rak</button>
                <ul id="kelola-rak">
                    <li><button onclick="redirectToPage('datarak')">Data RAK</button></li>
                </ul>
            </li>
            <li>
                <button onclick="toggleMenu('kelola-unit')">Kelola Unit</button>
                <ul id="kelola-unit">
                    <li><button onclick="window.location.href='{{ route('unit.create') }}'">Data Unit</button></li>
                </ul>
            </li>
            <li>
                <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                <ul id="kelola-user">
                    <li><button onclick="redirectToPage('datauser')">Data User</button></li>
                </ul>
            </li>
            <li>
                <button onclick="toggleMenu('laporan-spm')" class="active">Laporan SPM</button>
                <ul id="laporan-spm">
                    <li><button onclick="redirectToPage('indexfilteradmin')">Laporan By No SPM</button></li>
                    <li><button onclick="redirectToPage('laporanunit')">Laporan By Unit</button></li>
                    <li><button onclick="redirectToPage('laporan')">Laporan By Klasifikasi Pembayaran</button></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="logout">
        <!-- Form logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf  <!-- Pastikan untuk menyertakan token CSRF -->
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<script>
    function redirectToPage(routeName) {
        window.location.href = "{{ url('/') }}/" + routeName;
    }
</script>

    <!-- Tombol Home -->
    <button class="home-button" onclick="window.location.href='{{ route('home') }}'">Home</button>

    <!-- Konten Utama -->
    <div class="content">
        <h2>Laporan SPM Berdasarkan Nomor SPM</h2>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('indexfilteradmin.search') }}" class="search">
            <input type="text" name="nospm" placeholder="Masukkan nomor SPM..." value="{{ request('nospm') }}">
            <button type="submit">Cari</button>
        </form>

        <!-- Menampilkan Hasil Pencarian -->
        @if(isset($data) && !$data->isEmpty())
            <h3>Hasil Pencarian</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>No. SPM</th>
                        <th>Tanggal SPM</th>
                        <th>Nominal SPM</th>
                        <th>Uraian</th>
                        <th>Unit</th>
                        <th>Kualifikasi Pembayaran</th>
                        <th>Nama Rak</th>
                        <th>Dokumen</th>
                        <th>Tanggal Input</th>
                        <th>Tanggal Update</th>
                        <th>Unduh PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $spm)
                        <tr>
                            <td>{{ $spm->nospm }}</td>
                            <td>{{ $spm->tanggal_spm }}</td>
                            <td>{{ number_format($spm->nominal_spm, 2, ',', '.') }}</td>
                            <td>{{ $spm->uraian }}</td>
                            <td>{{ $spm->unit->nama_unit ?? 'Unit Tidak Ditemukan' }}</td>
                            <td>{{ $spm->kualifikasi_pembayaran }}</td>
                            <td>{{ $spm->rak->nama_rak ?? 'Rak Tidak Ditemukan' }}</td>
                            <td>
                                @if($spm->dokumen)
                                    <a href="{{ Storage::url($spm->dokumen) }}" target="_blank" class="btn-link">Lihat Dokumen</a>
                                @else
                                    Tidak ada dokumen
                                @endif
                            </td>
                            <td>{{ $spm->create_at }}</td>
                            <td>{{ $spm->update_at }}</td>
                            <td>
                            <a href="{{ route('indexfilteradmin.convertToPdf', ['nospm' => $spm->nospm, 'type' => 'pdf']) }}" class="btn-primary">
    Unduh PDF
</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Data tidak ditemukan.</p>
        @endif
    </div>

    <!-- JavaScript untuk Toggle Menu -->
    <script>
        // Fungsi untuk toggle menu
        function toggleMenu(menuId) {
            var menu = document.getElementById(menuId);
            if (menu.style.display === "none" || menu.style.display === "") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }

        // Fungsi untuk redirect ke halaman lain
        function redirectToPage(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
