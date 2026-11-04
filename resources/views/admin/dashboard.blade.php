@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', '<span>Dashboard</span>')

@push('styles')
<style>
/* ══════════════════════════════════════════════════
   DASHBOARD UPGRADE STYLES
   ══════════════════════════════════════════════════ */

/* ── Quick Stats Refresh ── */
.stat-card-wrapper { position: relative; }
.stat-refresh-btn {
    position: absolute; top: 14px; right: 14px;
    width: 32px; height: 32px; border-radius: 8px;
    background: rgba(255,255,255,0.18); border: none;
    color: #fff; font-size: 13px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; z-index: 2; backdrop-filter: blur(4px);
}
.stat-refresh-btn:hover { background: rgba(255,255,255,0.3); transform: rotate(30deg); }
.stat-refresh-btn.spinning i { animation: spinRefresh 0.8s ease; }
@keyframes spinRefresh { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
.stat-last-refresh {
    font-size: 10.5px; opacity: 0.7; margin-top: 8px;
    display: flex; align-items: center; gap: 4px;
}

/* ── Section Titles ── */
.dash-section-title {
    display: flex; align-items: center; gap: 12px;
    margin: 32px 0 18px; padding: 0;
}
.dash-section-title .section-icon {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; color: #fff; flex-shrink: 0;
}
.dash-section-title h2 {
    font-size: 17px; font-weight: 700; color: #0f172a; margin: 0;
}
.dash-section-title .section-badge {
    font-size: 10px; font-weight: 700; padding: 3px 10px;
    border-radius: 20px; text-transform: uppercase; letter-spacing: 0.06em;
}

/* ── Notification Center ── */
.notif-center { margin-bottom: 24px; }
.notif-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 24px; background: #fafbfd;
    border-bottom: 1px solid #f1f5f9;
}
.notif-header-left { display: flex; align-items: center; gap: 10px; }
.notif-header h2 { font-size: 15px; font-weight: 700; color: #1e293b; margin: 0; }
.notif-count {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff; font-size: 10px; font-weight: 700;
    padding: 2px 8px; border-radius: 20px; min-width: 22px;
    text-align: center; line-height: 1.4;
}
.notif-actions { display: flex; gap: 8px; }
.notif-action-btn {
    padding: 5px 12px; border-radius: 8px; border: 1px solid #e2e8f0;
    background: #fff; font-size: 11.5px; font-weight: 600;
    color: #64748b; cursor: pointer; transition: all 0.15s;
}
.notif-action-btn:hover { background: #f1f5f9; color: #1e293b; }
.notif-item {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 16px 24px; border-bottom: 1px solid #f8fafc;
    transition: background 0.15s; position: relative;
}
.notif-item:hover { background: #fafbff; }
.notif-item.unread { background: #faf5ff; }
.notif-item.unread::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0;
    width: 3px; background: var(--accent); border-radius: 0 3px 3px 0;
}
.notif-icon-wrap {
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.notif-icon-wrap.info { background: #dbeafe; color: #2563eb; }
.notif-icon-wrap.success { background: #dcfce7; color: #16a34a; }
.notif-icon-wrap.warning { background: #fef3c7; color: #d97706; }
.notif-icon-wrap.error { background: #fee2e2; color: #dc2626; }
.notif-body { flex: 1; min-width: 0; }
.notif-title { font-size: 13.5px; font-weight: 600; color: #1e293b; margin: 0 0 3px; }
.notif-desc { font-size: 12.5px; color: #64748b; margin: 0; line-height: 1.5; }
.notif-time { font-size: 11px; color: #94a3b8; margin-top: 5px; }
.notif-dismiss {
    width: 28px; height: 28px; border-radius: 6px; border: none;
    background: transparent; color: #94a3b8; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; transition: all 0.15s; flex-shrink: 0;
}
.notif-dismiss:hover { background: #fee2e2; color: #ef4444; }

/* ── Audit Log ── */
.audit-filters {
    display: flex; align-items: center; gap: 8px;
    padding: 0; flex-wrap: wrap;
}
.audit-filter-btn {
    padding: 5px 14px; border-radius: 20px; border: 1px solid #e2e8f0;
    background: #fff; font-size: 11.5px; font-weight: 600;
    color: #64748b; cursor: pointer; transition: all 0.15s;
}
.audit-filter-btn:hover { border-color: var(--accent); color: var(--accent); }
.audit-filter-btn.active {
    background: var(--accent); color: #fff;
    border-color: var(--accent); box-shadow: 0 2px 8px var(--accent-glow);
}
.audit-item {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 24px; border-bottom: 1px solid #f8fafc;
    transition: background 0.15s;
}
.audit-item:hover { background: #fafbff; }
.audit-item:last-child { border-bottom: none; }
.audit-avatar {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; flex-shrink: 0; color: #fff; font-weight: 700;
}
.audit-avatar.create { background: linear-gradient(135deg, #22c55e, #16a34a); }
.audit-avatar.update { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.audit-avatar.delete { background: linear-gradient(135deg, #ef4444, #dc2626); }
.audit-avatar.login { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.audit-content { flex: 1; min-width: 0; }
.audit-action { font-size: 13.5px; font-weight: 500; color: #334155; margin: 0; }
.audit-action strong { font-weight: 700; color: #1e293b; }
.audit-meta { font-size: 11.5px; color: #94a3b8; margin: 3px 0 0; }
.audit-type-badge {
    font-size: 10px; font-weight: 700; padding: 3px 10px;
    border-radius: 20px; text-transform: uppercase; letter-spacing: 0.04em;
}
.audit-type-badge.create { background: #dcfce7; color: #166534; }
.audit-type-badge.update { background: #dbeafe; color: #1e40af; }
.audit-type-badge.delete { background: #fee2e2; color: #991b1b; }
.audit-type-badge.login { background: #ede9fe; color: #5b21b6; }

/* ── Login History ── */
.login-item {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 24px; border-bottom: 1px solid #f8fafc;
    transition: background 0.15s;
}
.login-item:hover { background: #fafbff; }
.login-item:last-child { border-bottom: none; }
.login-device-icon {
    width: 40px; height: 40px; border-radius: 10px;
    background: #f1f5f9; display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: #64748b; flex-shrink: 0;
}
.login-info { flex: 1; min-width: 0; }
.login-browser { font-size: 13.5px; font-weight: 600; color: #1e293b; margin: 0; }
.login-details { font-size: 12px; color: #94a3b8; margin: 3px 0 0; }
.login-status {
    font-size: 10px; font-weight: 700; padding: 3px 10px;
    border-radius: 20px; text-transform: uppercase; letter-spacing: 0.04em;
}
.login-status.success { background: #dcfce7; color: #166534; }
.login-status.failed { background: #fee2e2; color: #991b1b; }
.login-current-badge {
    font-size: 9px; font-weight: 700; padding: 2px 8px;
    border-radius: 20px; background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff; text-transform: uppercase; letter-spacing: 0.05em;
    margin-left: 6px; animation: pulseBadge 2s ease-in-out infinite;
}
@keyframes pulseBadge {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}


</style>
@endpush

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

{{-- ═══════════════════════════════════════════════
     STAT CARDS WITH REFRESH
     ═══════════════════════════════════════════════ --}}
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card-wrapper">
            <button class="stat-refresh-btn" onclick="refreshStat(this)" title="Refresh">
                <i class="fa-solid fa-arrows-rotate"></i>
            </button>
            <div class="stat-card indigo">
                <div class="stat-icon"><i class="fa-solid fa-diagram-project"></i></div>
                <div class="stat-label">Total Projects</div>
                <div class="stat-value" id="statProjects">{{ $stats['projects'] }}</div>
                <div class="stat-last-refresh">
                    <i class="fa-regular fa-clock"></i>
                    <span class="refresh-time">Just now</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card-wrapper">
            <button class="stat-refresh-btn" onclick="refreshStat(this)" title="Refresh">
                <i class="fa-solid fa-arrows-rotate"></i>
            </button>
            <div class="stat-card violet">
                <div class="stat-icon"><i class="fa-solid fa-newspaper"></i></div>
                <div class="stat-label">Blog Posts</div>
                <div class="stat-value" id="statPosts">{{ $stats['posts'] }}</div>
                <div class="stat-last-refresh">
                    <i class="fa-regular fa-clock"></i>
                    <span class="refresh-time">Just now</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card-wrapper">
            <button class="stat-refresh-btn" onclick="refreshStat(this)" title="Refresh">
                <i class="fa-solid fa-arrows-rotate"></i>
            </button>
            <div class="stat-card rose">
                <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="stat-label">Unread Messages</div>
                <div class="stat-value" id="statContacts">{{ $stats['contacts'] }}</div>
                <div class="stat-last-refresh">
                    <i class="fa-regular fa-clock"></i>
                    <span class="refresh-time">Just now</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     NOTIFICATION CENTER
     ═══════════════════════════════════════════════ --}}
<div class="admin-card notif-center" id="notifCenter">
    <div class="notif-header">
        <div class="notif-header-left">
            <h2><i class="fa-solid fa-bell me-2" style="color:#f59e0b;"></i> Notification Center</h2>
            <span class="notif-count" id="notifCount">{{ $notifications->count() }}</span>
        </div>
        <div class="notif-actions">
            <button class="notif-action-btn" onclick="markAllRead()">
                <i class="fa-solid fa-check-double me-1"></i> Mark All Read
            </button>
            <button class="notif-action-btn" onclick="clearAllNotifs()">
                <i class="fa-solid fa-trash-can me-1"></i> Clear All
            </button>
        </div>
    </div>
    <div id="notifList">
        @forelse($notifications as $notif)
            <div class="notif-item {{ is_null($notif->read_at) ? 'unread' : '' }}" data-notif-id="{{ $notif->id }}">
                <div class="notif-icon-wrap {{ $notif->data['type'] ?? 'info' }}">
                    <i class="{{ $notif->data['icon'] ?? 'fa-solid fa-bell' }}"></i>
                </div>
                <div class="notif-body">
                    <p class="notif-title">{{ $notif->data['title'] ?? 'Notification' }}</p>
                    <p class="notif-desc">{{ $notif->data['message'] ?? '' }}</p>
                    <div class="notif-time"><i class="fa-regular fa-clock me-1"></i> {{ $notif->created_at->diffForHumans() }}</div>
                </div>
                <button class="notif-dismiss" onclick="dismissNotif(this)" title="Dismiss"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @empty
            <div style="padding:24px;text-align:center;color:#94a3b8;font-size:13px;">
                <i class="fa-regular fa-bell-slash" style="font-size:24px;margin-bottom:10px;display:block;"></i>
                No new notifications
            </div>
        @endforelse
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     RECENT MESSAGES (existing)
     ═══════════════════════════════════════════════ --}}
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

{{-- ═══════════════════════════════════════════════
     ACTIVITY AUDIT LOG & LOGIN HISTORY
     ═══════════════════════════════════════════════ --}}
<div class="row g-4 mt-1">
    {{-- Audit Log --}}
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header" style="flex-wrap:wrap;gap:12px;">
                <h2><i class="fa-solid fa-clock-rotate-left me-2" style="color:#8b5cf6;"></i> Activity Audit Log</h2>
                <div class="audit-filters">
                    <button class="audit-filter-btn active" onclick="filterAudit('all', this)">All</button>
                    <button class="audit-filter-btn" onclick="filterAudit('create', this)">Create</button>
                    <button class="audit-filter-btn" onclick="filterAudit('update', this)">Update</button>
                    <button class="audit-filter-btn" onclick="filterAudit('delete', this)">Delete</button>
                    <button class="audit-filter-btn" onclick="filterAudit('login', this)">Login</button>
                </div>
            </div>
            <div id="auditList">
                @forelse($auditLogs as $log)
                    <div class="audit-item" data-type="{{ strtolower($log->action_type) }}">
                        <div class="audit-avatar {{ strtolower($log->action_type) }}">
                            @if(strtolower($log->action_type) == 'create')
                                <i class="fa-solid fa-plus"></i>
                            @elseif(strtolower($log->action_type) == 'update')
                                <i class="fa-solid fa-pen"></i>
                            @elseif(strtolower($log->action_type) == 'delete')
                                <i class="fa-solid fa-trash"></i>
                            @elseif(strtolower($log->action_type) == 'login')
                                <i class="fa-solid fa-right-to-bracket"></i>
                            @else
                                <i class="fa-solid fa-circle-info"></i>
                            @endif
                        </div>
                        <div class="audit-content">
                            <p class="audit-action"><strong>{{ $log->user ? $log->user->name : 'System' }}</strong> {!! $log->description !!}</p>
                            <p class="audit-meta"><i class="fa-regular fa-clock me-1"></i> {{ $log->created_at->diffForHumans() }} &bull; IP: {{ $log->ip_address ?? 'N/A' }}</p>
                        </div>
                        <span class="audit-type-badge {{ strtolower($log->action_type) }}">{{ ucfirst($log->action_type) }}</span>
                    </div>
                @empty
                    <div style="padding:24px;text-align:center;color:#94a3b8;font-size:13px;">
                        No recent activity found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Login History --}}
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2><i class="fa-solid fa-shield-halved me-2" style="color:#22c55e;"></i> Login History</h2>
            </div>
            <div>
                @forelse($loginHistories as $index => $history)
                    <div class="login-item">
                        <div class="login-device-icon" {!! $history->status == 'failed' ? 'style="background:#fee2e2;color:#ef4444;"' : '' !!}>
                            @if(str_contains(strtolower($history->user_agent), 'mobile') || str_contains(strtolower($history->user_agent), 'android') || str_contains(strtolower($history->user_agent), 'iphone'))
                                <i class="fa-solid fa-mobile-screen"></i>
                            @else
                                <i class="fa-solid fa-desktop"></i>
                            @endif
                        </div>
                        <div class="login-info">
                            <p class="login-browser">
                                {{ \Illuminate\Support\Str::limit($history->user_agent ?? 'Unknown Browser', 45) }}
                                @if($index === 0 && $history->status == 'success')
                                    <span class="login-current-badge">Current</span>
                                @endif
                            </p>
                            <p class="login-details">IP: {{ $history->ip_address ?? 'N/A' }} &bull; {{ $history->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="login-status {{ $history->status == 'success' ? 'success' : 'failed' }}">{{ ucfirst($history->status) }}</span>
                    </div>
                @empty
                    <div style="padding:24px;text-align:center;color:#94a3b8;font-size:13px;">
                        No login history found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
(function() {
    'use strict';

    /* ═══════════════════════════════════════════════
       QUICK STATS REFRESH
       ═══════════════════════════════════════════════ */
    window.refreshStat = function(btn) {
        if (btn.classList.contains('spinning')) return;
        btn.classList.add('spinning');
        var card = btn.closest('.stat-card-wrapper');
        var timeEl = card.querySelector('.refresh-time');
        setTimeout(function() {
            btn.classList.remove('spinning');
            if (timeEl) timeEl.textContent = 'Just now';
        }, 800);
    };

    /* ═══════════════════════════════════════════════
       NOTIFICATION CENTER
       ═══════════════════════════════════════════════ */
    function updateNotifCount() {
        var items = document.querySelectorAll('#notifList .notif-item');
        var unread = document.querySelectorAll('#notifList .notif-item.unread');
        var countEl = document.getElementById('notifCount');
        if (countEl) {
            countEl.textContent = unread.length;
            countEl.style.display = unread.length > 0 ? '' : 'none';
        }
        if (items.length === 0) {
            document.getElementById('notifList').innerHTML =
                '<div class="empty-state"><i class="fa-regular fa-bell-slash"></i><p>No notifications. You\'re all clear!</p></div>';
        }
    }

    window.dismissNotif = function(btn) {
        var item = btn.closest('.notif-item');
        if (item) {
            item.style.transition = 'opacity 0.3s, transform 0.3s';
            item.style.opacity = '0';
            item.style.transform = 'translateX(20px)';
            setTimeout(function() {
                item.remove();
                updateNotifCount();
            }, 300);
        }
    };

    window.markAllRead = function() {
        var items = document.querySelectorAll('#notifList .notif-item.unread');
        items.forEach(function(item) {
            item.classList.remove('unread');
        });
        updateNotifCount();
    };

    window.clearAllNotifs = function() {
        var items = document.querySelectorAll('#notifList .notif-item');
        items.forEach(function(item, i) {
            setTimeout(function() {
                item.style.transition = 'opacity 0.25s, transform 0.25s';
                item.style.opacity = '0';
                item.style.transform = 'translateX(20px)';
                setTimeout(function() { item.remove(); updateNotifCount(); }, 250);
            }, i * 80);
        });
    };

    /* ═══════════════════════════════════════════════
       AUDIT LOG FILTER
       ═══════════════════════════════════════════════ */
    window.filterAudit = function(type, btn) {
        document.querySelectorAll('.audit-filter-btn').forEach(function(b) { b.classList.remove('active'); });
        btn.classList.add('active');
        document.querySelectorAll('#auditList .audit-item').forEach(function(item) {
            if (type === 'all' || item.getAttribute('data-type') === type) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    };
})
</script>
@endpush
