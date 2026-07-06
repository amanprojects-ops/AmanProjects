@extends('layouts.admin')

@section('title', 'Process Steps')
@section('page_title', '<span>Process Steps</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-list-ol"></i></span>
        Process Steps
    </h1>
    <a href="{{ route('admin.process-steps.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Step
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:100px;">Step / Num</th>
                    <th style="width:80px;">Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($processSteps as $step)
                    <tr>
                        <td>
                            <span style="font-weight:700;color:#6366f1;background:#e0e7ff;padding:4px 10px;border-radius:6px;font-size:13px;">{{ $step->num }}</span>
                        </td>
                        <td>
                            @if($step->icon)
                                <div style="width:36px;height:36px;background:#f1f5f9;color:#475569;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:16px;">
                                    <i class="{{ $step->icon }}"></i>
                                </div>
                            @else
                                <span style="color:#cbd5e1;font-size:12px;">—</span>
                            @endif
                        </td>
                        <td style="font-weight:600;color:#1e293b;">{{ $step->title }}</td>
                        <td style="color:#64748b;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $step->desc }}">
                            {{ $step->desc ?? '—' }}
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.process-steps.edit', $step) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.process-steps.destroy', $step) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this process step?')">
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
                                <i class="fa-solid fa-list-ol"></i>
                                <p>No process steps found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
