@extends('layouts.app')
@section('title', 'Panel Admin')

@section('content')
<h3 class="mb-3">Panel Admin</h3>
<div class="row g-3">
    <div class="col-md-4">
        <a href="{{ route('admin.users.index') }}" class="card shadow-sm text-decoration-none h-100">
            <div class="card-body">
                <h5 class="card-title text-dark">Kelola Pengguna</h5>
                <p class="card-text text-muted mb-0">Akun admin, kasir, dan daftar pelanggan.</p>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('admin.categories.index') }}" class="card shadow-sm text-decoration-none h-100">
            <div class="card-body">
                <h5 class="card-title text-dark">Kelola Kategori</h5>
                <p class="card-text text-muted mb-0">Kategori produk: Coffee, Non Coffee, dan lainnya.</p>
            </div>
        </a>
    </div>
</div>
@endsection