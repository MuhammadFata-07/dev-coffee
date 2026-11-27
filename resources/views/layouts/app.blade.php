<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DevOrder') - Dev Coffee &amp; Drinks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --dev-green: #3F4F36; --dev-cream: #F3EEE2; }
        body { background: var(--dev-cream); }
        .navbar-dev { background: var(--dev-green); }
        .btn-dev { background: var(--dev-green); color: #fff; }
        .btn-dev:hover { background: #2f3b29; color: #fff; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark navbar-dev">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">DevOrder</a>
        <div class="d-flex align-items-center gap-2">
            @auth
                @if (auth()->user()->hasRole('kasir'))
                    <a class="btn btn-sm btn-outline-light" href="{{ route('kasir.dashboard') }}">Kasir</a>
                @endif
                @if (auth()->user()->hasRole('admin'))
                    <a class="btn btn-sm btn-outline-light" href="{{ route('admin.dashboard') }}">Admin</a>
                @endif
                <span class="text-white small d-none d-md-inline">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-light">Keluar</button>
                </form>
            @else
                <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}">Masuk</a>
                <a class="btn btn-sm btn-light" href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>