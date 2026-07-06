@extends('layouts.admin')

@section('title', 'Edit Plan')
@section('page_title', '<span>Edit</span> Plan')

@section('content')

<a href="{{ route('admin.plans.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Plans
</a>

<form action="{{ route('admin.plans.update', $plan) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.plans._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Plan
        </button>
        <a href="{{ route('admin.plans.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
