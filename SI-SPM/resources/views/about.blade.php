<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Arsip SPM</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script defer src="{{ asset('js/menu.js') }}"></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <h2>SIA-SPM</h2>
                <button id="toggle-btn" class="toggle-btn">&times;</button>
            </div>
            <ul class="menu">
                <!-- Kelola Data SPM -->
                <li class="has-submenu">
                    <b>
                    <a href="#" class="menu-link">Kelola Data SPM</a></b>
                    <ul class="submenu">
                        <b><li><a href="#">Input Data SPM</a></li></b>
                        <li><a href="#">Edit Data SPM</a></li>
                        <li><a href="#">Hapus Data SPM</a></li>
                    </ul>
                </li>
                <!-- Kelola Rak -->
                <li class="has-submenu">
                    <a href="#" class="menu-link">Kelola Rak</a>
                    <ul class="submenu">
                        <li><a href="#">Input Data Rak</a></li>
                        <li><a href="#">Edit Data Rak</a></li>
                        <li><a href="#">Hapus Data Rak</a></li>
                    </ul>
                </li>
                <!-- Kelola Unit -->
                <li class="has-submenu">
                    <a href="#" class="menu-link">Kelola Unit</a>
                    <ul class="submenu">
                        <li><a href="#">Input Data Unit</a></li>
                        <li><a href="#">Edit Data Unit</a></li>
                        <li><a href="#">Hapus Data Unit</a></li>
                    </ul>
                </li>
                <!-- Kelola User -->
                <li class="has-submenu">
                    <a href="#" class="menu-link">Kelola User</a>
                    <ul class="submenu">
                        <li><a href="#">Input Data User</a></li>
                        <li><a href="#">Edit Data User</a></li>
                        <li><a href="#">Hapus Data User</a></li>
                    </ul>
                </li>
                <!-- Laporan SPM -->
                <li class="has-submenu">
                    <a href="#" class="menu-link">Laporan SPM</a>
                    <ul class="submenu">
                        <li><a href="#">Laporan SPM By Nomor SPM</a></li>
                        <li><a href="#">Laporan By Unit</a></li>
                        <li><a href="#">Laporan By Klasifikasi SPM</a></li>
                    </ul>
                </li>
            </ul>
            <div class="logout">
                <a href="#">Log Out</a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <button id="menu-btn" class="menu-btn">&#9776;</button>
            <style>
        /* Tambahkan styling khusus */
        
    </style>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data SMP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
   
    
    <h2> Data SPM</h2>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .form-container {
            display: flex;
            justify-content: justify;
            align-items: center;
            height: 100vh;
            padding-top: 2cm;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border: 2px solid #4CAF50;  /* Bingkai pada form */
            border-radius: 4px;
            width: 600px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="number"], input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;  /* Bingkai pada input */
            border-radius: 15px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        /* Button khusus untuk Browse */
        #fileInput {
            display: none;
        }

        #fileLabel {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 4px;
            text-align: justify;
            cursor: pointer;
            width: 100%;
        }

        #fileLabel:hover {
            background-color: #45a049;
        }
    </style>
    <form action="submit_form.php" method="post" enctype="multipart/form-data">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data SPM</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1></h1>
    <table>
        <thead>
            <tr>
              
                <th>No SPM</th>
                <th>Uraian SPM</th>
                <th>Nominal SPM</th>
                <th>Detail</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($dataspm as $data)
                <tr>
                    <td>{{ $data->nospm }}</td>
                    <td>{{ $data->uraian}}</td>
                    <td>{{ $data->nominal_spm}}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

    </form>
</body>
</html>

        
</head>

    </div>
</body>
</html>
