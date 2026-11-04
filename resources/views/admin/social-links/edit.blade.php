@extends('layouts.admin')

@section('title', 'Edit Social Link')
@section('page_title', '<span>Edit</span> Social Link')

@section('content')

<a href="{{ route('admin.social-links.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Social Links
</a>

<form action="{{ route('admin.social-links.update', $socialLink) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.social-links._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Link
        </button>
        <a href="{{ route('admin.social-links.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
