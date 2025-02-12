<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    protected $table = 'unit';

    // ID unit sebagai primary key
    protected $primaryKey = 'id_unit';
    protected $fillable = ['id_unit', 'nama_unit'];
    public $timestamps = false; // Nonaktifkan penggunaan timestamps
    public $incrementing = false;
   

    public function spm()
    {
        return $this->hasMany(Spm::class, 'id_unit');
    }
    public function dataspm()
    {
        return $this->hasMany(Dataspm::class, 'id_unit', 'id_unit');  // Relasi ke Dataspm
    }
    




    


}

