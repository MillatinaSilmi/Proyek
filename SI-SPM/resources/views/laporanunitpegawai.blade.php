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
        <div class="logo">
            
        </div>
        <div class="menu">
            <ul>
                <li>
                  
                    <ul id="kelola-spm">
                    
                       </ul>
                    <script>
    function redirectToPage(url) {
        window.location.href = url;
    }
</script>
                </li>
               
                
                
                <li>
                    <button onclick="toggleMenu('laporan-spm')">Laporan SPM</button>
                    <ul id="laporan-spm">
                    <li><button onclick="redirectToPage('indexfilterpegawai')"> Laporan By No SPM </button></li>    
                    <li><button onclick="redirectToPage('laporanunitpegawai')"> Laporan By Unit </button></li>
                    <li><button onclick="redirectToPage('laporankualifikasipegawai')">Laporan By Klasifikasi Pembayaran</button></li>
                        
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
    <!-- Main Content -->
    <div class="content">
        <div class="header">
            
            <div class="user">
                <span>Nama User</span>
                <img src="user-photo.png" alt="Foto User">
            </div>
        </div>
        
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Border</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .table-container {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Border</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .table-container {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data SPM</title>
</head>
<body>
<h1>Pencarian Laporan SPM</h1>

<!-- Form untuk memilih unit -->
<form method="GET" action="{{ route('laporanunitpegawai.searchUnitPegawai') }}">
    <label for="id_unit">Pilih Unit:</label>
    <select name="id_unit" id="id_unit">
        <option value="">-- Pilih Unit --</option>
        @foreach($unit as $item)  <!-- Menampilkan daftar unit -->
            <option value="{{ $item->id_unit }}" {{ request('id_unit') == $item->id_unit ? 'selected' : '' }}>
                {{ $item->nama_unit }}
            </option>
        @endforeach
    </select>
    <button type="submit">Cari</button>
</form>

<!-- Menampilkan pesan error jika tidak ada unit yang dipilih -->
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Menampilkan hasil pencarian jika ada -->
@if(isset($laporanSpm))
    <h2>Hasil Pencarian</h2>
    <table>
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
                    <td>{{ $spm->unit->nama_unit }}</td>  <!-- Menampilkan nama unit -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol untuk mengonversi laporan ke PDF -->
    <a href="{{ route('laporanunitpegawai.convertToPdfUnitPegawai', ['id_unit' => request('id_unit')]) }}" class="btn btn-primary">
        Unduh Laporan dalam PDF
    </a>
@endif
</body>
</html>
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
        document.getElementById('kelola-spm').style.display = 'block';
    </script>
</body>
</html>