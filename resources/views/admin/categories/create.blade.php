@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
<h3 class="mb-3">Tambah Kategori</h3>
<div class="card shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            @include('admin.categories._form', ['category' => null])
        </form>
    </div>
</div>
@endsection