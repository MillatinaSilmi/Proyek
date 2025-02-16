<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



use App\Models\user;
use App\Models\role;

class AuthController extends Controller
{
        public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'NIP' => 'required',
        'password' => 'required',
    ]);

    // Memeriksa apakah NIP dan password sesuai dengan data yang ada di database
    $user = User::where('NIP', $request->NIP)->first();

    if ($user && Auth::attempt(['NIP' => $request->NIP, 'password' => $request->password])) {
        // Setelah login berhasil, periksa role berdasarkan idrole
        if ($user->id_role == 1) {
            // Jika role adalah admin (misalnya idrole 1)
            return redirect()->route('home'); // Arahkan ke halaman admin
        } elseif ($user->id_role == 2) {
            // Jika role adalah pegawai (misalnya idrole 2)
            return redirect()->route('homepegawai'); // Arahkan ke halaman pegawai
        }

        // Jika idrole tidak dikenali (bukan 1 atau 2), tampilkan pesan error
        return redirect()->route('login')->withErrors(['NIP' => 'Role tidak dikenali.']);
    }

    // Jika login gagal, kembali ke halaman login dengan pesan error
    return back()->withErrors(['NIP' => 'NIP atau password salah']);
}

    
    public function someProtectedPage()
    {
        if (!Auth::check()) {
            return redirect()->route('login');  // Pastikan yang sudah logout akan diarahkan ke halaman login
        }
    
        return view('protected-page');
    }
    


public function logout(Request $request)
{
    Auth::logout(); // Logout user

    // Clear session
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); // Redirect to login page after logout
}

}



