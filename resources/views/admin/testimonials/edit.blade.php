@extends('layouts.admin')

@section('title', 'Edit Testimonial')
@section('page_title', '<span>Edit</span> Testimonial')

@section('content')

<a href="{{ route('admin.testimonials.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Testimonials
</a>

<form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.testimonials._form')
    <div style="display:flex;gap:12px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Update Testimonial
        </button>
        <a href="{{ route('admin.testimonials.index') }}" class="btn-admin-secondary">
            <i class="fa-solid fa-xmark"></i> Cancel
        </a>
    </div>
</form>

@endsection
