@extends('layouts.admin')

@section('title', 'Add Post')
@section('page_title', '<span>Add</span> Post')

@section('content')

<a href="{{ route('admin.posts.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Posts
</a>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.posts._form')
    <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:16px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Post
        </button>
        <a href="{{ route('admin.posts.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
