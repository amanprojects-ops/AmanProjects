@extends('layouts.admin')

@section('title', 'Add Skill')
@section('page_title', '<span>Add</span> Skill')

@section('content')

<a href="{{ route('admin.skills.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Skills
</a>

<form action="{{ route('admin.skills.store') }}" method="POST">
    @csrf
    @include('admin.skills._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Skill
        </button>
        <a href="{{ route('admin.skills.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
