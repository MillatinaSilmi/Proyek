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
            justify-content: flex-end; /* Aligns the content to the right */
            align-items: center;
            margin-bottom: 20px;
        }

        /* Header Buttons */
        .header-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        .home-btn {
            background-color: #8aae92; /* Same as other buttons */
            color: white;
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
        }

        .home-btn:hover {
            background-color: #5a5a5a; /* Hover effect similar to other buttons */
        }

        /* General Button Styling */
        button {
            background-color: #8aae92; /* Common background color for buttons */
            color: white;
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #5a5a5a; /* Hover effect for all buttons */
        }

        /* Button Styling for Add Rak Button */
        .add-btn {
            background-color: #8aae92; /* Same as other buttons */
            color: white;
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
        }

        .add-btn:hover {
            background-color: #5a5a5a; /* Hover effect */
        }

        /* Search Form */
        .content .search {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
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
            cursor: pointer;
        }

        .content .data {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <!-- Logo can be added here -->
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
                <li><button onclick="window.location.href='{{ route('unit.create') }}'">Data Unit</button>
                </button></li>


                <li>
                    <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                    <ul id="kelola-user">
                        <li><button onclick="redirectToPage('datauser')"> Data User</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('laporan-spm')">Laporan SPM</button>
                    <ul id="laporan-spm">
                        <li><button onclick="redirectToPage('indefilter')"> Laporan By No SPM </button></li>    
                        <li><button onclick="redirectToPage('laporanunit')"> Laporan By Unit </button></li>
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
            
            <div class="header-buttons">
                <a href="home" class="home-btn">Home</a>
            </div>
        </div>
        <h2>Kelola Rak</h2>
        <div class="search">
            <form action="{{ route('rak.search') }}" method="GET">
                <input type="text" name="nama_rak" value="{{ old('nama_rak') }}" placeholder="Cari nama rak..." required>
                <button type="submit">Cari</button>
            </form>
            <a href="input-rak" class="add-btn">Tambah Data Rak</a>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Rak</th>
                        <th>Nama Rak</th>
                        <th>Lokasi Rak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datarak as $rak)
                        <tr>
                            <td>{{ $rak->id_rak }} </td>
                            <td>{{ $rak->nama_rak }}</td>
                            <td>
                                <p><strong></strong>
                                @switch($rak->id_lokasi)
                                    @case(1) Tata Usaha @break
                                    @case(2) Perencanaan dan Evaluasi DAS @break
                                    @case(3) RHL @break
                                    @case(4) Penguatan Kelembagaan DAS @break
                                    @default Lokasi Rak tidak ditemukan
                                @endswitch
                                </p>
                            </td>
                            <td>
                                
                          <!-- Edit Button -->
<!-- Edit Button as a Button (Using Form for GET Request) -->
<form action="{{ route('rak.edit', ['id_rak' => $rak->id_rak]) }}" method="GET" style="display:inline-block;">
    <button type="submit" class="btn btn-green">Edit</button>
</form>


<!-- Delete Form -->
<!-- Delete Form -->
<form action="{{ route('rak.destroy', ['id_rak' => $rak->id_rak]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-red">Delete</button>
</form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
 
 
<!-- Pagination links with search query -->
<div class="pagination">
    {{ $datarak->appends(['nama_rak' => request()->input('nama_rak')])->links() }}
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


        document.getElementById('kelola-rak').style.display = 'block';
    </script>
</body>
</html>
