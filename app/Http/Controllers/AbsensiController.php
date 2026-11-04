<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $mataKuliahs  = MataKuliah::orderBy('nama_mk')->get();
        $mahasiswas   = collect();
        $absensis     = collect();
        $tanggal      = $request->tanggal ?? now()->format('Y-m-d');
        $mataKuliahId = $request->matakuliah_id;

        if ($mataKuliahId) {
            $mahasiswas = Mahasiswa::orderBy('nama')->get();

            $absensis = Absensi::where('matakuliah_id', $mataKuliahId)
                ->where('tanggal_absensi', $tanggal)
                ->get()
                ->keyBy('mahasiswa_id');
        }

        return view('absensi.index', compact(
            'mataKuliahs',
            'mahasiswas',
            'absensis',
            'tanggal',
            'mataKuliahId'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'matakuliah_id' => 'required|exists:matakuliahs,id',
            'absensi'       => 'required|array',
            'absensi.*'     => 'required|in:hadir,alpa,izin,sakit',
        ]);

        foreach ($request->absensi as $mahasiswaId => $status) {
            Absensi::updateOrCreate(
                [
                    'mahasiswa_id'    => $mahasiswaId,
                    'matakuliah_id'   => $request->matakuliah_id,
                    'tanggal_absensi' => $request->tanggal,
                ],
                ['status' => $status]
            );
        }

        return redirect()
            ->route('absensi.index', [
                'tanggal'       => $request->tanggal,
                'matakuliah_id' => $request->matakuliah_id,
            ])
            ->with('success', 'Absensi berhasil disimpan!');
    }
}