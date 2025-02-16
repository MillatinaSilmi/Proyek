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

    <!-- Main Content -->
    <div class="content">
        <div class="header">
            
            <div class="user">
              
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
    <style>
        /* Container untuk form dan tombol */
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px;
        }

        /* Styling untuk form */
        form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        input[type="text"] {
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 250px; /* Menentukan lebar input */
        }

        button[type="submit"] {
            padding: 8px 15px;
            font-size: 14px;
            background-color:rgb(68, 99, 82);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color:rgb(74, 100, 74);
        }

        /* Styling untuk tombol "Tambah Data User" */
        .btn {
            background-color: rgb(84, 126, 84); /* Warna tombol */
            color: white;
            padding: 8px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: rgb(70, 75, 70); /* Efek hover */
        }
    </style>
</head>
<body>
    <div></div>
<h2>Data User</h2>
<div class="container">
    <!-- Form pencarian -->
    <form action="{{ route('user.search') }}" method="GET">
        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Cari nama user..." required>
        <button type="submit">Cari</button>
    </form>

    <!-- Tombol tambah data user -->
    <a href="input-user" class="btn">Tambah Data User</a>
</div>

</body>

  

</body>
    </form>
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
      /* Smaller pagination */
.pagination {
    display: flex;
    justify-content: center;
    margin: 10px 0; /* Reduced margin for smaller spacing */
}

.pagination a, .pagination span {
    margin: 0 3px; /* Reduced margin between pagination links */
    padding: 6px 10px; /* Smaller padding for smaller buttons */
    text-decoration: none;
    color: #007bff; /* Blue color for normal links */
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px; /* Smaller font size */
}

.pagination a:hover {
    background-color: #f1f1f1;
}

/* Active page styling */
.pagination .active {
    background-color: rgb(11, 64, 120);
    color: #fff;
    border-color: #007bff;
}

/* Disabled page styling */
.pagination .disabled {
    color: #ccc;
    pointer-events: none;
    border-color: #ddd;
}

/* Styling for Next/Previous arrows */
.pagination .next, .pagination .previous {
    font-size: 12px; /* Smaller font size for arrows */
    padding: 6px 8px; /* Adjust padding to make arrows smaller */
    color: #6c757d; /* Gray color for the arrows */
    border: 1px solid #ddd; /* Light gray border */
    border-radius: 4px; /* Rounded corners for arrows */
}

.pagination .next:hover, .pagination .previous:hover {
    background-color: #f1f1f1; /* Light background on hover */
    color: #6c757d; /* Keep the same gray color on hover */
}

/* Disabled state for arrows */
.pagination .next:disabled, .pagination .previous:disabled {
    color: #ccc; /* Light gray for disabled arrows */
    cursor: not-allowed; /* Change cursor to indicate disabled state */
}

    </style>
</head>
<body>
<!DOCTYPE html>
<table>
    <thead>
        <tr>
            <th>Nama Pegawai</th>
            <th>NIP</th>
            <th>Role</th>
            <th>Password</th>
            <th>Aksi</th> <!-- Kolom untuk tombol Edit dan Hapus -->
        </tr>
    </thead>
    <tbody>
        @foreach ($datauser as $user)
            <tr>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->NIP }}</td>
                <td>
                    <p><strong>
                        @switch($user->id_role)
                            @case(1)
                                Admin
                                @break
                            @case(2)
                                Pegawai
                                @break
                            @default
                                Role tidak ditemukan
                        @endswitch
                    </strong></p>
                </td>
                <td>{{ $user->password }}</td>
                <td>
                    <!-- Tombol Edit -->
                                       <a href="{{ route('datauser.edit', $user->NIP) }}" class="btn">Edit</a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('datauser.destroy', $user->NIP) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

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