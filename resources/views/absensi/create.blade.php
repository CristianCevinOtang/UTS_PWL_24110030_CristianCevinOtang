
@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="mb-4">
    <h3 class="page-title">Tambah Mata Kuliah</h3>
    <p class="text-secondary">Masukkan informasi mata kuliah baru.</p>
</div>

<div class="card content-card">
    <div class="card-body p-4">
        <form action="{{ route('matakuliah.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kode Mata Kuliah</label>
                <input type="text" name="kode"
                       class="form-control"
                       value="{{ old('kode') }}"
                       placeholder="Contoh: MK001" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah"
                       class="form-control"
                       value="{{ old('nama_matakuliah') }}"
                       placeholder="Masukkan nama mata kuliah" required>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
