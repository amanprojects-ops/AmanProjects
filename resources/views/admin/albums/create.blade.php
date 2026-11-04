@extends('layouts.admin')

@section('title', 'Add Album')
@section('page_title', '<span>Add</span> Album')

@section('content')

<a href="{{ route('admin.albums.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Albums
</a>

<form action="{{ route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.albums._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Album
        </button>
        <a href="{{ route('admin.albums.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
