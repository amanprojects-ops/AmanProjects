@extends('layouts.admin')

@section('title', 'Projects')
@section('page_title', '<span>Projects</span>')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 pt-2">
    <h4 class="mb-0 text-dark fw-bold" style="display: flex; align-items: center; gap: 10px;">
        <span class="title-icon" style="display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; background:#e0e7ff; color:#4f46e5; border-radius:8px; font-size:16px;"><i class="fa-solid fa-diagram-project"></i></span>
        Projects
    </h4>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-rounded shadow-2-strong" data-mdb-ripple-init>
        <i class="fa-solid fa-plus"></i> Add Project
    </a>
</div>

<div class="card shadow-4-strong rounded-4 overflow-hidden">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:12px;">
                                @if($project->thumbnail_image)
                                    <img src="@fileUrl($project->thumbnail_image)" alt="{{ $project->title }}" style="width:42px;height:42px;border-radius:10px;object-fit:cover;border:2px solid #e2e8f0;">
                                @else
                                    <div style="width:42px;height:42px;border-radius:10px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;">
                                        <i class="fa-solid fa-diagram-project"></i>
                                    </div>
                                @endif
                                <span style="font-weight:600;color:#1e293b;">{{ $project->title }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $project->status === 'published' ? 'published' : 'draft' }}">
                                <i class="fa-solid fa-circle" style="font-size:6px;"></i>
                                {{ ucfirst($project->status) }}
                            </span>
                        </td>
                        <td>
                            @if($project->featured)
                                <span class="status-badge active"><i class="fa-solid fa-star" style="font-size:9px;"></i> Featured</span>
                            @else
                                <span style="color:#94a3b8;font-size:13px;">—</span>
                            @endif
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-link btn-rounded btn-sm text-primary px-3 shadow-0" data-mdb-ripple-init>
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-rounded btn-sm text-danger px-3 shadow-0" data-mdb-ripple-init>
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
                                <i class="fa-solid fa-diagram-project"></i>
                                <p>No projects yet. Showcase your work!</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
