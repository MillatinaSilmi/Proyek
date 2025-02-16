<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Arsip SPM</title>
    <style>
        /* Styling untuk body dan sidebar */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f8f4;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            height: 100%;
                       background-color: #a7c8b6;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
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
            background-color: #8aae92;
        }

        .sidebar ul li ul li button {
            padding: 10px;
        }

        .sidebar .logout {
            margin-top: auto;
            padding: 15px;
            text-align: center;
            background-color: #8aae92;
        }

        .sidebar .logout button {
            width: 100%;
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        /* Styling untuk main content */
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            position: relative;
        }

        .content .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .content .search {
            display: flex;
            justify-content: space-between;
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

        .content .home-link {
            background-color: #8aae92;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
        }

        .content .home-link:hover {
            background-color: #8aae92;
        }

        /* Styling tabel dan pagination */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            
            <span></span>
        </div>
        <div class="menu">
            <ul>
                <li>
                    <button onclick="toggleMenu('kelola-spm')" class="active">Kelola Data SPM</button>
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
                        <li><button onclick="window.location.href='{{ route('unit.create') }}'">Data Unit</button>
                       </li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                    <ul id="kelola-user">
                        <li><button onclick="redirectToPage('datauser')">Data User</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('laporan-spm')">Laporan SPM</button>
                    <ul id="laporan-spm">
                        <li><button onclick="redirectToPage('indexfilteradmin')">Laporan By No SPM</button></li>
                        <li><button onclick="redirectToPage('laporanunit')">Laporan By Unit</button></li>
                        <li><button onclick="redirectToPage('laporan')">Laporan By Klasifikasi Pembayaran</button></li>
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
        <div class="header">
            <h1>Data SPM</h1>
            <!-- Link Home di sudut kanan atas -->
            <a href="{{ url('home') }}" class="home-link">Home</a>
        </div>

        <!-- Form Pencarian -->
        <div class="search">
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <input type="text" name="search_term" placeholder="Search..." required>
                <button type="submit">Cari</button>
            </form>
            <button type="button" class="btn" onclick="window.location.href='input-spm';">Tambah Data SPM</button>
</div>
        
        <div class="table-container">
            <!-- Tampilkan pesan error jika nomor SPM tidak ditemukan -->
            @if(session('error'))
                <p style="color: red;">{{ session('error') }}</p>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>No SPM</th>
                        <th>Uraian SPM</th>
                        <th>Nominal SPM</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                <table>
    <thead>
        <tr>
            <th>No. SPM</th>
            <th>Uraian</th>
            <th>Nominal SPM</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataspm as $data)
            <tr>
                <td>{{ $data->nospm }}</td>
                <td>{{ $data->uraian }}</td>
                <td>{{ number_format($data->nominal_spm, 2, ',', '.') }}</td>
                <td><a href="{{ route('detail.show', $data->nospm) }}" class="btn-detail">Detail</a></td>
            </tr>
        @empty
            <tr><td colspan="4">No data available.</td></tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
<div class="pagination">
    {{ $dataspm->links() }}
</div>

        </div>
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

        function redirectToPage(url) {
            window.location.href = url;
        }

        // Set default menu open
        document.getElementById('kelola-spm').style.display = 'block';
    </script>
</body>
</html>
