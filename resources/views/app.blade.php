
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Akademik')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6fa; }
        .navbar { background: #172554; }
        .navbar-brand, .nav-link { color: white !important; }
        .content-card {
            background: white;
            border: 0;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0,0,0,.05);
        }
        .page-title { color: #172554; font-weight: 700; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('matakuliah.index') }}">
            SISTEM AKADEMIK
        </a>

        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('matakuliah.index') }}">Mata Kuliah</a>
            <a class="nav-link" href="{{ route('absensi.index') }}">Absensi</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali input kamu:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
