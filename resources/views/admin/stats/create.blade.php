@extends('layouts.admin')

@section('title', 'Add Stat')
@section('page_title', '<span>Add</span> Stat')

@section('content')

<a href="{{ route('admin.stats.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Stats
</a>

<form action="{{ route('admin.stats.store') }}" method="POST">
    @csrf
    @include('admin.stats._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Stat
        </button>
        <a href="{{ route('admin.stats.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
