@extends('app')

@section('title', 'Form Absensi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0 fw-bold">Absensi Mahasiswa</h4>
        <small class="text-muted">Pilih tanggal dan mata kuliah untuk mencatat kehadiran</small>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-white fw-semibold border-bottom">Filter Absensi</div>
    <div class="card-body">
        <form method="GET" action="{{ route('absensi.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="{{ $tanggal }}">
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-semibold">Mata Kuliah</label>
                    <select class="form-select" name="matakuliah_id">
                        <option value="">— Pilih Mata Kuliah —</option>
                        @foreach($mataKuliahs as $mk)
                            <option value="{{ $mk->id }}" {{ $mataKuliahId == $mk->id ? 'selected' : '' }}>
                                [{{ $mk->kode_mk }}] {{ $mk->nama_mk }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if($mataKuliahId && $mahasiswas->isNotEmpty())
    @php $selectedMK = $mataKuliahs->firstWhere('id', $mataKuliahId); @endphp
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
            <span class="fw-semibold">{{ $selectedMK?->nama_mk ?? '-' }}</span>
            <span class="badge bg-light text-dark border">{{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}</span>
        </div>
        <form method="POST" action="{{ route('absensi.store') }}">
            @csrf
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
            <input type="hidden" name="matakuliah_id" value="{{ $mataKuliahId }}">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th><th>NIM</th><th>Nama</th><th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $index => $mhs)
                        @php $existing = $absensis->get($mhs->id); $savedStatus = $existing ? $existing->status : 'hadir'; @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama }}</td>
                            <td class="text-center">
                                @foreach(['hadir' => 'success', 'alpa' => 'danger', 'izin' => 'warning', 'sakit' => 'info'] as $val => $color)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="absensi[{{ $mhs->id }}]" value="{{ $val }}" {{ $savedStatus === $val ? 'checked' : '' }} required>
                                    <label class="form-check-label text-{{ $color }} fw-semibold">{{ ucfirst($val) }}</label>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-outline-success" onclick="document.querySelectorAll('input[value=hadir]').forEach(r=>r.checked=true)">Hadir Semua</button>
                <button type="submit" class="btn btn-primary px-4">Simpan Absensi</button>
            </div>
        </form>
    </div>
@elseif($mataKuliahId && $mahasiswas->isEmpty())
    <div class="alert alert-warning">Belum ada data mahasiswa.</div>
@else
    <div class="text-center py-5 text-muted">
        <p>Pilih tanggal dan mata kuliah, lalu klik <strong>Tampilkan</strong>.</p>
    </div>
@endif
@endsection