@php $isSelf = $user && $user->id === auth()->id(); @endphp

<div class="mb-3">
    <label class="form-label" for="name">Nama</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}"
           class="form-control @error('name') is-invalid @enderror" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}"
           class="form-control @error('email') is-invalid @enderror" required>
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="phone">No. HP (opsional)</label>
    <input type="text" id="phone" name="phone" value="{{ old('phone', $user?->phone) }}"
           class="form-control @error('phone') is-invalid @enderror">
    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="role_id">Role</label>
    <select id="role_id" name="role_id" class="form-select @error('role_id') is-invalid @enderror"
            {{ $isSelf ? 'disabled' : '' }} required>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @selected(old('role_id', $user?->role_id) == $role->id)>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @if ($isSelf)
        <input type="hidden" name="role_id" value="{{ $user->role_id }}">
        <div class="form-text">Anda tidak dapat mengubah role akun sendiri.</div>
    @endif
    @error('role_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="password">
        Kata sandi {{ $user ? '(kosongkan jika tidak diubah)' : '(min. 8 karakter)' }}
    </label>
    <input type="password" id="password" name="password"
           class="form-control @error('password') is-invalid @enderror" {{ $user ? '' : 'required' }}>
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="password_confirmation">Ulangi kata sandi</label>
    <input type="password" id="password_confirmation" name="password_confirmation"
           class="form-control" {{ $user ? '' : 'required' }}>
</div>

<button class="btn btn-dev">Simpan</button>
<a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>