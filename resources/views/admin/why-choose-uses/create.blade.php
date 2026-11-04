@extends('layouts.admin')

@section('title', 'Add Why Choose Us Benefit')
@section('page_title', '<span>Add</span> Benefit')

@section('content')

<a href="{{ route('admin.why-choose-uses.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Why Choose Us
</a>

<form action="{{ route('admin.why-choose-uses.store') }}" method="POST">
    @csrf
    @include('admin.why-choose-uses._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Benefit
        </button>
        <a href="{{ route('admin.why-choose-uses.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
