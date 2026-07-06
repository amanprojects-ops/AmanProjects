@extends('layouts.admin')

@section('title', 'Add Process Step')
@section('page_title', '<span>Add</span> Process Step')

@section('content')

<a href="{{ route('admin.process-steps.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Process Steps
</a>

<form action="{{ route('admin.process-steps.store') }}" method="POST">
    @csrf
    @include('admin.process-steps._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Step
        </button>
        <a href="{{ route('admin.process-steps.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
