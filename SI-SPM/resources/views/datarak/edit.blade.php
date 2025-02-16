<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Rak</title>
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
            list-style-type: none;
            margin: 0;
            padding-left: 20px;
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

        /* Form Styling */
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Button Styling for Submit */
        .btn-primary {
            background-color: #8aae92;
            color: white;
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a5a5a;
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
                        <li><button onclick="redirectToPage('')"> Data SPM</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-rak')">Kelola Rak</button>
                    <ul id="kelola-rak">
                        <li><button onclick="redirectToPage('')"> Data Rak</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-unit')">Kelola Unit</button>
                    <ul id="kelola-unit">
                        <li><button onclick="redirectToPage('')"> Data Unit</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                    <ul id="kelola-user">
                        <li><button onclick="redirectToPage('')"> Data User</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('laporan-spm')">Laporan SPM</button>
                    <ul id="laporan-spm">
                        <li><button onclick="redirectToPage('')"> Laporan By No SPM </button></li>    
                        <li><button onclick="redirectToPage('')"> Laporan By Unit </button></li>
                        <li><button onclick="redirectToPage('')">Laporan By Klasifikasi Pembayaran</button></li>
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
                <a href="{{ route('datarak.index') }}" class="home-btn">Kembali ke Data Rak</a>
            </div>
        </div>
        
        <div class="form-container">
            <h2>Edit Data Rak</h2>

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('rak.update', $rak->id_rak) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="id_rak">ID Rak</label>
                    <input type="text" class="form-control" id="id_rak" name="id_rak" value="{{ old('id_rak', $rak->id_rak) }}" readonly required>
                </div>

                <div class="form-group">
                    <label for="nama_rak">Nama Rak</label>
                    <input type="text" class="form-control" id="nama_rak" name="nama_rak" value="{{ old('nama_rak', $rak->nama_rak) }}" required>
                </div>

                <div class="form-group">
                    <label for="id_lokasi">Lokasi Rak</label>
                    <select class="form-control" id="id_lokasi" name="id_lokasi" required>
                        <option value="1" {{ $rak->id_lokasi == 1 ? 'selected' : '' }}>Tata Usaha</option>
                        <option value="2" {{ $rak->id_lokasi == 2 ? 'selected' : '' }}>Perencanaan dan Evaluasi DAS</option>
                        <option value="3" {{ $rak->id_lokasi == 3 ? 'selected' : '' }}>RHL</option>
                        <option value="4" {{ $rak->id_lokasi == 4 ? 'selected' : '' }}>Penguatan Kelembagaan DAS</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">Update Rak</button>
            </form>
        </div>
    </div>

    <script>
        // Function to toggle submenus
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        // Redirect function for menu items
        function redirectToPage(page) {
            window.location.href = page;
        }
    </script>
    <script>
        // JavaScript for toggling sidebar menus
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
    </script>
</body>
</html>
