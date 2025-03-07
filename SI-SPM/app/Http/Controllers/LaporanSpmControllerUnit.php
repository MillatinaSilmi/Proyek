<?php
// app/Http/Controllers/LaporanUnitController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\unit;
use App\Models\DataSpm;
use PDF;
use Illuminate\Support\Str;

class LaporanSPMControllerUnit extends Controller
{

 
    public function index()
{
    // Fetch the unit data to pass to the view
    $unit = Unit::all();  // Or adjust this based on your needs

    // Return the view for laporanunit.index with the unit data
    return view('laporanunit.index', compact('unit'));
}

public function search(Request $request)
{
    // Get the selected unit from the request
    $unitId = $request->input('id_unit');
    
    // Validate if no unit is selected
    if (!$unitId) {
        return redirect()->route('laporanunit.index')->with('error', 'Pilih unit terlebih dahulu.');
    }
    
    // Fetch SPM report based on the selected unit
    $laporanSpm = Dataspm::where('id_unit', $unitId)
                         ->with('unit')
                         ->get();
    
    // Fetch all units for the dropdown
    $unit = Unit::all();
    
    // Pass $laporanSpm, $unit, and selected $unitId to the view
    return view('laporanunit.index', compact('laporanSpm', 'unit', 'unitId'));
}

public function convertToPdf(Request $request)
{
    // Get the selected unit ID from the request
    $unitId = $request->input('id_unit');
    
    // Fetch the SPM report based on the selected unit ID
    $laporanSpm = Dataspm::where('id_unit', $unitId)
                         ->with('unit')
                         ->select('nospm', 'uraian', 'nominal_spm', 'tanggal_spm', 'kualifikasi_pembayaran', 'id_unit', 'id_rak')
                         ->get();
    
    // Fetch all units for the dropdown
    $unit = Unit::all();
    
    // Data to pass to the PDF view
    $data = [
        'laporanSpm' => $laporanSpm,
        'unitId' => $unitId,
        'unit' => $unit,  // Make sure unit is passed
    ];
    
    // Generate the PDF
    $pdf = PDF::loadView('laporan_spm_pdf_unit', $data)
              ->setPaper('a4', 'landscape');
    
    // Create a unique file name for the PDF
    $fileName = 'laporan_spm_' . $unitId . '_' . Str::uuid() . '.pdf';
    
    // Define the PDF save path
    $pdfPath = storage_path('app/public/' . $fileName);
    
    // Save the PDF file
    $pdf->save($pdfPath);
    
    // Display the PDF file in the browser
    return response()->file($pdfPath);
}


         // Menampilkan form dengan daftar unit
     public function showLaporanUnitPegawai()
     {
         // Fetch the unit data from the database (adjust according to your database structure)
        $unit = Unit::all(); // You can modify this to fit your needs (e.g., a specific query)

        // Pass the $unit variable to the view
        return view('laporanunitpegawai.index', compact('unit'));
     }
     
         // Menangani pencarian SPM berdasarkan unit yang dipilih
         public function searchUnitPegawai(Request $request)
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
         public function convertToPdfUnitPegawai(Request $request)
         {
             $unitId = $request->input('id_unit');  // Ambil ID unit
     
             // Ambil data SPM berdasarkan unit_id yang dipilih
             $laporanSpm = Dataspm::where('id_unit', $unitId)
                                 ->with('unit')  // Mengambil relasi unit
                                 ->select('nospm', 'uraian', 'nominal_spm','tanggal_spm', 'kualifikasi_pembayaran', 'id_unit', 'id_rak')
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
