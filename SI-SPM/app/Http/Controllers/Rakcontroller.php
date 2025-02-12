<?php
namespace App\Http\Controllers;

use App\Models\rak;
use App\Models\lokasirak;
use Illuminate\Http\Request;

class RakController extends Controller
{
   
    public function index()
    {
        
       

        $datarak = rak::paginate(10); // Menampilkan 10 data per halaman
                // Kirim data ke view
        return view('datarak.index', compact('datarak'));

                $rak = Rak::findOrFail($id_rak);

        // Periksa apakah ada rak lain dengan id_rak yang sama
        $rakCount = DB::table('rak')
            ->where('id_rak', $id_rak) // Pastikan menggunakan id_rak
            ->where('id_rak', '<>', $id_rak) // Hindari menggunakan id yang salah
            ->count();
    
        if ($rakCount > 0) {
            return redirect()->back()->with('error', 'Rak dengan id_rak ini sudah ada!');
        }
    
        return view('datarak.index', compact('datarak'));
    }
    public function show($id_rak)
    {
        
        // Mengambil data user berdasarkan ID
        $rak = rak::find($id_rak);
        
            // Ambil data berdasarkan nospm
            $rak = rak::where('nama_rak', $nama_rak)->first();
    
            // Jika data tidak ditemukan
            if (!$rak) {
                abort(404, 'Data Rak tidak ditemukan');
            }
            $rak = SPM::find($id_rak);
        // Cek apakah rak ditemukan
        if ($rak) {
            // Menambahkan kondisi berdasarkan id_rak
            if ($rak->id_lokasi == 1) {
                $lokasi_rak = 'Tata Usaha';
            } elseif ($rak->id_lokasi == 2) {
                $lokasi_rak = 'Perencanaan dan Evaluasi DAS';
            }
            elseif ($rak->id_lokasi == 3) {
                $lokasi_rak = 'RHL';
            } 
            elseif ($rak->id_lokasi == 4) {
                $lokasi_rak = 'Penguatan Kelembagaan DAS';
            }else {
                $lokasi_rak = 'Lokasi tidak ditemukan';
            }

            // Kirim data user dan role ke view
            return view('rak.show', compact('rak', 'lokasi_rak'));
        } else {
            return redirect()->back()->with('error', 'Rak tidak ditemukan');
        }
    }
    public $timestamps = false;
    public function create()
    {
        $lokasirak = lokasirak::all();
        return view('input-rak', compact('lokasirak'));
    }

    public function store(Request $request)
    {$request->validate([
       
            'id_rak' => 'required|string|max:255|unique:rak,id_rak|not_in:0',
            'nama_rak' => 'required|string|min:8',
            'id_lokasi' => 'required|exists:lokasirak,id_lokasi',
        ]);

        rak::create([
            'id_rak' => $request['id_rak'],
            'nama_rak' => ($request['nama_rak']),
            'id_lokasi' => $request['id_lokasi'],
        ]);

        return redirect()->route('datarak.index')->with('success', 'Rak berhasil ditambahkan!');
    }
    

    public function search(Request $request)
    {
        {
            // Mengambil kata kunci dari input pencarian
            $nama_rak = $request->input('nama_rak');
    
            // Pencarian user berdasarkan nama yang mengandung kata kunci
            $datarak = rak::where('nama_rak', 'like', '%' . $nama_rak . '%')->get();
    
            // Kembalikan hasil pencarian ke view
            return view('datarak.index', compact('datarak', 'nama_rak'));
           
        }
    }
    public function edit($id_rak)
{
    // Find the Rak by ID
    $rak = Rak::findOrFail($id_rak);
    
    // Pass the Rak data to the edit view
    return view('datarak.edit', compact('rak'));
}

public function update(Request $request, $id_rak)
{
  
$rakCount = Rak::where('id_rak', $id_rak)
->where('id_rak', '<>', $id_rak)
->count();

    // Validasi input
    $validated = $request->validate([
       // 'id_rak' => 'required|unique:rak,id_rak,' . $id_rak, // Pastikan id_rak unik kecuali untuk rak yang sedang diupdate
        'nama_rak' => 'required|string|max:255',
        'id_lokasi' => 'required|integer',
    ]);

    // Temukan rak yang ingin diupdate
    $rak = Rak::findOrFail($id_rak);
    
    // Update rak dengan data yang sudah divalidasi
    $rak->update($validated);

        
    // Redirect to the Rak index page with a success message
    return redirect()->route('datarak.index')->with('success', 'Rak updated successfully!');
}

    // Handle the deletion of the Rak
    public function destroy($id_rak)
    {
        // Find the Rak by ID
        $rak = Rak::findOrFail($id_rak);

        // Delete the Rak
        $rak->delete();

        // Redirect to the Rak index page with a success message
        return redirect()->route('datarak.index')->with('success', 'Rak deleted successfully!');
    }
}
