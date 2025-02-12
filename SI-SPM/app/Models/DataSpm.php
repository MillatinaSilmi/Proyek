<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSpm extends Model
{
    use HasFactory;

    // Tabel yang terkait dengan model
    protected $table = 'dataspm';

    // Primary key dari tabel
    protected $primaryKey = 'nospm';
      protected $keyType = 'string'; // Jika primary key berupa string
      public $incrementing = false; // Jika primary key bukan auto-increment
    // Jika tidak menggunakan timestamps (created_at, updated_at)
    public $timestamps = false;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nospm',
        'uraian',
        'id_rak',
        'tanggal_spm',
        'nominal_spm',
        'kualifikasi_pembayaran',
        'dokumen',
        'create_at',
        'update_at',
        'id_unit',
        'id_rak',
    ];

    public function scopeKualifikasi($query, $kualifikasi)
    {
        return $query->where('kualifikasi_pembayaran', $kualifikasi);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit','id_unit');  // Pastikan 'id_unit' adalah nama kolom yang merujuk ke unit
    }

   // Pastikan relasi belongsTo dengan model Rak
    public function rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak'); // 'id_rak' adalah kolom yang merujuk ke tabel 'rak'
    }
    
}

