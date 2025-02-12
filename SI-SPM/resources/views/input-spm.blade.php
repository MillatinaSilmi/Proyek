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
    <h2>Tambah Data SPM</h2>

   <!-- Tampilkan pesan error jika nomor SPM tidak ditemukan -->
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

        <style>
        .btn {
            background-color:rgb(74, 77, 74); /* Hijau */
            color: white;
            padding: 4px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color:rgb(70, 75, 70); /* Efek hover */
        }
    </style>
</head>
<body>

<body>
    <div class="table-container">
        <table>
            <thead>
  
    <form action="{{ route('spm.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
   
        <tr>
       <th> <label for="nospm">Nomor SPM:</label><br></th>
      <th>  <input type="text" id="nospm" name="nospm" value="{{ old('nospm') }}" required><br><br></th>
    </tr>
    <tr>
     <th>   <label for="uraian">Uraian SPM:</label><br></th>
        <th><textarea id="uraian" name="uraian" required>{{ old('uraian') }}</textarea><br><br></th>
    </tr>
    <tr>
     <th>   <label for="uraian">Nominal SPM:</label><br></th>
      <th>  <textarea id="nominal_spm" name="nominal_spm" required>{{ old('nominal_spm') }}</textarea><br><br></th>
    </tr>
    <tr><th>    <label for="tanggal_spm">Tanggal SPM:</label><br></th>
    <th>
<input 
    type="date" 
    id="tanggal_spm" 
    name="tanggal_spm" 
    value="{{ old('tanggal_spm') }}" 
    required><br><br></th>
    </tr>
    <tr><th>  <label for="kualifikasi_pembayaran">Kualifikasi Pembayaran:</label><br></th>
    <th>
<select id="kualifikasi_pembayaran" name="kualifikasi_pembayaran" required>
    <option value="">-- Pilih Kualifikasi --</option>
    <option value="Belanja Pegawai" {{ old('kualifikasi_pembayaran') == 'Belanja Pegawai' ? 'selected' : '' }}>Belanja Pegawai</option>
    <option value="Belanja Barang" {{ old('kualifikasi_pembayaran') == 'Belanja Barang' ? 'selected' : '' }}>Belanja Barang</option>
    <option value="Belanja Modal" {{ old('kualifikasi_pembayaran') == 'Belanja Modal' ? 'selected' : '' }}>Belanja Modal</option>
</select><br><br>
    </th>
    </tr>
 
                    <!-- Adding Unit Selection -->
                    <tr>
                        <!-- Unit Selection (Menggunakan idunit sebagai value) -->
    <tr>
        <th> <label for="id_unit">Unit:</label>
      <th>  <select id="id_unit" name="id_unit" required>
                <option value="">-- Pilih Unit --</option>
                @foreach($unit as $unit)  <!-- Loop untuk menampilkan semua unit -->
                    <option value="{{ $unit->id_unit }}" {{ old('unit') == $unit->id_unit ? 'selected' : '' }}>
                        {{ $unit->nama_unit }}
                    </option>
                @endforeach
            </select><br><br>
        </th>
    </tr>
    <tr>
    <th>
        <label for="dokumen"Upload Dokumen (PDF):</label>Dokumen</th>
   <th>     <input type="file" id="dokumen" name="dokumen" accept="application/pdf"></th>
    </tr>
    </div>
                    </tr>
   
 
    </tbody>
    
    

        </table>
        <button type="submit">Simpan</button>
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
        document.getElementById('kelola-spm').style.display = 'block';
    </script>
</body>
</html>