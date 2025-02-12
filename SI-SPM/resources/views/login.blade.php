<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Arsip SPM</title>
    <style>
        /* Menetapkan gaya dasar untuk body dan html */
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center; /* Menyusun konten secara horizontal di tengah */
            align-items: center; /* Menyusun konten secara vertikal di tengah */
            background-color: #F4F4F9; /* Warna latar belakang terang */
        }

        /* Container utama untuk form login */
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
            position: relative;
            box-sizing: border-box;
        }

        /* Logo */
        .logo img {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 22px;
        }

        /* Styling untuk input yang berbentuk bulat */
        .input-field {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Styling untuk button login */
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50; /* Warna Hijau SPM */
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #45a049;
        }

        .note {
            margin-top: 10px;
            font-size: 12px;
            color: #888;
        }

        .note span {
            color: red;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Logo KLHK -->
    <div class="login-container">
        <div class="logo">
            <img src="" alt="">
        </div>
        <h3>Login Sistem Informasi Arsip SPM</h3>

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="NIP">NIP:</label>
                <input type="text" id="NIP" name="NIP" class="input-field" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="input-field" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="note">
            <span>*</span> Pastikan Anda memasukkan NIP dan Password yang benar.
        </div>
    </div>
</body>

</html>
