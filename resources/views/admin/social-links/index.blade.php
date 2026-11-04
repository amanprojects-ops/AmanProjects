@extends('layouts.admin')

@section('title', 'Social Links')
@section('page_title', '<span>Social</span> Links')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-share-nodes"></i></span>
        Social Links
    </h1>
    <a href="{{ route('admin.social-links.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Link
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Platform</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($socialLinks as $link)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                @if($link->icon)
                                    <div style="width:34px;height:34px;border-radius:8px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:15px;color:#6366f1;">
                                        <i class="{{ $link->icon }}"></i>
                                    </div>
                                @endif
                                <span style="font-weight:600;color:#1e293b;">{{ $link->name }}</span>
                            </div>
                        </td>
                        <td>
                            <a href="{{ $link->url }}" target="_blank" style="color:#6366f1;font-size:13px;text-decoration:none;" class="d-flex align-items-center gap-1">
                                <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:10px;"></i>
                                {{ Str::limit($link->url, 45) }}
                            </a>
                        </td>
                        <td>
                            <span class="status-badge {{ $link->is_active ? 'active' : 'inactive' }}">
                                <i class="fa-solid fa-circle" style="font-size:6px;"></i>
                                {{ $link->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.social-links.edit', $link) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this link?')">
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
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="fa-solid fa-share-nodes"></i>
                                <p>No social links yet.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
