
@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="mb-4">
    <h3 class="page-title">Edit Mata Kuliah</h3>
    <p class="text-secondary">Perbarui informasi mata kuliah.</p>
</div>

<div class="card content-card">
    <div class="card-body p-4">
        <form action="{{ route('matakuliah.update', $matakuliah) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Mata Kuliah</label>
                <input type="text" name="kode" class="form-control"
                       value="{{ old('kode', $matakuliah->kode) }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah" class="form-control"
                       value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" required>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
