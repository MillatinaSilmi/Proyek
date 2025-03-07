<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPM extends Model
{
    use HasFactory;
    const UPDATED_AT = 'update_at'; 
    protected $table = 'dataspm'; // Nama tabel di database
    protected $primaryKey = 'nospm'; // Primary key adalah nospm
    protected $keyType = 'string'; // Jika primary key berupa string
    protected $fillable = ['no_spm', 'uraian', 'tanggal_spm', 'nominal_spm', 'kualifikasi_pembayaran', 'create_at', 'update_at'];
    public $incrementing = false; // Jika primary key bukan auto-increment
   
    public function unit()
    {
        return $this->belongsTo(unit::class, 'id_unit');}
     
        public function search(Request $request)
{
    $search = $request->get('search');
    $dataspm = DataSPM::where('nospm', 'like', '%'.$search.'%')->paginate(10);
    return view('dataspm.index', compact('dataspm'));
}







// Relasi antara DataSpm dan Rak
public function rak()
{
    return $this->belongsTo(rak::class, 'id_rak');  // 'rak_id' adalah foreign key
}



}






    