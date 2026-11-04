<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliahs = MataKuliah::latest()->paginate(10);
        return view('matakuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk'  => 'required|string|max:10|unique:matakuliahs,kode_mk',
            'nama_mk'  => 'required|string|max:100',
            'sks'      => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        MataKuliah::create($request->only(['kode_mk', 'nama_mk', 'sks', 'semester']));

        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    public function show(MataKuliah $matakuliah)
    {
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $request->validate([
            'kode_mk'  => 'required|string|max:10|unique:matakuliahs,kode_mk,' . $matakuliah->id,
            'nama_mk'  => 'required|string|max:100',
            'sks'      => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        $matakuliah->update($request->only(['kode_mk', 'nama_mk', 'sks', 'semester']));

        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata Kuliah berhasil diperbarui!');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}