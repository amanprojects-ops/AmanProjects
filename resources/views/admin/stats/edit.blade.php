@extends('layouts.admin')

@section('title', 'Edit Stat')
@section('page_title', '<span>Edit</span> Stat')

@section('content')

<a href="{{ route('admin.stats.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Stats
</a>

<form action="{{ route('admin.stats.update', $stat) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.stats._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Stat
        </button>
        <a href="{{ route('admin.stats.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
