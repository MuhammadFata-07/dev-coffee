<div class="mb-3">
    <label class="form-label" for="name">Nama kategori</label>
    <input type="text" id="name" name="name" value="{{ old('name', $category?->name) }}"
           class="form-control @error('name') is-invalid @enderror" maxlength="50" required autofocus>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="description">Deskripsi (opsional)</label>
    <textarea id="description" name="description" rows="3" maxlength="255"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $category?->description) }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<button class="btn btn-dev">Simpan</button>
<a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Batal</a>