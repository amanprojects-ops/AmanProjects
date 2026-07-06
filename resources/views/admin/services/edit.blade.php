@extends('layouts.admin')

@section('title', 'Edit Service')
@section('page_title', '<span>Edit</span> Service')

@section('content')

<a href="{{ route('admin.services.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Services
</a>

<form action="{{ route('admin.services.update', $service) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.services._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Service
        </button>
        <a href="{{ route('admin.services.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
