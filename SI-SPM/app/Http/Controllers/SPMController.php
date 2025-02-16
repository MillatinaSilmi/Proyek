<?php
namespace App\Http\Controllers;
use App\Models\Spm; 
use App\Models\unit;
use App\Models\rak;  // Pastikan 'Rak' diawali dengan huruf besar
use PDF;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DataSPM; // Model untuk tabel data SPM
use Carbon\Carbon;
class SPMController extends Controller
{
    // Show the form for editing the specified SPM
    // Show the form for editing the specified SPM
public function edit($nospm)
{
    $unit = unit::all(); // Ambil semua data unit dari database
    $rak = rak::all(); // Ambil semua data rak dari database
    $kualifikasiPembayaranOptions = [
        'Belanja Pegawai',
        'Belanja Modal',
        'Belanja Barang',
    ];

    // Retrieve the SPM record based on the provided No SPM
    $spm = Spm::where('nospm', $nospm)->first();

    // If no record found, redirect or return an error
    if (!$spm) {
        return redirect()->route('edit')->with('error', 'Data SPM tidak ditemukan.');
    }

    // Return the view with the SPM data
    return view('edit', compact('spm', 'kualifikasiPembayaranOptions', 'unit', 'rak'));
}


    // Update the specified SPM in storage
    // Update the specified SPM in storage
public function update(Request $request, $nospm)
{
    $kualifikasiPembayaranOptions = [
        'Belanja Pegawai',
        'Belanja Modal',
        'Belanja Barang',
    ];

    // Validate incoming data
    $validated = $request->validate([
        'tanggal_spm' => 'required|date',
        'uraian' => 'required|string|max:255',
        'nominal_spm' => 'required|numeric|min:0',
        'kualifikasi_pembayaran' => ['required', 'in:' . implode(',', $kualifikasiPembayaranOptions)], // Validate against predefined options
        'id_unit' => 'required|exists:unit,id_unit', // Validation for unit ID (it should exist in the units table)
        'id_rak' => 'required|exists:rak,id_rak', // Validation for rak ID (it should exist in the rak table)
        'dokumen' => 'nullable|file|mimes:pdf,docx,doc,png,jpeg,jpg|max:10240', // Validate the document (optional)
     
    ]);

    // Retrieve the SPM record based on No SPM
    $spm = Spm::where('nospm', $nospm)->first();

    // If no record found, redirect or return an error
    if (!$spm) {
        return redirect()->route('dataspm.index')->with('error', 'Data SPM tidak ditemukan.');
    }

    // Update the SPM record
    $spm->tanggal_spm = $validated['tanggal_spm'];
    $spm->uraian = $validated['uraian'];
    $spm->nominal_spm = $validated['nominal_spm'];
    $spm->kualifikasi_pembayaran = $validated['kualifikasi_pembayaran']; // Update the Kualifikasi Pembayaran
    $spm->id_unit = $validated['id_unit'];
    $spm->id_rak = $validated['id_rak']; // Update the id_rak (rak name)
    $spm->update_at = now(); // Sets the updated_at field to the current timestamp
    // Handle file upload for document
    if ($request->hasFile('dokumen')) {
        $dokumenPath = $request->file('dokumen')->store('dokumen_spm', 'public');
        $spm->dokumen = $dokumenPath; // Save the document path in the SPM record
    }

    $spm->save();

    // Redirect back with success message
    return redirect()->route('dataspm.index')->with('success', 'Data SPM berhasil diperbarui.');
}


    public function create(Request $unit)
    {
        $unit = unit::all(); // Ambil data dari model Unit
        $rak = rak::all(); // Ambil semua rak dari tabel rak
         // Kembalikan ke view dan kirimkan data unit dan rak
    return view('input-spm', compact('unit', 'rak'));
      
    }
    public function index()
    {
        
        $unit = unit::all(); // Ambil data dari model Unit
        $rak = rak::all(); // Ambil semua rak dari tabel rak
         // Kembalikan ke view dan kirimkan data unit dan rak
    return view('input-spm', compact('unit', 'rak'));
    }
    
