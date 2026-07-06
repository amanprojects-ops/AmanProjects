@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', '<span>Dashboard</span>')

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-gauge-high"></i></span>
        Dashboard
    </h1>
    <span style="font-size:12px;color:#94a3b8;">
        <i class="fa-regular fa-clock"></i>
        {{ now()->format('D, d M Y') }}
    </span>
</div>

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card indigo">
            <div class="stat-icon"><i class="fa-solid fa-diagram-project"></i></div>
            <div class="stat-label">Total Projects</div>
            <div class="stat-value">{{ $stats['projects'] }}</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card violet">
            <div class="stat-icon"><i class="fa-solid fa-newspaper"></i></div>
            <div class="stat-label">Blog Posts</div>
            <div class="stat-value">{{ $stats['posts'] }}</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card rose">
            <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
            <div class="stat-label">Unread Messages</div>
            <div class="stat-value">{{ $stats['contacts'] }}</div>
        </div>
    </div>
</div>

{{-- Recent Messages --}}
<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fa-solid fa-inbox me-2" style="color:#6366f1;"></i> Recent Messages</h2>
        <a href="{{ route('admin.contacts.index') }}" class="btn-admin-view" style="font-size:12px;">
            View All <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
    <div>
        @forelse($recentContacts as $contact)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;font-weight:700;flex-shrink:0;">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div>
                        <p style="margin:0;font-size:14px;font-weight:{{ !$contact->read ? '700' : '500' }};color:{{ !$contact->read ? '#1e293b' : '#334155' }};">
                            {{ $contact->name }}
                            @if(!$contact->read)
                                <span class="status-badge active ms-2" style="font-size:10px;">New</span>
                            @endif
                        </p>
                        <p style="margin:0;font-size:12.5px;color:#94a3b8;">{{ $contact->subject }}</p>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="font-size:11.5px;color:#94a3b8;">{{ $contact->created_at->diffForHumans() }}</span>
                    <a href="{{ route('admin.contacts.show', $contact) }}" class="btn-admin-view">
                        <i class="fa-solid fa-eye"></i> View
                    </a>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fa-regular fa-envelope"></i>
                <p>No messages yet. You're all caught up!</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
