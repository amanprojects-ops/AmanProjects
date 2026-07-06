@extends('layouts.admin')

@section('title', 'Add Category')
@section('page_title', '<span>Add</span> Category')

@section('content')

<a href="{{ route('admin.categories.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Categories
</a>

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    @include('admin.categories._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Category
        </button>
        <a href="{{ route('admin.categories.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
