<?php

namespace App\Models;

use Illuminate\Foundation\Auth\user as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Pastikan trait diimpor
class user extends Authenticatable
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'user';
    protected $fillable = ['NIP', 'password', 'nama', 'id_role'];
    protected $primaryKey = 'NIP'; // Ganti 'NIP' dengan nama kolom primary key Anda
    
    public function role()
{
    return $this->belongsTo(Role::class, 'id_role', 'id_role');
}



    public function index()
{
    $user = user::with('role')->get(); // Mengambil data User beserta data Role
    
    return view('datauser.index', compact('user'));
}
public function search(Request $request){
$search = $request->get('search');
    $datauser = user::where('nama', 'like', '%'.$search.'%')->paginate(10);
    return view('datauser.index', compact('datauser'));
}
// Model User

}
