@extends('layouts.admin')

@section('title', 'Leads & Opportunities')

@section('content')
<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h1 class="h4 mb-1 text-dark fw-bold">🎯 Business Leads &amp; Digital Opportunities</h1>
            <p class="text-muted small mb-0">Manage verified prospects captured from LeadHarvest and convert them into active client projects.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-indigo-subtle text-indigo px-3 py-2 rounded-pill fw-semibold">
                <i class="fa-solid fa-cloud-arrow-down me-1"></i> Extension API Active
            </span>
            <a href="{{ route('admin.api-tokens.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; font-weight: 600;">
                <i class="fa-solid fa-key me-1"></i> API Tokens
            </a>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card indigo">
                <div class="stat-icon"><i class="fa-solid fa-bullseye"></i></div>
                <div class="stat-label">Total Leads</div>
                <div class="stat-value">{{ number_format($stats['total']) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card violet">
                <div class="stat-icon"><i class="fa-solid fa-sparkles"></i></div>
                <div class="stat-label">New Prospects</div>
                <div class="stat-value">{{ number_format($stats['new']) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card teal">
                <div class="stat-icon"><i class="fa-solid fa-chart-pie"></i></div>
                <div class="stat-label">Audited / Scored</div>
                <div class="stat-value">{{ number_format($stats['analyzed']) }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card rose">
                <div class="stat-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                <div class="stat-label">Proposals</div>
                <div class="stat-value">{{ number_format($stats['proposals']) }}</div>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form method="GET" action="{{ route('admin.leads.index') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search by business name, phone, email, or category..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                        <option value="analyzed" {{ request('status') === 'analyzed' ? 'selected' : '' }}>Analyzed</option>
                        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="proposal_sent" {{ request('status') === 'proposal_sent' ? 'selected' : '' }}>Proposal Sent</option>
                        <option value="won" {{ request('status') === 'won' ? 'selected' : '' }}>Won</option>
                        <option value="lost" {{ request('status') === 'lost' ? 'selected' : '' }}>Lost</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <button type="submit" class="btn btn-primary w-100" style="background: var(--accent); border-color: var(--accent);">
                        <i class="fa-solid fa-filter me-1"></i> Filter
                    </button>
                </div>
                @if(request()->hasAny(['search', 'status']))
                <div class="col-12 col-md-2">
                    <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Leads Table Card --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h3><i class="fa-solid fa-list me-2 text-primary"></i>Prospects List</h3>
            <span class="text-muted small">Showing {{ $leads->firstItem() ?? 0 }} to {{ $leads->lastItem() ?? 0 }} of {{ $leads->total() }}</span>
        </div>
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Business Profile</th>
                        <th>Contact Points</th>
                        <th>Rating / Reviews</th>
                        <th>Digital Opportunity</th>
                        <th>Status</th>
                        <th>Captured</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $lead->business_name }}</div>
                            <div class="small text-muted">
                                @if($lead->category)
                                    <span class="badge bg-light text-dark me-1"><i class="fa-solid fa-tag me-1"></i>{{ $lead->category }}</span>
                                @endif
                                @if($lead->website)
                                    <a href="{{ $lead->website }}" target="_blank" class="text-decoration-none text-primary small">
                                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>{{ Str::limit($lead->normalized_domain ?: $lead->website, 25) }}
                                    </a>
                                @else
                                    <span class="badge bg-danger-subtle text-danger small"><i class="fa-solid fa-circle-exclamation me-1"></i>No Website</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                @if($lead->primary_phone)
                                    <div><i class="fa-solid fa-phone me-1 text-muted"></i>{{ $lead->primary_phone }}</div>
                                @endif
                                @if($lead->primary_email)
                                    <div><i class="fa-solid fa-envelope me-1 text-muted"></i>{{ $lead->primary_email }}</div>
                                @endif
                                @if(!$lead->primary_phone && !$lead->primary_email)
                                    <span class="text-muted fst-italic">No contact saved</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($lead->rating > 0)
                                <div class="d-flex align-items-center gap-1">
                                    <span class="text-warning"><i class="fa-solid fa-star"></i></span>
                                    <span class="fw-bold">{{ number_format($lead->rating, 1) }}</span>
                                    <span class="text-muted small">({{ $lead->review_count }})</span>
                                </div>
                            @else
                                <span class="text-muted small">No reviews</span>
                            @endif
                        </td>
                        <td>
                            @if($lead->latestAnalysis)
                                @php
                                    $score = $lead->latestAnalysis->overall_score;
                                    $badgeClass = $score >= 70 ? 'bg-danger-subtle text-danger' : ($score >= 40 ? 'bg-warning-subtle text-warning-emphasis' : 'bg-success-subtle text-success');
                                @endphp
                                <span class="badge {{ $badgeClass }} px-2 py-1">
                                    <i class="fa-solid fa-gauge me-1"></i>Score: {{ $score }}/100
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary small">Not Audited</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge {{ $lead->status === 'new' ? 'draft' : ($lead->status === 'won' ? 'published' : 'active') }}">
                                {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                            </span>
                        </td>
                        <td>
                            <span class="small text-muted">{{ $lead->created_at->format('M d, Y') }}</span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <a href="{{ route('admin.leads.show', $lead->id) }}" class="btn-admin-edit" title="View Dossier & Proposals">
                                    <i class="fa-solid fa-eye me-1"></i> Dossier
                                </a>
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Archive this lead?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;" title="Archive Lead">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fa-solid fa-crosshairs"></i>
                                <h5>No Leads Found</h5>
                                <p class="text-muted small">Capture prospects using the LeadHarvest Chrome Extension or adjust your filters.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($leads->hasPages())
        <div class="p-3 border-top d-flex justify-content-end">
            {{ $leads->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
