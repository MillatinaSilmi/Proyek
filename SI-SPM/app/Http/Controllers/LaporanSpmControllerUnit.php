<?php
namespace App\Http\Controllers;

use App\Models\Dataspm;
use App\Models\unit;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanSpmControllerUnit extends Controller
{
    // Menampilkan form dengan daftar unit
    public function showLaporanUnit()
{
    $unit = unit::all();  // Ambil semua unit dari database
    return view('laporanunit.index', compact('unit'));  // Kirimkan data unit ke view
}

    // Menangani pencarian SPM berdasarkan unit yang dipilih
    public function search(Request $request)
    {
        // Ambil nilai id_unit dari request
    $unitId = $request->input('id_unit');

    // Validasi jika tidak ada unit yang dipilih
    if (!$unitId) {
        return redirect()->route('laporanunit.index')->with('error', 'Pilih unit terlebih dahulu.');
    }

    // Ambil data laporan SPM berdasarkan unit yang dipilih
    $laporanSpm = Dataspm::where('id_unit', $unitId)
                        ->with('unit')  // Ambil relasi unit
                        ->get();

    // Ambil data unit untuk dropdown
    $unit = unit::all();

    // Kirim data ke view, termasuk laporanSpm dan unitId yang dipilih
    return view('laporanunit.index', compact('laporanSpm', 'unit', 'unitId'));
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
