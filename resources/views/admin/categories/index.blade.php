@extends('layouts.app')
@section('title', 'Kelola Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Kelola Kategori</h3>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-dev">+ Tambah Kategori</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama</th><th>Deskripsi</th><th class="text-center">Jumlah produk</th><th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($categories as $c)
                <tr>
                    <td class="fw-semibold">{{ $c->name }}</td>
                    <td>{{ $c->description ?? '-' }}</td>
                    <td class="text-center"><span class="badge text-bg-secondary">{{ $c->products_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('admin.categories.edit', $c) }}" class="btn btn-sm btn-outline-dark">Ubah</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $c) }}" class="d-inline"
                              onsubmit="return confirm('Hapus kategori {{ $c->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada kategori.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $categories->links() }}</div>
@endsection