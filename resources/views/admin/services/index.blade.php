@extends('layouts.admin')

@section('title', 'Services')
@section('page_title', '<span>Services</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-server"></i></span>
        Services & Local Landing Pages
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
                    <th style="width:70px;">Icon</th>
                    <th>Service & URL Slug</th>
                    <th>Short Description</th>
                    <th style="width:100px;">Status</th>
                    <th style="width:70px;text-align:center;">Order</th>
                    <th style="text-align:right;width:240px;">Actions</th>
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
                            <div style="font-weight:600;color:#1e293b;font-size:14.5px;">{{ $service->title }}</div>
                            <div style="font-family:monospace;font-size:12px;color:#6366f1;margin-top:2px;">
                                /{{ $service->slug }}
                            </div>
                        </td>
                        <td style="color:#64748b;max-width:280px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $service->desc }}">
                            {{ $service->desc ?? '—' }}
                        </td>
                        <td>
                            @if($service->is_active)
                                <span style="background:#dcfce7;color:#166534;font-size:11.5px;font-weight:600;padding:3px 8px;border-radius:6px;display:inline-flex;align-items:center;gap:4px;">
                                    <span style="width:6px;height:6px;border-radius:50%;background:#16a34a;"></span> Active
                                </span>
                            @else
                                <span style="background:#fee2e2;color:#991b1b;font-size:11.5px;font-weight:600;padding:3px 8px;border-radius:6px;display:inline-flex;align-items:center;gap:4px;">
                                    <span style="width:6px;height:6px;border-radius:50%;background:#dc2626;"></span> Draft
                                </span>
                            @endif
                        </td>
                        <td style="text-align:center;font-weight:600;color:#475569;">
                            {{ $service->sort_order }}
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ $service->url }}" target="_blank" class="btn-admin-secondary" style="padding:6px 12px;font-size:12px;" title="View Live Page">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Live
                                </a>
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete {{ $service->title }}? This will remove its dedicated page and homepage card.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-admin-delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-server"></i>
                                <p>No services found. Click "Add Service" to create one.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
