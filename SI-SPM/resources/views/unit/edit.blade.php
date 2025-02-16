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
                    <button onclick="toggleMenu('kelola-spm')" >Kelola Data SPM</button>
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
                    <button onclick="toggleMenu('kelola-unit')"class="active">Kelola Unit</button>
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
                        <li><button onclick="window.location.href='/indexfilteradmin'"> Laporan By No SPM </button></li>
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

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><h3>Edit Unit</h3></title>
    <style>
        /* Main Content */
        .content {
            margin-left: 250px; /* Sidebar width */
            padding: 20px;
            width: 400px; /* Limit the form width */
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd; /* Border around the form */
        }

        .content .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 40%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }

        /* Read-only input field styling */
        input[readonly] {
            background-color: #e0e0e0;
            cursor: not-allowed;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }

        button[type="submit"] {
            background-color: #8aae92;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 40%;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #7c9e7b;
        }
    </style>
</head>

<body>
    <!-- Sidebar remains unchanged -->



    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h1>Edit Unit</h1>
        </div>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <!-- Update Form -->
        <form action="{{ route('unit.update', $unit->id_unit) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- ID Unit (Read-only) -->
            <div class="form-group">
                <label for="id_unit">ID Unit</label>
                <input type="text" class="form-control" id="id_unit" name="id_unit" value="{{ old('id_unit', $unit->id_unit) }}" readonly>
                @error('id_unit')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="nama_unit">Unit Name</label>
                <input type="text" class="form-control" id="nama_unit" name="nama_unit" value="{{ old('nama_unit', $unit->nama_unit) }}" required>
                @error('nama_unit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
<div class="form-group">
    <button type="submit" onclick="return confirmUpdate();">Update</button>
</div>

<script>
    // Function to show confirmation dialog
    function confirmUpdate() {
        return confirm("Are you sure you want to update this unit?");
    }
</script>

        </form>

        <script>
            // Validate the form before submission
            document.querySelector('form').addEventListener('submit', function(e) {
                var unitName = document.querySelector('#nama_unit').value.trim();
                if (unitName === "") {
                    alert("Unit name cannot be empty.");
                    e.preventDefault();
                }
            });
        </script>
    </div>

</body>

</html>
