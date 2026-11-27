@extends('layouts.app')
@section('title', 'Ubah Akun')

@section('content')
<h3 class="mb-3">Ubah Akun: {{ $user->name }}</h3>
<div class="card shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            @include('admin.users._form')
        </form>
    </div>
</div>
@endsection