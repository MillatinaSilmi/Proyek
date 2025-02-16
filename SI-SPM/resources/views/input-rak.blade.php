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

        .sidebar ul li button.active,
        .sidebar ul li button:hover {
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
        .home-btn {
    background-color: #8aae92;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
}

.home-btn:hover {
    background-color: #7b9a7a;
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

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
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

        .pagination a,
        .pagination span {
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

        .btn {
            background-color: #4a4d4a; /* Green */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #464b46; /* Hover effect */
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <!-- Logo image here -->
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
                        <li><button onclick="redirectToPage('dataunit')">Data Unit</button></li>
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
                        <li><button onclick="redirectToPage('dataspm')">Laporan By No SPM</button></li>
                        <li><button onclick="redirectToPage('laporanunit')">Laporan By Unit</button></li>
                        <li><button onclick="redirectToPage('laporan')">Laporan By Klasifikasi Pembayaran</button></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="logout">
            <!-- Logout form -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h2>Kelola Rak</h2>
            <div class="user">
        <!-- Add the Home button here -->
        <button class="home-btn" onclick="window.location.href='home'">Home</button>
    </div>
        </div>

        <div class="form-container">
        <div class="form-container">
    <h2>Tambah Data Rak</h2>
    <form action="{{ route('rak.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_rak">ID Rak:</label>
            <input type="text" name="id_rak" id="id_rak" value="{{ old('id_rak') }}" required>
            @error('id_rak')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_rak">Nama Rak:</label>
            <input type="text" name="nama_rak" id="nama_rak" required>
            @error('nama_rak')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_lokasi">Lokasi Rak:</label>
            <select name="id_lokasi" id="id_lokasi" required>
                @foreach($lokasirak as $lokasirak)
                    <option value="{{ $lokasirak->id_lokasi }}" {{ old('id_lokasi') == $lokasirak->id_lokasi ? 'selected' : '' }}>
                        {{ $lokasirak->lokasi_rak }}
                    </option>
                @endforeach
            </select>
            @error('id_lokasi')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="submit-btn">Tambah Rak</button>
    </form>
</div>

<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .form-container h2 {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-size: 14px;
        color: #555;
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #8aae92;
        outline: none;
    }

    .error-message {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: #8aae92;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #7b9a7a;
    }
</style>

        
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
        document.getElementById('kelola-rak').style.display = 'block';
    </script>
</body>

</html>
