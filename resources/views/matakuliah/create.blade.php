@extends('app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="container py-4">
    <h4 class="page-title mb-3">Tambah Mata Kuliah</h4>
    <div class="content-card p-4">
        <form action="{{ route('matakuliah.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode MK</label>
                <input type="text" name="kode_mk" class="form-control" required maxlength="10">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama MK</label>
                <input type="text" name="nama_mk" class="form-control" required maxlength="100">
            </div>
            <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" class="form-control" required min="1" max="6">
            </div>
            <div class="mb-3">
                <label class="form-label">Semester</label>
                <input type="number" name="semester" class="form-control" required min="1" max="8">
            </div>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection