<?php
namespace App\Http\Controllers;

use App\Models\user;
use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
   
    public function index()
    {
       

        $datauser = user::paginate(10); // Menampilkan 10 data per halaman
                // Kirim data ke view
        return view('datauser.index', compact('datauser'));

        $datauser = user::all(); // Ambil data dari model Unit
        
        return view('datauser.index', compact('datauser'));
    }
    public function show($NIP)
    {
        
        // Mengambil data user berdasarkan ID
        $user = user::find($NIP);
        
            // Ambil data berdasarkan nospm
            $user = user::where('nama', $nama)->first();
    
            // Jika data tidak ditemukan
            if (!$user) {
                abort(404, 'Data User tidak ditemukan');
            }
            $data = SPM::find($nospm);
        // Cek apakah user ditemukan
        if ($user) {
            // Menambahkan kondisi berdasarkan id_role
            if ($user->id_role == 1) {
                $nama_role = 'Admin';
            } elseif ($user->id_role == 2) {
                $nama_role = 'Pegawai';
            } else {
                $roleName = 'Role tidak ditemukan';
            }

            // Kirim data user dan role ke view
            return view('user.show', compact('user', 'nama_role'));
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
    }
    public $timestamps = false;
    public function create()
    {
        $role = role::all();
        return view('input-user', compact('role'));
    }

    public function store(Request $request)
    {$request->validate([
       
            'NIP' => 'required|string|max:255|unique:user,nip|not_in:0',
            'password' => 'required|string|min:8',
            'nama' => 'required|string|max:255',
            'id_role' => 'required|exists:role,id_role',
        ]);

        user::create([
            'NIP' => $request['NIP'],
            'password' =>hash::make ($request['password']),
             'nama' => $request['nama'],
            'id_role' => $request['id_role'],
        ]);

        return redirect()->route('datauser.index')->with('success', 'User berhasil ditambahkan!');
    }
    

    public function search(Request $request)
    {
        {
            // Mengambil kata kunci dari input pencarian
            $nama = $request->input('nama');
    
            // Pencarian user berdasarkan nama yang mengandung kata kunci
            $datauser = User::where('nama', 'like', '%' . $nama . '%')->get();
    
            // Kembalikan hasil pencarian ke view
            return view('datauser.index', compact('datauser', 'nama'));
           
        }
    }
    
    //
    public function edit($NIP)
    {
        // Mencari data user berdasarkan NIP
        $user = User::where('NIP', $NIP)->firstOrFail();
         // Ambil data roles
    $role = Role::all();  // Pastikan ada model Role yang mengakses tabel roles

        // Mengembalikan view untuk edit dengan data user
    
        return view('datauser.edit', compact('user', 'role'));
    }
    
    public function update(Request $request, $NIP)
{
   
    // Cari user berdasarkan NIP yang langsung digunakan tanpa decode
    $user = User::where('NIP', $NIP)->firstOrFail();

    // Validasi data
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'id_role' => 'required|exists:role,id_role',  // Validasi role
        'password' => 'nullable|string|min:6',  // Hapus konfirmasi password
    ]);

    // Update data user
    $user->nama = $validated['nama'];
    $user->id_role = $validated['id_role'];

    // Jika password ada perubahan
    if ($validated['password']) {
        $user->password = bcrypt($validated['password']); // Enkripsi password
    }

    // Simpan perubahan
    $user->save();

    // Redirect kembali ke halaman index dengan pesan success
    return redirect()->route('datauser.index')->with('success', 'User berhasil diperbarui.');
}


    

    

// Menghapus user
public function destroy($NIP)
{
    $user = User::findOrFail($NIP);
    $user->delete(); // Menghapus user dari database

    return redirect()->route('datauser.index')->with('success', 'User berhasil dihapus.');
}

}
