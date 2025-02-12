<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rak extends Model
{public $timestamps = false;
    protected $primaryKey = 'id_rak';  // Kolom yang digunakan untuk primary key
    use HasFactory;
    protected $table = 'rak';
    protected $fillable = ['id_rak', 'nama_rak', 'id_lokasi'];

    
    // Relasi antara Rak dan Spm
    public function dataspm()
    {
        return $this->hasMany(dataspm::class, 'id_rak');  
    }

    public function lokasirak()
    {
        
        return $this->belongsTo(lokasirak::class);
    }
    public function index()
{
    $rak = rak::with('lokasirak')->get(); // Mengambil data rak beserta data Role
    
    return view('datarak.index', compact('rak'));
}
public function search(Request $request){
$search = $request->get('search');
    $datarak = rak::where('nama_rak', 'like', '%'.$search.'%')->paginate(10);
    return view('datarak.index', compact('datarak'));
}

// Model SPM


    public function rak()
    {
        return $this->belongsTo(Rak::class); // Sesuaikan dengan relasi yang tepat
    }


}
