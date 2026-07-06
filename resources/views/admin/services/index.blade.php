@extends('layouts.admin')

@section('title', 'Services')
@section('page_title', '<span>Services</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-server"></i></span>
        Services
    </h1>
    <div style="display:flex;gap:10px;align-items:center;">
        <a href="{{ route('admin.services-settings.edit') }}" class="btn-admin-secondary" style="padding:10px 22px;border-radius:10px;">
            <i class="fa-solid fa-sliders"></i> Section Settings
        </a>
        <a href="{{ route('admin.services.create') }}" class="btn-admin-primary">
            <i class="fa-solid fa-plus"></i> Add Service
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:80px;">Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Theme / Color</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>
                            @if($service->icon_path)
                                <div style="width:38px;height:38px;background:#0d1526;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;color:#fff;">
                                    <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $service->icon_path }}"/>
                                    </svg>
                                </div>
                            @else
                                <span style="color:#cbd5e1;font-size:12px;">—</span>
                            @endif
                        </td>
                        <td>
                            <span style="font-weight:600;color:#1e293b;">{{ $service->title }}</span>
                        </td>
                        <td style="color:#64748b;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $service->desc }}">
                            {{ $service->desc ?? '—' }}
                        </td>
                        <td>
                            @if($service->color)
                                <code style="background:#f1f5f9;padding:3px 8px;border-radius:6px;font-size:12.5px;color:#6366f1;">{{ $service->color }}</code>
                            @else
                                <span style="color:#cbd5e1;font-size:12px;">—</span>
                            @endif
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?')">
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
                                <i class="fa-solid fa-server"></i>
                                <p>No services found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
