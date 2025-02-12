<?php
namespace App\Http\Controllers;
use PDF;
use Illuminate\Http\Request;
use App\Models\SPM; // Pastikan Model SPM sesuai dengan tabel Anda
use App\Models\Dataspm; // Menambahkan import model Dataspm

class DetailController extends Controller
{
    public function show(Request $request, $nospm)
{
   /// Ambil data berdasarkan nospm dan relasi dengan rak
   $item = Dataspm::with('rak')->where('nospm', $nospm)->first();

   // Jika data tidak ditemukan, redirect atau tampilkan pesan error
   if (!$item) {
       return redirect()->route('data.index')->with('error', 'Data tidak ditemukan');
   }

   // Kirimkan data ke view detail
   return view('detail', compact('item'));

    // Menentukan nama unit berdasarkan ID unit
    if ($data->id_unit == '1') {
        $nama_unit = 'Sub Bagian Tata Usaha';
    } elseif ($data->id_unit == '2') {
        $nama_unit = 'Perencanaan dan Evaluasi DAS';
    } elseif ($data->id_unit == '3') {
        $nama_unit = 'RHL';
    } elseif ($data->id_unit == '4') {
        $nama_unit = 'Penguatan Kelembagaan DAS';
    } else {
        $nama_unit = 'Unit Tidak Diketahui';
    }

    // Mengecek apakah ada input pencarian untuk 'no_spm'
    $search = $request->input('no_spm');
    
    // Jika pencarian ada, filter data berdasarkan pencarian
    if ($search) {
        // Mengambil data berdasarkan pencarian 'nospm'
        $data = SPM::where('nospm', 'like', '%' . $search . '%')->first();
        
        // Jika data tidak ditemukan
        if (!$data) {
            abort(404, 'Data SPM tidak ditemukan berdasarkan pencarian');
        }
    }

    // Mengirim data ke view
    return view('detail', compact('data', 'nama_unit'));
}

        public function index()
    {
        $unit = unit::all(); // Ambil data dari model Unit
        return view('input-spm', compact('unit'));

        $dataspm = dataspm::with('rak')->get();  // Mengambil relasi rak

        return view('detail', compact('dataspm', 'nama_rak'));
        $rak = rak::find($id_rak);
        
            // Ambil data berdasarkan nospm
            $dataspm = dataSpm::with('rak')->get();

            // Menampilkan data ke view
            return view('detail', compact('dataspm'));
    }

  
    public function generatePdf($nospm)
{
    // Fetch the data based on the provided nospm
    $data = SPM::with('rak')->where('nospm', $nospm)->firstOrFail();
    
    // Get the unit name, you may need to adjust this query based on your relationships
    $nama_unit = $data->unit->name;

    // Generate the PDF from the view
    $pdf = PDF::loadView('spm.detail', compact('data', 'nama_unit'));

    return response($pdf->output(), 200)
    ->header('Content-Type', 'application/pdf')
    ->header('Content-Disposition', 'inline; filename="SPM_' . $data->nospm . '.pdf"');
    
}
}