    // Menyimpan data ke database
    public function store(Request $request)
{
    
    // Validasi input
    $validated = $request->validate([
        'nospm' => 'required|unique:dataspm,nospm|string|max:50',
        'uraian' => 'required|string|max:255',
        'nominal_spm' => 'required|numeric|min:0',
        'tanggal_spm' => 'required|date',
        'kualifikasi_pembayaran' => 'required|in:Belanja Pegawai,Belanja Barang,Belanja Modal',
        'id_unit' => 'required|exists:unit,id_unit', // Validasi untuk unit
        'id_rak' => 'required|exists:rak,id_rak', // Validasi untuk rak
        'dokumen' => 'nullable|file|mimes:pdf', // Validasi dokumen (PDF)
    ]);

    // Menangani upload file jika ada
    $filePath = null; // Default jika tidak ada file yang di-upload
    if ($request->hasFile('dokumen')) {
        $file = $request->file('dokumen');
        $filePath = $file->storeAs('dokumen', $file->getClientOriginalName(), 'public');
    }

    // Simpan data ke database
    DataSPM::create([
        'nospm' => $validated['nospm'],
        'uraian' => $validated['uraian'],
        'nominal_spm' => $validated['nominal_spm'],
        'tanggal_spm' => $validated['tanggal_spm'],
        'create_at' => Carbon::now()->toDateString(), // Tanggal input otomatis
        'update_at' => Carbon::now()->toDateString(),
        'kualifikasi_pembayaran' => $validated['kualifikasi_pembayaran'],
       'id_unit' => $validated['id_unit'], // Menyimpan ID unit yang dipilih
       'id_rak' => $validated['id_rak'], // Menyimpan ID rak yang dipilih
        'dokumen' => $filePath, // Menyimpan path file yang di-upload
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('dataspm.index')->with('success', 'Data SPM berhasil disimpan.');
}
public function destroy($nospm)
    {
        $dataspm = SPM::findOrFail($nospm);
        $dataspm->delete();

        return redirect()->route('dataspm.index')->with('success', 'Data SPM berhasil dihapus');
    }

   
    public function search(Request $request)
    {
        // Validasi input nomor SPM
        $request->validate([
            'nospm' => 'required|string|max:255',
        ]);
    
        // Ambil nomor SPM dari input
        $no_spm = $request->input('nospm');
    
        // Cek jika nospm tidak ada atau kosong
        if(empty($no_spm)){
            return back()->with('error', 'Nomor SPM tidak boleh kosong!');
        }
    
        // Cari data berdasarkan nomor SPM
        $no_spm = trim($no_spm); // Menghapus spasi sebelum dan sesudah
           // Pencarian persis berdasarkan nomor SPM
    $data = SPM::where('nospm', '=', $no_spm)->paginate(10);
    
        // Debug untuk memeriksa data yang diambil
        //dd($data); // Cek apakah data ditemukan atau kosong
    
        // Jika tidak ada data yang ditemukan
        if ($data->isEmpty()) {
            return redirect()->route('indexfilteradmin.search')->with('error', 'No SPM tidak ditemukan!');
        }
    
        // Kirimkan data ke view
        return view('indexfilteradmin', compact('data'));
    }


    public function convertToPdf(Request $request, $nospm)
    {
        // Ambil data SPM berdasarkan nospm yang diberikan
        $laporanSpm = Dataspm::where('nospm', $nospm)
                             ->with('unit', 'rak')  // Mengambil relasi unit dan rak
                             ->select('nospm', 'uraian', 'nominal_spm', 'kualifikasi_pembayaran', 'id_unit', 'id_rak')
                             ->first();  // Mengambil satu data berdasarkan nospm
    
        // Jika data tidak ditemukan
        if (!$laporanSpm) {
            return redirect()->back()->with('error', 'Data SPM tidak ditemukan.');
        }
    
        // Data untuk view PDF
        $data = [
            'laporanSpm' => $laporanSpm,
        ];
    
        // Load view dan generate PDF
        $pdf = PDF::loadView('laporan_spm_pdf_no', $data)
                  ->setPaper('a4', 'landscape'); // Mengatur orientasi landscape
    
        // Buat nama file PDF yang unik
        $fileName = 'laporan_spm_' . $nospm . '_' . Str::uuid() . '.pdf';
    
        // Tentukan path penyimpanan file PDF
        $pdfPath = storage_path('app/public/' . $fileName);
    
        // Simpan file PDF
        $pdf->save($pdfPath);
    
        // Menampilkan file PDF di browser
        return response()->file($pdfPath);
    }
    

public function searchNoPegawai(Request $request)
    {
        // Validasi input nomor SPM
        $request->validate([
            'nospm' => 'required|string|max:255',
        ]);
    
        // Ambil nomor SPM dari input
        $no_spm = $request->input('nospm');
    
        // Cek jika nospm tidak ada atau kosong
        if(empty($no_spm)){
            return back()->with('error', 'Nomor SPM tidak boleh kosong!');
        }
    
        // Cari data berdasarkan nomor SPM
        $no_spm = trim($no_spm); // Menghapus spasi sebelum dan sesudah
           // Pencarian persis berdasarkan nomor SPM
    $data = SPM::where('nospm', '=', $no_spm)->paginate(10);
    
        // Debug untuk memeriksa data yang diambil
        //dd($data); // Cek apakah data ditemukan atau kosong
    
        // Jika tidak ada data yang ditemukan
        if ($data->isEmpty()) {
            return redirect()->route('indexfilter.searchNoPegawai')->with('error', 'No SPM tidak ditemukan!');
        }
    
        // Kirimkan data ke view
        return view('indexfilter', compact('data'));
    }


public function convertToPdfPegawai(Request $request, $nospm) 
{
    // Ambil data SPM berdasarkan nospm yang diberikan
    $laporanSpm = Dataspm::where('nospm', $nospm)
                         ->with('unit', 'rak')  // Mengambil relasi unit dan rak
                         ->select('nospm', 'uraian', 'nominal_spm', 'kualifikasi_pembayaran', 'id_unit', 'id_rak')
                         ->first();  // Mengambil satu data berdasarkan nospm

    // Jika data tidak ditemukan
    if (!$laporanSpm) {
        return redirect()->back()->with('error', 'Data SPM tidak ditemukan.');
    }

    // Data untuk view PDF
    $data = [
        'laporanSpm' => $laporanSpm,
    ];

    // Load view dan generate PDF
    $pdf = PDF::loadView('laporan_spm_pdf_no', $data)
              ->setPaper('a4', 'landscape'); // Mengatur orientasi landscape

    // Buat nama file PDF yang unik
    $fileName = 'laporan_spm_' . $nospm . '_' . Str::uuid() . '.pdf';

    // Tentukan path penyimpanan file PDF
    $pdfPath = storage_path('app/public/' . $fileName);

    // Simpan file PDF
    $pdf->save($pdfPath);

    // Menampilkan file PDF di browser
    return response()->file($pdfPath);
}


}