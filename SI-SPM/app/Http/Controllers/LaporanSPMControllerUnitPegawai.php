<?php
// app/Http/Controllers/LaporanUnitController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\unit;
use App\Models\DataSpm;
use PDF;
use Illuminate\Support\Str;


class LaporanSPMControllerUnitPegawai extends Controller
{

 
    // Add the index method here
    public function index()
    {
        // Return the view for laporanunitpegawai
        return view('laporanunitpegawai');
    }


     // Menampilkan form dengan daftar unit
     public function showLaporanUnit()
     {
         // Fetch the unit data from the database (adjust according to your database structure)
        $unit = Unit::all(); // You can modify this to fit your needs (e.g., a specific query)

        // Pass the $unit variable to the view
        return view('laporanunitpegawai.index', compact('unit'));
     }
     
         // Menangani pencarian SPM berdasarkan unit yang dipilih
         public function search(Request $request)
         {
             // Ambil nilai id_unit dari request
         $unitId = $request->input('id_unit');
     
         // Validasi jika tidak ada unit yang dipilih
         if (!$unitId) {
             return redirect()->route('laporanunitpegawai.index')->with('error', 'Pilih unit terlebih dahulu.');
         }
     
         // Ambil data laporan SPM berdasarkan unit yang dipilih
         $laporanSpm = Dataspm::where('id_unit', $unitId)
                             ->with('unit')  // Ambil relasi unit
                             ->get();
     
         // Ambil data unit untuk dropdown
         $unit = unit::all();
     
         // Kirim data ke view, termasuk laporanSpm dan unitId yang dipilih
         return view('laporanunitpegawai.index', compact('laporanSpm', 'unit', 'unitId'));
     }
     
         // Mengonversi hasil pencarian ke PDF
         public function convertToPdf(Request $request)
         {
             $unitId = $request->input('id_unit');  // Ambil ID unit
     
             // Ambil data SPM berdasarkan unit_id yang dipilih
             $laporanSpm = Dataspm::where('id_unit', $unitId)
                                 ->with('unit')  // Mengambil relasi unit
                                 ->select('nospm', 'uraian', 'nominal_spm', 'kualifikasi_pembayaran', 'id_unit', 'id_rak')
                                 ->get();
     
             // Data untuk view PDF
             $data = [
                 'laporanSpm' => $laporanSpm,
                 'unitId' => $unitId,
             ];
     
             // Load view dan generate PDF
             $pdf = PDF::loadView('laporan_spm_pdf_unit', $data)
             ->setPaper('a4', 'landscape'); // Mengatur orientasi landscape
             // Buat nama file PDF yang unik
             $fileName = 'laporan_spm_' . $unitId . '_' . Str::uuid() . '.pdf';
     
             // Tentukan path penyimpanan file PDF
             $pdfPath = storage_path('app/public/' . $fileName);
     
             // Simpan file PDF
             $pdf->save($pdfPath);
     
             // Menampilkan file PDF di browser
             return response()->file($pdfPath);
             
         }
}
