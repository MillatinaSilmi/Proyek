<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
        $request->validate([
            'NIP' => 'required',
            'password' => 'required',
        ]);
    
        // Memeriksa apakah NIP dan password sesuai dengan data yang ada di database
        $user = User::where('NIP', $request->NIP)->first();
    
        if ($user && Auth::attempt(['NIP' => $request->NIP, 'password' => $request->password])) {
            // Jika login berhasil, arahkan ke halaman home
            return redirect()->route('home');
        }
    
        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors(['NIP' => 'NIP atau password salah']);
    }
    





    public function logout(Request $request)
{
    // Logout pengguna
    Auth::logout();

    // Menghapus sesi dan token CSRF
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect ke halaman login
    return redirect()->route('login');
}

}

