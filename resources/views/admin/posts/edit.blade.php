@extends('layouts.admin')

@section('title', 'Edit Post')
@section('page_title', '<span>Edit</span> Post')

@section('content')

<a href="{{ route('admin.posts.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Posts
</a>

<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.posts._form')
    <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:16px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Post
        </button>
        <a href="{{ route('admin.posts.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
