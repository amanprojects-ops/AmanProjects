@extends('layouts.admin')

@section('title', 'View Message')
@section('page_title', '<span>Message</span> Details')

@section('content')

<a href="{{ route('admin.contacts.index') }}" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Messages
</a>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2><i class="fa-solid fa-envelope-open me-2" style="color:#6366f1;"></i> Message</h2>
                @if(!$contact->read)
                    <span class="status-badge active">New</span>
                @endif
            </div>
            <div class="admin-card-body">
                <div style="background:#f8fafc;border-radius:12px;padding:22px;border:1px solid #e2e8f0;font-size:14.5px;color:#334155;line-height:1.8;">
                    {!! nl2br(e($contact->message)) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h2><i class="fa-solid fa-user me-2" style="color:#6366f1;"></i> Sender Info</h2>
            </div>
            <div class="admin-card-body">
                <div style="text-align:center;margin-bottom:18px;">
                    <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-size:24px;font-weight:700;margin:0 auto 12px;">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <p style="font-weight:700;font-size:16px;color:#1e293b;margin:0;">{{ $contact->name }}</p>
                    <a href="mailto:{{ $contact->email }}" style="color:#6366f1;font-size:13px;text-decoration:none;">{{ $contact->email }}</a>
                </div>

                <div style="border-top:1px solid #f1f5f9;padding-top:16px;">
                    <div style="margin-bottom:12px;">
                        <span style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94a3b8;">Subject</span>
                        <p style="font-size:14px;color:#1e293b;font-weight:600;margin:4px 0 0;">{{ $contact->subject }}</p>
                    </div>
                    <div>
                        <span style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#94a3b8;">Received</span>
                        <p style="font-size:14px;color:#475569;margin:4px 0 0;">{{ $contact->created_at->format('F d, Y · H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:10px;">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn-admin-primary" style="justify-content:center;">
                <i class="fa-solid fa-reply"></i> Reply via Email
            </a>
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-admin-danger" style="width:100%;justify-content:center;">
                    <i class="fa-solid fa-trash"></i> Delete Message
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
