@extends('layouts.admin')

@section('title', 'Blog Posts')
@section('page_title', '<span>Blog</span> Posts')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-newspaper"></i></span>
        Blog Posts
    </h1>
    <a href="{{ route('admin.posts.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Post
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Categories</th>
                    <th>Date</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td style="font-weight:600;color:#1e293b;max-width:280px;">{{ $post->title }}</td>
                        <td>
                            <span class="status-badge {{ $post->status === 'published' ? 'published' : 'draft' }}">
                                <i class="fa-solid fa-circle" style="font-size:6px;"></i>
                                {{ ucfirst($post->status) }}
                            </span>
                        </td>
                        <td style="color:#64748b;font-size:13px;">
                            {{ $post->categories->pluck('name')->join(', ') ?: '—' }}
                        </td>
                        <td style="color:#64748b;font-size:13px;white-space:nowrap;">
                            <i class="fa-regular fa-calendar me-1"></i>
                            {{ $post->created_at->format('M d, Y') }}
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?')">
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
                                <i class="fa-solid fa-newspaper"></i>
                                <p>No blog posts yet. Create your first post!</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
