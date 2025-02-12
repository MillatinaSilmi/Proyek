<?php
namespace App\Http\Controllers;

use App\Models\Dataspm; // Model Dataspm untuk query database
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\unit;  // Ensure this line is present at the top of your controller


class LaporanByNoSpmController extends Controller
{
     // Menampilkan form dengan daftar unit
     public function showLaporan()
     {
         $Unit = unit::all();  // Ambil semua unit dari database
         return view('laporanbyno.index', compact('Unit'));  // Kirimkan data unit ke view
     }
    public function search(Request $request)
    {
        // Ambil nilai dari request
        $nomorspm = $request->input('nospm');

        // Validasi jika kualifikasi_pembayaran tidak dipilih
        if (!$nomorspm) {
            return redirect()->route('laporanbyno.index')->with('error', 'Pilih kualifikasi pembayaran terlebih dahulu.');
        }

        // Cari data SPM berdasarkan kualifikasi pembayaran menggunakan model Dataspm
        $laporanSpm = Dataspm::where('nospm', $nomorspm)->get();

        // Mengirimkan data ke view
        return view('laporanbyno.index', compact('laporanSpm', 'nospm'));
    }



    
    public function convertToPdf(Request $request)
{
    // Ambil kualifikasi pembayaran dari input
    $nomorspm = $request->input('nospm');
    
    // Ambil data dari database berdasarkan kualifikasi pembayaran
    $laporanSpm = Dataspm::where('nospm', $nomorspm)
        ->with('unit') // Mengambil relasi unit
        ->select('nospm', 'uraian', 'nominal_spm', 'kualifikasi_pembayaran', 'id_unit','id_rak') // Menambahkan id_unit di select
        ->get();

    // Persiapkan data untuk view
    $data = [
        'laporanSpm' => $laporanSpm,
        'nospm' => $nomorspm,
    ];

    // Load view dan generate PDF
    $pdf = PDF::loadView('laporan_spm_nopdf', $data)
    ->setPaper('a4', 'landscape'); // Mengatur orientasi landscape
    // Buat nama file PDF yang unik

    // Buat nama file PDF yang unik dengan menambahkan UUID
    $fileName = 'laporan_spm_no' . $nomorspm . '_' . Str::uuid() . '.pdf';

    // Tentukan path penyimpanan file PDF
    $pdfPath = storage_path('app/public/' . $fileName);

    // Simpan file PDF
    $pdf->save($pdfPath);

    // Menyajikan file PDF dari server
    return response()->file($pdfPath); // Menampilkan file PDF dari server di browser
}
}