@extends('layouts.admin')

@section('title', 'Edit Project')
@section('page_title', '<span>Edit</span> Project')

@section('content')

<a href="{{ route('admin.projects.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Projects
</a>

<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.projects._form')
    <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:16px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Project
        </button>
        <a href="{{ route('admin.projects.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
