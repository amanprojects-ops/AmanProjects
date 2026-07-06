@extends('layouts.admin')

@section('title', 'Add Social Link')
@section('page_title', '<span>Add</span> Social Link')

@section('content')

<a href="{{ route('admin.social-links.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Social Links
</a>

<form action="{{ route('admin.social-links.store') }}" method="POST">
    @csrf
    @include('admin.social-links._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Link
        </button>
        <a href="{{ route('admin.social-links.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
