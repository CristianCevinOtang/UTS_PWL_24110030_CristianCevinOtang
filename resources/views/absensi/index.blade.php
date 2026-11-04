@extends('layouts.app')

@section('title', 'Form Absensi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0 fw-bold">
            <i class="bi bi-calendar2-check text-primary me-2"></i>Absensi Mahasiswa
        </h4>
        <small class="text-muted">Pilih tanggal dan mata kuliah untuk mencatat kehadiran</small>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-white fw-semibold border-bottom">
        <i class="bi bi-funnel me-2 text-primary"></i>Filter Absensi
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('absensi.index') }}">
            <div class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal"
                           name="tanggal" value="{{ $tanggal }}" required>
                </div>

                <div class="col-md-5">
                    <label for="matakuliah_id" class="form-label fw-semibold">Mata Kuliah</label>
                    <select class="form-select" id="matakuliah_id" name="matakuliah_id" required>
                        <option value="">— Pilih Mata Kuliah —</option>
                        @foreach($mataKuliahs as $mk)
                            <option value="{{ $mk->id }}"
                                {{ $mataKuliahId == $mk->id ? 'selected' : '' }}>
                                [{{ $mk->kode_mk }}] {{ $mk->nama_mk }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>Tampilkan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@if($mataKuliahId && $mahasiswas->isNotEmpty())

    @php $selectedMK = $mataKuliahs->firstWhere('id', $mataKuliahId); @endphp

    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
            <span class="fw-semibold">
                <i class="bi bi-people me-2 text-primary"></i>{{ $selectedMK?->nama_mk ?? '-' }}
            </span>
            <span class="badge bg-light text-dark border">
                {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}
            </span>
        </div>

        <form method="POST" action="{{ route('absensi.store') }}">
            @csrf
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
            <input type="hidden" name="matakuliah_id" value="{{ $mataKuliahId }}">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3" style="width:50px">No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th class="text-center">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $index => $mhs)
                        @php
                            $existing    = $absensis->get($mhs->id);
                            $savedStatus = $existing ? $existing->status : 'hadir';
                        @endphp
                        <tr>
                            <td class="ps-3 text-muted">{{ $index + 1 }}</td>
                            <td><code>{{ $mhs->nim }}</code></td>
                            <td class="fw-semibold">{{ $mhs->nama }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-center flex-wrap">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               name="absensi[{{ $mhs->id }}]"
                                               id="hadir_{{ $mhs->id }}" value="hadir"
                                               {{ $savedStatus === 'hadir' ? 'checked' : '' }} required>
                                        <label class="form-check-label text-success fw-semibold"
                                               for="hadir_{{ $mhs->id }}">Hadir</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               name="absensi[{{ $mhs->id }}]"
                                               id="alpa_{{ $mhs->id }}" value="alpa"
                                               {{ $savedStatus === 'alpa' ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger fw-semibold"
                                               for="alpa_{{ $mhs->id }}">Alpa</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               name="absensi[{{ $mhs->id }}]"
                                               id="izin_{{ $mhs->id }}" value="izin"
                                               {{ $savedStatus === 'izin' ? 'checked' : '' }}>
                                        <label class="form-check-label text-warning fw-semibold"
                                               for="izin_{{ $mhs->id }}">Izin</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               name="absensi[{{ $mhs->id }}]"
                                               id="sakit_{{ $mhs->id }}" value="sakit"
                                               {{ $savedStatus === 'sakit' ? 'checked' : '' }}>
                                        <label class="form-check-label text-info fw-semibold"
                                               for="sakit_{{ $mhs->id }}">Sakit</label>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm btn-outline-success" id="btnHadirSemua">
                    <i class="bi bi-check-all me-1"></i>Hadir Semua
                </button>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i>Simpan Absensi
                </button>
            </div>
        </form>
    </div>

@elseif($mataKuliahId && $mahasiswas->isEmpty())
    <div class="alert alert-warning">
        Belum ada data mahasiswa di database.
    </div>
@else
    <div class="text-center py-5 text-muted">
        <i class="bi bi-calendar2-event fs-1 d-block mb-3"></i>
        <p>Pilih tanggal dan mata kuliah, lalu klik <strong>Tampilkan</strong>.</p>
    </div>
@endif
@endsection

@push('scripts')
<script>
document.getElementById('btnHadirSemua')?.addEventListener('click', function () {
    document.querySelectorAll('input[type="radio"][value="hadir"]').forEach(r => r.checked = true);
});
</script>
@endpush