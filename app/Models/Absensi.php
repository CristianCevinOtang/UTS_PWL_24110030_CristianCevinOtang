<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    protected $fillable = [
        'mahasiswa_id',
        'matakuliah_id',
        'tanggal_absensi',
        'status_absen',
    ];

    protected $casts = [
        'tanggal_absensi' => 'date',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'matakuliah_id');
    }
}