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

        /* Search Form */
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

        /* Table Styles */
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

        /* Button to convert to PDF */
        .convert-btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color:  #8aae92;;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: inline-block;
        }

        .convert-btn:hover {
            background-color: # #8aae92;;
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
                    <li><button onclick="redirectToPage('{{ url('indexfilter') }}')" class="menu-link">Laporan By No SPM</button></li>
                    <li><button onclick="redirectToPage('{{ url('laporanunitpegawai') }}')" class="menu-link">Laporan By Unit</button></li>
                    <li><button onclick="redirectToPage('{{ url('laporankualifikasipegawai') }}')" class="menu-link">Laporan By Klasifikasi Pembayaran</button></li>
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
        <h2>Laporan SPM Berdasarkan Unit </h2>
        </div>
        
        <!-- Search Form -->
        <div class="search">
            <form method="GET" action="{{ route('laporanunitpegawai.search') }}">
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

        <!-- Error Message -->
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Results Table -->
        @if(isset($laporanSpm))
            <div class="data">
                <h2>Hasil Pencarian</h2>
                <div class="table-container">
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
                                    <td>{{ $spm->unit->nama_unit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Convert to PDF Button -->
                <a href="{{ route('laporanunitpegawai.convertToPdfUnitPegawai', ['id_unit' => request('id_unit')]) }}" class="convert-btn">
                    Unduh Laporan dalam PDF
                </a>
            </div>
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

        function redirectToPage(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
