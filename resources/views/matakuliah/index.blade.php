@extends('app')

@section('title', 'Mata Kuliah')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="page-title">Mata Kuliah</h4>
        <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="content-card p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama MK</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mataKuliahs as $i => $mk)
                <tr>
                    <td>{{ $mataKuliahs->firstItem() + $i }}</td>
                    <td>{{ $mk->kode_mk }}</td>
                    <td>{{ $mk->nama_mk }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>{{ $mk->semester }}</td>
                    <td>
                        <a href="{{ route('matakuliah.edit', $mk) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('matakuliah.destroy', $mk) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $mataKuliahs->links() }}
    </div>
</div>
@endsection