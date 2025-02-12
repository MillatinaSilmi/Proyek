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
                    <button onclick="toggleMenu('kelola-spm')" class="active">Kelola Data SPM</button>
                    <ul id="kelola-spm">
                    <li><button onclick="redirectToPage('dataspm')"> Data SPM</button></li>
                       </ul>
                    <script>
    function redirectToPage(url) {
        window.location.href = url;
    }
</script>
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
                    <li><button onclick="redirectToPage('dataunit')"> Data Unit</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                    <ul id="kelola-user">
                    <li><button onclick="redirectToPage('datauser')"> Data User</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('laporan-spm')">Laporan SPM</button>
                    <ul id="laporan-spm">
                    <li><button onclick="redirectToPage('dataspm')"> Laporan By No SPM </button></li>    
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


    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h1>Kelola Data User</h1>
            <div class="user">
                <span>Nama User</span>
                <img src="user-photo.png" alt="Foto User">
            </div>
        </div>
        <head>
    <title>Form Input Data User</title>
</head>
<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
</head>
    <h2>Form Input Data User</h2>

    <!-- Tampilkan pesan sukses -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Tampilkan validasi error -->
    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form dengan Bingkai</title>
    <style>
        /* Menambahkan bingkai pada tabel */
        .table-container {
            border: 1px solid #000; /* Bingkai luar tabel */
            padding: 5px;
            border-radius: 2px; /* Radius untuk sudut tumpul */
            margin-top: 1px;
        }

        table {
            width: 60%;
            border-collapse: collapse; /* Menghilangkan jarak antar sel */
        }

        table th, table td {
            border: 1px solid #000; /* Bingkai pada setiap sel */
            padding: 4px;
            text-align: left;
        }

        /* Menambahkan bingkai pada input dan textarea */
        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 95%; /* Lebar penuh */
            padding: 2px;
            margin: 2px 0;
            border: 1px solid #ccc; /* Bingkai input dan select */
            border-radius: 1px;
        }

        /* Menambahkan bingkai pada tombol */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 2px 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049; /* Efek hover */
        }
    </style>
</head>
<body>
    <div class="table-container">
        <table>
            <thead>
          
            <form action="{{ route('user.store') }}" method="POST">
            @csrf
    <div>
        <label for="NIP">NIP:</label>
        <input type="text" name="NIP" id="NIP" value="{{ old('NIP') }}" required>
        @error('NIP')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        @error('password')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="nama">Nama:</label>
        <input type="nama" name="nama" id="nama" required>
        @error('nama')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="id_role">Role:</label>
        <select name="id_role" id="id_role" required>
            @foreach($role as $role)
                <option value="{{ $role->id_role }}" {{ old('id_role') == $role->id_role ? 'selected' : '' }}>
                    {{ $role->nama_role }}
                </option>
            @endforeach
        </select>
        @error('id_role')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Tambah User</button>
</form>


        </table>
        
        </form>
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
        document.getElementById('kelola-user').style.display = 'block';
    </script>
</body>
</html>