<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasirak extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'lokasirak';
    protected $fillable = ['lokasi_rak'];
    
    public function rak()
    {
        return $this->hasMany(rak::class);
    }
}
