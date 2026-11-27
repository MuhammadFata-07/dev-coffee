@extends('layouts.app')
@section('title', 'Ubah Kategori')

@section('content')
<h3 class="mb-3">Ubah Kategori: {{ $category->name }}</h3>
<div class="card shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            @include('admin.categories._form')
        </form>
    </div>
</div>
@endsection