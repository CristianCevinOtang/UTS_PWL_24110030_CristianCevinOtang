<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
    ];

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'mahasiswa_id');
    }
}