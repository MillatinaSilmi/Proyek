<?php

namespace App\Http\Controllers;

use App\Models\DataSpm;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DataSpmController extends Controller
{
    public function index(Request $request)
    {
        // Handle search query if provided
        $query = $request->input('query');
        
        // Paginate the results (5 per page) and filter based on the search query if provided
        $dataspm = DataSpm::when($query, function($queryBuilder) use ($query) {
            return $queryBuilder->where('nospm', 'like', "%{$query}%")
                                ->orWhere('uraian', 'like', "%{$query}%")
                                ->orWhere('nominal_spm', 'like', "%{$query}%");
        })->paginate(5); // Paginate 5 results per page
    
        // Send data to the view
        return view('dataspm.index', compact('dataspm'));
    }
    public function search(Request $request)
    {
        // Validate search input
        $validated = $request->validate([
            'search_term' => 'required|string',
        ]);
        
        // Search term from validated request
        $searchTerm = $validated['search_term'];
    
        // Paginate the search results
        $dataspm = DataSpm::join('unit', 'dataspm.id_unit', '=', 'unit.id_unit') // Join with the unit table
            ->where('dataspm.nospm', 'like', '%' . $searchTerm . '%')
            ->orWhere('dataspm.uraian', 'like', '%' . $searchTerm . '%')
            ->orWhere('dataspm.nominal_spm', 'like', '%' . $searchTerm . '%')
            ->orWhere('unit.nama_unit', 'like', '%' . $searchTerm . '%')
            ->paginate(5); // Paginate the search results (5 per page)
    
        // Check if results are found and return the data
        if ($dataspm->isNotEmpty()) {
            return view('dataspm.index', compact('dataspm'));
        } else {
            // If no results are found, redirect back with an error message
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
        if ($request->ajax()) {
            return response()->json(['error' => 'No SPM found with the provided search term.']);
        }

        return redirect()->route('indexfilter.searchSPM')
                         ->with('error', 'No SPM found with the provided search term.')
                         ->with('dataspm', $dataspm);
    }

    // Jika permintaan AJAX, kirim hasil pencarian dalam format JSON
    if ($request->ajax()) {
        return response()->json([
            'html' => view('indexfilter.table', compact('dataspm'))->render(),
        ]);
    }

    // Kembalikan view dengan data yang dipaginasikan untuk request biasa
    return view('indexfilter', ['dataspm' => $dataspm]);
}

    
}