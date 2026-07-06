@extends('layouts.admin')

@section('title', 'Edit Process Step')
@section('page_title', '<span>Edit</span> Process Step')

@section('content')

<a href="{{ route('admin.process-steps.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Process Steps
</a>

<form action="{{ route('admin.process-steps.update', $processStep) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.process-steps._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Step
        </button>
        <a href="{{ route('admin.process-steps.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
