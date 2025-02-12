<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Unit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f1f8f4;
            display: flex;
        }

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
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

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

        .content .form-group {
            margin-bottom: 15px;
        }

        .content .form-group label {
            font-size: 16px;
            font-weight: bold;
        }

        .content .form-group input {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .content .form-group select {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .content .form-group button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #8aae92;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .content .form-group button:hover {
            background-color: #7a9f84;
        }

        .content .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <!-- Logo Section -->
        </div>
        <div class="menu">
            <ul>
                <!-- Menu Items Here -->
            </ul>
        </div>
        <div class="logout">
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

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

            <div class="form-group">
                <label for="nama_unit">Unit Name</label>
                <input type="text" class="form-control" id="nama_unit" name="nama_unit" value="{{ old('nama_unit', $unit->nama_unit) }}" required>
                @error('nama_unit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit">Update</button>
            </div>
        </form>
        
        <script>
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
