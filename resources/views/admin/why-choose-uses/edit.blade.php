@extends('layouts.admin')

@section('title', 'Edit Why Choose Us Benefit')
@section('page_title', '<span>Edit</span> Benefit')

@section('content')

<a href="{{ route('admin.why-choose-uses.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Why Choose Us
</a>

<form action="{{ route('admin.why-choose-uses.update', $whyChooseUs) }}" method="POST">
    @csrf
    @method('PUT')
    @include('admin.why-choose-uses._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Benefit
        </button>
        <a href="{{ route('admin.why-choose-uses.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
