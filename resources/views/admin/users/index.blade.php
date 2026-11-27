@extends('layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Kelola Pengguna</h3>
    <a href="{{ route('admin.users.create') }}" class="btn btn-dev">+ Tambah Akun Staf</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
        <select name="role" class="form-select">
            <option value="">Semua role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" @selected(request('role') === $role->name)>{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-5">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama atau email">
    </div>
    <div class="col-md-4">
        <button class="btn btn-dev">Cari</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama</th><th>Email</th><th>No. HP</th><th>Role</th><th>Status</th><th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone ?? '-' }}</td>
                    <td>
                        <span class="badge text-bg-{{ ['admin' => 'success', 'kasir' => 'warning', 'pelanggan' => 'secondary'][$u->role?->name] ?? 'secondary' }}">
                            {{ ucfirst($u->role?->name) }}
                        </span>
                    </td>
                    <td>
                        @if ($u->is_active)
                            <span class="badge text-bg-success">Aktif</span>
                        @else
                            <span class="badge text-bg-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if ($u->role?->name !== 'pelanggan')
                            <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-dark">Ubah</a>
                        @endif
                        @if ($u->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.toggle', $u) }}" class="d-inline"
                                  onsubmit="return confirm('{{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }} akun {{ $u->name }}?')">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm {{ $u->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                    {{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada pengguna.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $users->links() }}</div>
@endsection