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

        .content .search button:hover {
            background-color: #6c8e6b;
        }

        /* Form Pencarian */
        .search-form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .search-form select,
        .search-form button {
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .search-form select {
            flex-grow: 1;
            width: 250px;
        }

        .search-form button {
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-form button:hover {
            background-color: #45a049; /* Slightly darker green */
        }

        .search-form button:active {
            background-color: #3e8e41; /* Even darker green */
        }

        .search-form select:focus,
        .search-form button:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .search-form select option {
            padding: 10px;
        }

        .table-container {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <!-- Your Logo here -->
        </div>
        <div class="menu">
            <ul>
                <li>
                    <button onclick="toggleMenu('kelola-spm')">Kelola Data SPM</button>
                    <ul id="kelola-spm">
                        <li><button onclick="redirectToPage('dataspm')"> Data SPM</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-rak')">Kelola Rak</button>
                    <ul id="kelola-rak">
                        <li><button onclick="redirectToPage('datarak')"> Data RAK</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-unit')">Kelola Unit</button>
                    <ul id="kelola-unit">
                 <li>   <button onclick="window.location.href='{{ route('unit.create') }}'">Data Unit</button></li>

                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                    <ul id="kelola-user">
                        <li><button onclick="redirectToPage('datauser')"> Data User</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('laporan-spm')" class="active">Laporan SPM</button>
                    <ul id="laporan-spm">
                        <li><button onclick="redirectToPage('indexfilteradmin')"> Laporan By No SPM </button></li>
                        <li><button onclick="redirectToPage('laporanunit')"> Laporan By Unit </button></li>
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
    function redirectToPage(url) {
            window.location.href = url;
        }

</script>
    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h3>Laporan SPM Berdasarkan Kualifikasi Pembayaran</h3>
        </div>

        <!-- Pencarian -->
        <form method="GET" action="{{ route('laporan.search') }}" class="search-form">
            <select name="kualifikasi_pembayaran" class="form-control">
            <option value="Belanja Modal">Pilih Kualifikasi</option>
                <option value="Belanja Modal" {{ old('kualifikasi_pembayaran') == 'Belanja Modal' ? 'selected' : '' }}>Belanja Modal</option>
                <option value="Belanja Barang" {{ old('kualifikasi_pembayaran') == 'Belanja Barang' ? 'selected' : '' }}>Belanja Barang</option>
                <option value="Belanja Pegawai" {{ old('kualifikasi_pembayaran') == 'Belanja Pegawai' ? 'selected' : '' }}>Belanja Pegawai</option>
            </select>
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <!-- Tabel -->
        @if(isset($laporanSpm) && $laporanSpm->isNotEmpty())
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nomor SPM</th>
                        <th>Kualifikasi Pembayaran</th>
                        <th>Uraian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporanSpm as $spm)
                        <tr>
                            <td>{{ $spm->nospm }}</td>
                            <td>{{ $spm->kualifikasi_pembayaran }}</td>
                            <td>{{ $spm->uraian }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form action="{{ route('laporan.convertToPdf') }}" method="GET">
            <input type="hidden" name="kualifikasi_pembayaran" value="{{ $kualifikasiPembayaran }}">
            <button type="submit" class="btn btn-success">Convert to PDF</button>
        </form>
        @else
            <p>Tidak ada data yang ditemukan untuk kualifikasi pembayaran.</p>
        @endif
    </div>

    <script>
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
        document.getElementById('laporan-spm').style.display = 'block';
    </script>
</body>
</html>
