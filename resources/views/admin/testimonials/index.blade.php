@extends('layouts.admin')

@section('title', 'Testimonials')
@section('page_title', '<span>Testimonials</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-comment-dots"></i></span>
        Testimonials
    </h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Testimonial
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:70px;">Avatar</th>
                    <th>Client</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                    <tr>
                        <td>
                            @if($testimonial->avatar)
                                <img src="{{ asset($testimonial->avatar) }}" alt="Avatar" style="width:38px;height:38px;border-radius:50%;object-fit:cover;border:1.5px solid #6366f1;">
                            @else
                                <div style="width:38px;height:38px;border-radius:50%;background:#e0e7ff;color:#4f46e5;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:1.5px solid #c7d2fe;">
                                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600;color:#1e293b;">{{ $testimonial->name }}</div>
                            @if($testimonial->designation)
                                <div style="font-size:12px;color:#64748b;">{{ $testimonial->designation }}</div>
                            @endif
                        </td>
                        <td>
                            <div style="display:inline-flex;gap:2px;">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-star {{ $i <= $testimonial->rating ? 'fa-solid' : 'fa-regular' }}" 
                                       style="font-size:11px;color:{{ $i <= $testimonial->rating ? '#f59e0b' : '#cbd5e1' }};"></i>
                                @endfor
                            </div>
                        </td>
                        <td style="color:#64748b;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $testimonial->text }}">
                            {{ $testimonial->text ?? '—' }}
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this testimonial?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-admin-delete">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fa-solid fa-comment-dots"></i>
                                <p>No testimonials found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
