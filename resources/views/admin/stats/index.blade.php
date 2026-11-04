@extends('layouts.admin')

@section('title', 'Stats')
@section('page_title', '<span>Stats</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-chart-simple"></i></span>
        Stats
    </h1>
    <a href="{{ route('admin.stats.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Stat
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Label</th>
                    <th>Value</th>
                    <th>Suffix</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stats as $stat)
                    <tr>
                        <td>
                            @if($stat->icon)
                                <div style="width:36px;height:36px;background:#e0e7ff;color:#4f46e5;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:16px;">
                                    <i class="{{ $stat->icon }}"></i>
                                </div>
                            @else
                                <span style="color:#94a3b8;font-size:12px;font-style:italic;">No icon</span>
                            @endif
                        </td>
                        <td style="font-weight:600;color:#1e293b;">{{ $stat->label }}</td>
                        <td style="font-weight:700;color:#0f172a;">{{ $stat->value }}</td>
                        <td>
                            @if($stat->suffix)
                                <code style="background:#f1f5f9;padding:3px 8px;border-radius:6px;font-size:12.5px;color:#6366f1;">{{ $stat->suffix }}</code>
                            @else
                                <span style="color:#cbd5e1;font-size:12px;">—</span>
                            @endif
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.stats.edit', $stat) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.stats.destroy', $stat) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this stat?')">
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
                                <i class="fa-solid fa-chart-simple"></i>
                                <p>No stats found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
