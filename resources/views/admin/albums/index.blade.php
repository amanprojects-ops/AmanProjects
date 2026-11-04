@extends('layouts.admin')

@section('title', 'Albums')
@section('page_title', '<span>Albums</span>')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 pt-2">
    <h4 class="mb-0 text-dark fw-bold" style="display: flex; align-items: center; gap: 10px;">
        <span class="title-icon" style="display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; background:#e0e7ff; color:#4f46e5; border-radius:8px; font-size:16px;"><i class="fa-solid fa-images"></i></span>
        Albums
    </h4>
    <a href="{{ route('admin.albums.create') }}" class="btn btn-primary btn-rounded shadow-2-strong" data-mdb-ripple-init>
        <i class="fa-solid fa-plus"></i> Add Album
    </a>
</div>

<div class="card shadow-4-strong rounded-4 overflow-hidden">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Project</th>
                    <th>Album Name</th>
                    <th>Images Count</th>
                    <th>Status</th>
                    <th>Sort Order</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($albums as $album)
                    <tr>
                        <td style="font-weight:600;color:#1e293b;">{{ $album->project->title }}</td>
                        <td style="color:#6366f1;font-weight:500;">{{ $album->name }}</td>
                        <td>
                            <span style="display:inline-flex;align-items:center;gap:6px;background:#e0e7ff;padding:4px 10px;border-radius:20px;font-size:12px;color:#4f46e5;font-weight:600;">
                                <i class="fa-regular fa-image"></i>
                                {{ $album->images_count }} images
                            </span>
                        </td>
                        <td>
                            @if($album->is_active)
                                <span style="display:inline-flex;align-items:center;gap:6px;background:#dcfce7;padding:4px 10px;border-radius:20px;font-size:12px;color:#166534;font-weight:600;">
                                    Active
                                </span>
                            @else
                                <span style="display:inline-flex;align-items:center;gap:6px;background:#fee2e2;padding:4px 10px;border-radius:20px;font-size:12px;color:#991b1b;font-weight:600;">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td>{{ $album->sort_order }}</td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.albums.edit', $album) }}" class="btn btn-link btn-rounded btn-sm text-primary px-3 shadow-0" data-mdb-ripple-init>
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.albums.destroy', $album) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this album and all its images?')">
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
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-images"></i>
                                <p>No album entries yet.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
