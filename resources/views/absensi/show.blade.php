
@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
<div class="mb-4">
    <h3 class="page-title">Detail Mata Kuliah</h3>
</div>

<div class="card content-card">
    <div class="card-body p-4">
        <p><strong>Kode:</strong> {{ $matakuliah->kode }}</p>
        <p><strong>Nama Mata Kuliah:</strong> {{ $matakuliah->nama_matakuliah }}</p>

        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('matakuliah.edit', $matakuliah) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
