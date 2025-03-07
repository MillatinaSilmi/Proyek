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

        /* Tombol Home */
        .home-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #8aae92;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Form Pencarian */
        .content .search {
            display: flex;
            margin-bottom: 20px;
            align-items: center;
        }

        .content .search label {
            margin-right: 10px;
            font-size: 16px;
        }

        .content .search select,
        .content .search button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .content .search button {
            background-color: #8aae92;
            color: white;
            margin-left: 10px;
            cursor: pointer;
        }

        /* Data Table */
        .content .data {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #8aae92;
            color: white;
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
                        <li><button onclick="redirectToPage('/dataspm')"> Data SPM</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-rak')">Kelola Rak</button>
                    <ul id="kelola-rak">
                        <li><button onclick="redirectToPage('/datarak')"> Data RAK</button></li>
                    </ul>
                </li>
                <li>
                <button onclick="toggleMenu('kelola-unit')">Kelola Unit</button>
    <ul id="kelola-unit">
        <li><button onclick="window.location.href='{{ route('unit.create') }}'">Data Unit</button>
        </li>
    </ul>
</li>

<script>
    function redirectToPage() {
        // Pastikan kita menggunakan URL yang benar
        var url = "{{ route('unit.create') }}";
        window.location.href = url;
    }

    function toggleMenu(menuId) {
        const menu = document.getElementById(menuId);
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    }
</script>
</li>
                <li>
                    <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                    <ul id="kelola-user">
                        <li><button onclick="redirectToPage('/datauser')"> Data User</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('laporan-spm')" class="active">Laporan SPM</button>
                    <ul id="laporan-spm">
                        <li><button onclick="redirectToPage('/indexfilteradmin')"> Laporan By No SPM </button></li>    
                        <li><button onclick="redirectToPage('/laporanunit')"> Laporan By Unit </button></li>
                        <li><button onclick="redirectToPage('/laporan')">Laporan By Klasifikasi Pembayaran</button></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="logout">
            <!-- Form logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- Tombol Home -->
    <button class="home-button" onclick="redirectToPage('/')">Home</button>

    <!-- Main Content -->
    <div class="content">
        <h1>Pencarian Laporan SPM</h1>

        <!-- Form untuk memilih unit -->
        <div class="search">
            <form method="GET" action="{{ route('laporanunit.search') }}">
                <label for="id_unit">Pilih Unit:</label>
                <select name="id_unit" id="id_unit">
                    <option value="">-- Pilih Unit --</option>
                    @foreach($unit as $item) 
                        <option value="{{ $item->id_unit }}" {{ request('id_unit') == $item->id_unit ? 'selected' : '' }}>
                            {{ $item->nama_unit }}
                        </option>
                    @endforeach
                </select>
                <button type="submit">Cari</button>
            </form>
        </div>

        <!-- Menampilkan pesan error jika tidak ada unit yang dipilih -->
       <!-- Menampilkan hasil pencarian jika ada -->
@if(isset($laporanSpm))
    <h2>Hasil Pencarian</h2>
    
    <!-- Pastikan tabel memiliki struktur yang benar -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No. SPM</th>
                <th>Uraian</th>
                <th>Nominal</th>
                <th>Kualifikasi Pembayaran</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanSpm as $spm)
                <tr>
                    <td>{{ $spm->nospm }}</td>
                    <td>{{ $spm->uraian }}</td>
                    <td>{{ number_format($spm->nominal_spm, 2) }}</td>
                    <td>{{ $spm->kualifikasi_pembayaran }}</td>
                    <td>{{ $spm->unit->nama_unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol untuk mengonversi laporan ke PDF -->
    <a href="{{ route('laporanunit.convertToPdf', ['id_unit' => request('id_unit')]) }}" class="btn btn-primary">
        Unduh Laporan dalam PDF
    </a>
@endif


    <script>
        function redirectToPage(url) {
            window.location.href = "http://127.0.0.1:8000" + url;
        }

        function toggleMenu(menuId) {
            const menus = document.querySelectorAll('.sidebar ul li ul');
            menus.forEach(menu => {
                if (menu.id === menuId) {
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                } else {
                    menu.style.display = 'none';
                }
            });
        }

        // Set default menu open
        document.getElementById('kelola-spm').style.display = 'block';
    </script>
</body>
</html>
