<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliahs';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
    ];

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'matakuliah_id');
    }
}