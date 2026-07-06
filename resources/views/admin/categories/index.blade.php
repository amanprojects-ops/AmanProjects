@extends('layouts.admin')

@section('title', 'Categories')
@section('page_title', '<span>Categories</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-folder-open"></i></span>
        Categories
    </h1>
    <a href="{{ route('admin.categories.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Category
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Posts</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td style="font-weight:600;color:#1e293b;">{{ $category->name }}</td>
                        <td>
                            <code style="background:#f1f5f9;padding:3px 8px;border-radius:6px;font-size:12.5px;color:#6366f1;">{{ $category->slug }}</code>
                        </td>
                        <td>
                            <span style="background:#ede9fe;color:#6d28d9;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:700;">{{ $category->posts_count }}</span>
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
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
                                <i class="fa-solid fa-folder-open"></i>
                                <p>No categories found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
