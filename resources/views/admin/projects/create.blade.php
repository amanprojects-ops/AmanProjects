@extends('layouts.admin')

@section('title', 'Add Project')
@section('page_title', '<span>Add</span> Project')

@section('content')

<a href="{{ route('admin.projects.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Projects
</a>

<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.projects._form')
    <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:16px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Project
        </button>
        <a href="{{ route('admin.projects.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
