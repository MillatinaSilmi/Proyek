<?php
namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    // Menampilkan form input data unit
   // Menampilkan form input dan data unit (termasuk fitur pencarian)
   public function create(Request $request)
{
    // Ambil kata kunci dari input pencarian
    $keyword = $request->input('keyword');

    // Ambil data unit berdasarkan kata kunci (jika ada) atau semua data unit
    if ($keyword) {
        $unit = Unit::where('id_unit', 'like', "%$keyword%")
            ->orWhere('nama_unit', 'like', "%$keyword%")
            ->get();
    } else {
        $unit = Unit::all(); // Ambil semua data jika tidak ada pencarian
    }

    return view('unit.create', compact('unit'));
}

// Menyimpan data unit ke database
public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'id_unit' => 'required|numeric|unique:unit,id_unit', // Validasi: tidak boleh kosong, harus angka, dan unik
        'nama_unit' => 'required|string|max:255',
    ],[
     // Menambahkan pesan kustom untuk validasi 'unique'
     'id_unit.unique' => 'ID Unit sudah digunakan. Silakan coba ID yang lain.',
    ]);

    // Simpan data unit
    Unit::create($request->all());

    // Redirect ke halaman form dengan notifikasi sukses
    return redirect()->route('unit.create')->with('success', 'Unit berhasil disimpan');
}

   // Menghapus data unit
   public function destroy($id)
   {
       $unit = unit::findOrFail($id);
       $unit->delete();

       return redirect()->route('unit.create')->with('success', 'Unit berhasil dihapus');
   }

   // Menampilkan form untuk mengedit data unit
   public function edit($id_unit)
   {
       // Temukan unit berdasarkan ID
    $unit = Unit::findOrFail($id_unit);

    // Kirimkan unit ke view edit
    return view('unit.edit', compact('unit'));
   }

   // Memperbarui data unit
   public function update(Request $request, $id_unit)
{
    // Validasi data
    $validatedData = $request->validate([
        'nama_unit' => 'required|string|max:255',
      
    ]);

    // Temukan unit berdasarkan ID
    $unit = Unit::findOrFail($id_unit);

    // Perbarui unit dengan data yang telah divalidasi
    $unit->update($validatedData);

    // Redirect ke halaman unit dengan pesan sukses
    return redirect()->route('unit.create')->with('success', 'Unit updated successfully');
}


}
