@extends('layouts.admin')

@section('title', 'Add Testimonial')
@section('page_title', '<span>Add</span> Testimonial')

@section('content')

<a href="{{ route('admin.testimonials.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Testimonials
</a>

<form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.testimonials._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Create Testimonial
        </button>
        <a href="{{ route('admin.testimonials.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
