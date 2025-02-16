<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        // Logika untuk halaman pegawai
        return view('homepegawai'); // Pastikan Anda memiliki file view 'homepegawai.blade.php'
    }
}
