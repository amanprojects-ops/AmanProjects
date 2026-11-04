@extends('layouts.admin')

@section('title', 'Contact Messages')
@section('page_title', '<span>Contact</span> Messages')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-envelope"></i></span>
        Messages
    </h1>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr style="{{ !$contact->read ? 'background:#fafaff;' : '' }}">
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:50%;background:{{ !$contact->read ? 'linear-gradient(135deg,#6366f1,#8b5cf6)' : '#f1f5f9' }};display:flex;align-items:center;justify-content:center;color:{{ !$contact->read ? '#fff' : '#64748b' }};font-size:13px;font-weight:700;flex-shrink:0;">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <span style="font-weight:{{ !$contact->read ? '700' : '600' }};color:{{ !$contact->read ? '#6366f1' : '#1e293b' }};">
                                    {{ $contact->name }}
                                    @if(!$contact->read)
                                        <span class="status-badge active ms-1" style="font-size:9px;vertical-align:middle;">New</span>
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td style="font-size:13px;color:#64748b;">{{ $contact->email }}</td>
                        <td style="font-size:13px;color:#334155;max-width:220px;">{{ Str::limit($contact->subject, 40) }}</td>
                        <td style="font-size:12.5px;color:#94a3b8;white-space:nowrap;">
                            <i class="fa-regular fa-clock me-1"></i>
                            {{ $contact->created_at->format('M d, Y') }}
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="btn-admin-view">
                                    <i class="fa-solid fa-eye"></i> View
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?')">
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
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fa-regular fa-envelope"></i>
                                <p>No messages yet. You're all caught up!</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($contacts->hasPages())
    <div style="margin-top:20px;">
        {{ $contacts->links() }}
    </div>
@endif
@endsection
