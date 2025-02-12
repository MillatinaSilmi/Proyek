<?php

namespace App\Http\Controllers;

use App\Models\DataSpm;
use Illuminate\Http\Request;

class DataSpmController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel dataspm
        $dataspm = DataSpm::paginate(10); // Menampilkan 10 data per halaman
        
        // Kirim data ke view
        return view('dataspm.index', compact('dataspm'));
    }
    public function showSearchForm()
    {
        
        return view('search');
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'search_term' => 'required|string', // Renaming the input to be more general
        ]);
    
        // Search for matching records across multiple columns including unit name (join with unit table)
        $searchTerm = $validated['search_term'];
        $dataspm = DataSpm::join('unit', 'dataspm.id_unit', '=', 'unit.id_unit') // Joining with unit table
            ->where('dataspm.nospm', 'like', '%' . $searchTerm . '%')
            ->orWhere('dataspm.uraian', 'like', '%' . $searchTerm . '%')
            ->orWhere('dataspm.nominal_spm', 'like', '%' . $searchTerm . '%')
            ->orWhere('unit.nama_unit', 'like', '%' . $searchTerm . '%') // Searching in unit name
            ->get();
    
        if ($dataspm->isNotEmpty()) {
            // Return result to view
            return view('dataspm.index', compact('dataspm'));
        } else {
            return redirect()->back()->with('error', 'No matching SPM found.');
        }
    }
    
    

    
    public function searchSPM(Request $request)
{
    // Validasi input dari pengguna
    $request->validate([
        'search' => 'required|string|max:50',
    ]);

    // Ambil istilah pencarian
    $search = $request->input('search');

    // Cari DataSPM yang sesuai dengan istilah pencarian
    $dataspm = DataSPM::where('nospm', 'like', '%' . $search . '%')->paginate(10);

    // Jika tidak ada data ditemukan, simpan pesan error dan data dalam session
    if ($dataspm->isEmpty()) {
        return redirect()->route('indexfilter.searchSPM')
                         ->with('error', 'No SPM found with the provided search term.')
                         ->with('dataspm', $dataspm);
    }

    // Kembalikan view dengan data yang dipaginasikan
    return view('indexfilter', ['dataspm' => $dataspm]);

}

    
}