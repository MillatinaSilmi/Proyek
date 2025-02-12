<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Constructor untuk memastikan hanya pengguna yang sudah login yang bisa mengakses
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan pengguna yang belum login akan diarahkan ke halaman login
    }

    // Method untuk menampilkan halaman home
    public function index()
    {
        // Mengambil nama pengguna yang login
        $username = Auth::user()->nama; // Nama pengguna yang login
        return view('home', compact('username'));
    }
    
}
