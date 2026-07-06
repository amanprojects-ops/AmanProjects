@extends('layouts.admin')

@section('title', 'Skills')
@section('page_title', '<span>Skills</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-code"></i></span>
        Skills
    </h1>
    <a href="{{ route('admin.skills.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Skill
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Skill Name</th>
                    <th>Category</th>
                    <th>Proficiency</th>
                    <th>Visible</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                    <tr>
                        <td style="font-weight:600;color:#1e293b;">{{ $skill->name }}</td>
                        <td>
                            @if($skill->category)
                                <span style="background:#ede9fe;color:#6d28d9;padding:3px 10px;border-radius:20px;font-size:11.5px;font-weight:600;">{{ $skill->category }}</span>
                            @else
                                <span style="color:#94a3b8;">—</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="skill-bar">
                                    <div class="skill-bar-fill" style="width:{{ $skill->level }}%"></div>
                                </div>
                                <span style="font-size:12.5px;font-weight:700;color:#6366f1;min-width:34px;">{{ $skill->level }}%</span>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge {{ $skill->show ? 'active' : 'inactive' }}">
                                <i class="fa-solid fa-circle" style="font-size:6px;"></i>
                                {{ $skill->show ? 'Visible' : 'Hidden' }}
                            </span>
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this skill?')">
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
                                <i class="fa-solid fa-code"></i>
                                <p>No skills added yet.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
