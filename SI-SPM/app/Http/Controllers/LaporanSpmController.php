<?php
namespace App\Http\Controllers;

use App\Models\Dataspm; // Model Dataspm untuk query database
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanSpmController extends Controller
{
   
        public function index()
        {
            // Your logic here (e.g., fetching data, returning a view)
            return view('laporan.index'); // or whatever view you want to return
        }
    
    
    
    public function search(Request $request)
    {
        // Ambil nilai dari request
        $kualifikasiPembayaran = $request->input('kualifikasi_pembayaran');

        // Validasi jika kualifikasi_pembayaran tidak dipilih
        if (!$kualifikasiPembayaran) {
            return redirect()->route('laporan.index')->with('error', 'Pilih kualifikasi pembayaran terlebih dahulu.');
        }

        // Cari data SPM berdasarkan kualifikasi pembayaran menggunakan model Dataspm
        $laporanSpm = Dataspm::where('kualifikasi_pembayaran', $kualifikasiPembayaran)->get();

        // Mengirimkan data ke view
        return view('laporan.index', compact('laporanSpm', 'kualifikasiPembayaran'));
    }



    
    public function convertToPdf(Request $request)
{
    // Ambil kualifikasi pembayaran dari input
    $kualifikasiPembayaran = $request->input('kualifikasi_pembayaran');
    
    // Ambil data dari database berdasarkan kualifikasi pembayaran
    $laporanSpm = Dataspm::where('kualifikasi_pembayaran', $kualifikasiPembayaran)
        ->with('unit') // Mengambil relasi unit
        ->select('nospm', 'uraian', 'nominal_spm', 'kualifikasi_pembayaran', 'id_unit','id_rak') // Menambahkan id_unit di select
        ->get();

    // Persiapkan data untuk view
    $data = [
        'laporanSpm' => $laporanSpm,
        'kualifikasiPembayaran' => $kualifikasiPembayaran,
    ];

    // Load view dan generate PDF
    $pdf = PDF::loadView('laporan_spm_pdf', $data)
    ->setPaper('a4', 'landscape'); // Mengatur orientasi landscape
    // Buat nama file PDF yang unik

    // Buat nama file PDF yang unik dengan menambahkan UUID
    $fileName = 'laporan_spm_' . $kualifikasiPembayaran . '_' . Str::uuid() . '.pdf';

    // Tentukan path penyimpanan file PDF
    $pdfPath = storage_path('app/public/' . $fileName);

    // Simpan file PDF
    $pdf->save($pdfPath);

    // Menyajikan file PDF dari server
    return response()->file($pdfPath); // Menampilkan file PDF dari server di browser
}

public function searchKualifikasi(Request $request)
    {
        // Ambil nilai dari request
        $kualifikasiPembayaran = $request->input('kualifikasi_pembayaran');

        // Validasi jika kualifikasi_pembayaran tidak dipilih
        if (!$kualifikasiPembayaran) {
            return redirect()->route('laporankualifikasipegawai')->with('error', 'Pilih kualifikasi pembayaran terlebih dahulu.');
        }

        // Cari data SPM berdasarkan kualifikasi pembayaran menggunakan model Dataspm
        $laporanSpm = Dataspm::where('kualifikasi_pembayaran', $kualifikasiPembayaran)->get();

        // Mengirimkan data ke view
        return view('laporankualifikasipegawai', compact('laporanSpm', 'kualifikasiPembayaran'));
    }



    
    public function convertToPdfKualifikasi(Request $request)
{
    // Ambil kualifikasi pembayaran dari input
    $kualifikasiPembayaran = $request->input('kualifikasi_pembayaran');
    
    // Ambil data dari database berdasarkan kualifikasi pembayaran
    $laporanSpm = Dataspm::where('kualifikasi_pembayaran', $kualifikasiPembayaran)
        ->with('unit') // Mengambil relasi unit
        ->select('nospm', 'uraian', 'nominal_spm', 'kualifikasi_pembayaran', 'id_unit','id_rak') // Menambahkan id_unit di select
        ->get();

    // Persiapkan data untuk view
    $data = [
        'laporanSpm' => $laporanSpm,
        'kualifikasiPembayaran' => $kualifikasiPembayaran,
    ];

    // Load view dan generate PDF
    $pdf = PDF::loadView('laporan_spm_pdf', $data)
    ->setPaper('a4', 'landscape'); // Mengatur orientasi landscape
    // Buat nama file PDF yang unik

    // Buat nama file PDF yang unik dengan menambahkan UUID
    $fileName = 'laporan_spm_' . $kualifikasiPembayaran . '_' . Str::uuid() . '.pdf';

    // Tentukan path penyimpanan file PDF
    $pdfPath = storage_path('app/public/' . $fileName);

    // Simpan file PDF
    $pdf->save($pdfPath);

    // Menyajikan file PDF dari server
    return response()->file($pdfPath); // Menampilkan file PDF dari server di browser
}
}
