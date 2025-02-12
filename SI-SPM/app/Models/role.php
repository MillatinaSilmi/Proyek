<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'role';
    protected $fillable = ['nama_role'];
    protected $primaryKey = 'id_role'; // Nama kolom primary key jika berbeda dengan 'id'
    
    public function user()
    {
        return $this->hasMany(user::class);
    }
}
