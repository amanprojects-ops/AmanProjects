@extends('layouts.admin')

@section('title', 'Why Choose Us')
@section('page_title', '<span>Why Choose Us</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-question-circle"></i></span>
        Why Choose Us
    </h1>
    <a href="{{ route('admin.why-choose-uses.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Benefit
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:80px;">Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($whyChooseUses as $benefit)
                    <tr>
                        <td>
                            @if($benefit->icon)
                                <div style="width:36px;height:36px;background:#e0e7ff;color:#4f46e5;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:16px;">
                                    <i class="{{ $benefit->icon }}"></i>
                                </div>
                            @else
                                <span style="color:#cbd5e1;font-size:12px;">—</span>
                            @endif
                        </td>
                        <td>
                            <span style="font-weight:600;color:#1e293b;">{{ $benefit->title }}</span>
                            @if($benefit->color)
                                <code style="background:#f8fafc;border:1px solid #e2e8f0;padding:2px 6px;border-radius:4px;font-size:11.5px;color:#475569;margin-left:6px;">{{ $benefit->color }}</code>
                            @endif
                        </td>
                        <td style="color:#64748b;max-width:400px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $benefit->desc }}">
                            {{ $benefit->desc ?? '—' }}
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.why-choose-uses.edit', $benefit) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.why-choose-uses.destroy', $benefit) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this benefit?')">
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
                                <i class="fa-solid fa-question-circle"></i>
                                <p>No benefits found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
