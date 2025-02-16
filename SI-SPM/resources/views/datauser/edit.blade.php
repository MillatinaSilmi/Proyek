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
           
            font-size: 16px;
            cursor: pointer;
        }


        /* Main Content */
        .content {
            margin-left: 250px;
            padding: 40px;
            flex-grow: 1;
        }

        /* Form Styling */
        form {
        
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
        }

        form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        form div {
            margin-bottom: 20px;
        }

        form label {
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        form input[type="text"],
        form input[type="password"],
        form select {
            width: 100%;
            padding: 12px 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        form input[type="text"]:focus,
        form input[type="password"]:focus,
        form select:focus {
            border-color: #8aae92;
            outline: none;
        }

        form button {
            padding: 12px 20px;
            font-size: 16px;
            background-color: #8aae92;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        form button:hover {
            background-color: #7a9f82;
        }

        /* Error Handling */
        .alert {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            padding: 10px;
            background-color: #fdd;
            border: 1px solid red;
            border-radius: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                padding: 20px;
            }
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
        <li><button onclick="redirectToPage()">Data Unit</button></li>
    </ul>
</li>

<script>
    function redirectToPage() {
        // Pastikan kita menggunakan URL yang benar
        var url = "{{ route('unit.create') }}";
        window.location.href = url;
    }

    function toggleMenu(menuId) {
        const menu = document.getElementById(menuId);
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    }
</script>

                <li>
                    <button onclick="toggleMenu('kelola-user')">Kelola User</button>
                    <ul id="kelola-user">
                    <li><button onclick="redirectToPage('datauser')"> Data User</button></li>
                    </ul>
                </li>
                <li>
                    <button onclick="toggleMenu('laporan-spm')">Laporan SPM</button>
                    <ul id="laporan-spm">
                    <li><button onclick="redirectToPage('indexfilter')"> Laporan By No SPM </button></li>    
                    <li><button onclick="redirectToPage('laporanunitadmin')"> Laporan By Unit </button></li>
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
        <form action="{{ route('datauser.update', $user->NIP) }}" method="POST">
            @csrf
            @method('PUT')
            
            <h2>Update Data User</h2>

            <div>
                <label for="NIP">NIP</label>
                <input type="text" name="NIP" value="{{ $user->NIP }}" readonly>
            </div>

            <div>
                <label for="nama">Nama</label>
                <input type="text" name="nama" value="{{ $user->nama }}" required>
            </div>

            <div>
                <label for="role">Role</label>
                <select name="id_role" required>
                    @foreach($role as $role)
                        <option value="{{ $role->id_role }}" {{ $user->id_role == $role->id_role ? 'selected' : '' }}>
                            @if($role->id_role == 1)
                                Admin
                            @elseif($role->id_role == 2)
                                Pegawai
                            @else
                                {{ $role->name }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>

          <!-- Submit Button -->
<div class="form-group">
    <button type="submit" onclick="return confirmUpdate();">Update User</button>
</div>

<script>
    // Function to show confirmation dialog
    function confirmUpdate() {
        return confirm("Are you sure you want to update this user?");
    }
</script>


            @if($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

    <script>
        // Toggle submenus visibility
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
        }

        // Redirect to another page
        function redirectToPage(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
