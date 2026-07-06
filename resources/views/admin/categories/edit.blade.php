@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page_title', '<span>Edit</span> Category')

@section('content')

<a href="{{ route('admin.categories.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Categories
</a>

<form action="{{ route('admin.categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.categories._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Category
        </button>
        <a href="{{ route('admin.categories.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
