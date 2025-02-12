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
            flex-direction: row;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #a7c8b6;
            color: white;
            position: fixed; /* Sidebar fixed di sebelah kiri */
            top: 0;
            left: 0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            z-index: 10; /* Membuat sidebar berada di atas konten */
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
            margin-left: 250px; /* Menyesuaikan agar konten tidak tertutup sidebar */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Modal Styles */
        #modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        #modal .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        #modal h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        #modal input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #modal button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #modal .btn-save {
            background-color: #8aae92;
            color: white;
            margin-top: 10px;
        }

        #modal .btn-cancel {
            background-color: #ff4d4d;
            color: white;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <!-- Logo -->
        </div>
        <div class="menu">
            <ul>
                <li>
                    <button onclick="toggleMenu('kelola-spm')" class="active">Kelola Data SPM</button>
                    <ul id="kelola-spm">
                        <li><button onclick="window.location.href='/dataspm'"> Data SPM</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-rak')">Kelola Rak</button>
                    <ul id="kelola-rak">
                        <li><button onclick="window.location.href='/datarak'"> Data RAK</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-unit')">Kelola Unit</button>
                    <ul id="kelola-unit">
                        <li><button onclick="window.location.href='/unit/create'">Data Unit</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                    <ul id="kelola-user">
                        <li><button onclick="window.location.href='/datauser'"> Data User</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('laporan-spm')">Laporan SPM</button>
                    <ul id="laporan-spm">
                        <li><button onclick="window.location.href='/laporanbyspm'"> Laporan By No SPM </button></li>
                        <li><button onclick="window.location.href='/laporanunit'"> Laporan By Unit </button></li>
                        <li><button onclick="window.location.href='/laporan'">Laporan By Klasifikasi Pembayaran</button></li>
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
        <h1>Kelola Unit</h1>

        <!-- Form untuk Cari Unit dan Tombol Tambah Data Unit sejajar -->
        <div style="display: flex; align-items: center; gap: 10px;">
            <form action="{{ url('/unit/create') }}" method="GET" style="display: flex; gap: 10px;">
                <input type="text" name="keyword" placeholder="Cari unit..." value="{{ request('keyword') }}" style="padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
                <button type="submit" style="padding: 10px 20px; font-size: 16px; background-color: #8aae92; color: white; border: none; border-radius: 5px; cursor: pointer;">Cari</button>
            </form>
            
            <!-- Tombol untuk menampilkan modal -->
            <button id="openModalBtn" style="padding: 10px 20px; font-size: 16px; background-color: #8aae92; color: white; border: none; border-radius: 5px; cursor: pointer;">Tambah Data Unit</button>
        </div>

        <!-- Modal -->
        <div id="modal">
            <div class="modal-content">
                <h3>Form Input Unit</h3>
                <form action="{{ url('/unit') }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <label for="id_unit" style="display: block; font-weight: bold; margin-bottom: 5px;">ID Unit:</label>
                        <input type="text" id="id_unit" name="id_unit" value="{{ old('id_unit') }}" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="nama_unit" style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Unit:</label>
                        <input type="text" id="nama_unit" name="nama_unit" value="{{ old('nama_unit') }}" required>
                    </div>
                    <button type="submit" class="btn-save">
                        Simpan Unit
                    </button>
                    <button type="button" onclick="closeModal()" class="btn-cancel">
                        Batal
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel data unit -->
        <div class="data">
            <h2></h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Unit</th>
                        <th>Nama Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unit as $unit)
                        <tr>
                            <td>{{ $unit->id_unit }}</td>
                            <td>{{ $unit->nama_unit }}</td>
                            <td>
                                <a href="{{ route('unit.edit', $unit->id_unit) }}" style="background-color: #8aae92; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Edit</a>
                                <form action="{{ route('unit.destroy', $unit->id_unit) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus unit ini?');" style="background-color: #8aae92; color: white; padding: 5px 10px; border-radius: 5px;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('openModalBtn').onclick = function() {
            document.getElementById('modal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        // Fungsi untuk toggle menu
        function toggleMenu(menuId) {
            var menu = document.getElementById(menuId);
            if (menu.style.display === "none" || menu.style.display === "") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }

        // Menambahkan event listener ke setiap tombol menu
        var buttons = document.querySelectorAll('.sidebar ul li button');
        buttons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                // Menghindari aksi default agar event hanya berjalan pada tombol menu
                event.stopPropagation();
                if (this.classList.contains('active')) {
                    this.classList.remove('active');
                } else {
                    buttons.forEach(function(btn) {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
