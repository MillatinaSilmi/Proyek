<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data User</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f1f8f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 18px;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            height: 45px;
        }

        .form-group select {
            height: 50px;
        }

        .form-group .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .success-message,
        .error-message {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }

        /* Sidebar Styling */
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
            <!-- Logo here if needed -->
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
            <!-- Form logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <h2>Form Input Data User</h2>

            <!-- Tampilkan pesan sukses -->
            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            <!-- Tampilkan validasi error -->
            @if($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Input -->
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="NIP">NIP:</label>
                    <input type="text" name="NIP" id="NIP" value="{{ old('NIP') }}" required>
                    @error('NIP')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_role">Role:</label>
                    <select name="id_role" id="id_role" required>
                        @foreach($role as $role)
                            <option value="{{ $role->id_role }}" {{ old('id_role') == $role->id_role ? 'selected' : '' }}>
                                {{ $role->nama_role }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_role')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">Tambah User</button>
            </form>
        </div>
    </div>

    <script>
        function redirectToPage(url) {
            window.location.href = url;
        }
    </script>

</body>
</html>
