@extends('layouts.admin')

@section('title', $lead->business_name . ' — Dossier')

@section('content')
<div class="container-fluid px-0">

    {{-- Breadcrumb & Back --}}
    <a href="{{ route('admin.leads.index') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Back to Leads List
    </a>

    {{-- Dossier Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <h1 class="h3 mb-0 text-dark fw-bold">{{ $lead->business_name }}</h1>
                <span class="status-badge {{ $lead->status === 'new' ? 'draft' : ($lead->status === 'won' ? 'published' : 'active') }}">
                    {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                </span>
            </div>
            <p class="text-muted small mb-0">
                <i class="fa-solid fa-tag me-1"></i>{{ $lead->category ?? 'General Business' }} &bull;
                <i class="fa-solid fa-clock me-1"></i>Captured on {{ $lead->created_at->format('M d, Y h:i A') }}
                @if($lead->provenance_source)
                    &bull; Source: <span class="badge bg-light text-secondary">{{ $lead->provenance_source }}</span>
                @endif
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <form action="{{ route('admin.leads.analyze', $lead->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary shadow-sm" style="background: var(--accent); border-color: var(--accent);">
                    <i class="fa-solid fa-bolt me-1"></i> Run Digital Audit
                </button>
            </form>
            <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Archive this lead?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fa-solid fa-box-archive me-1"></i> Archive
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">

        {{-- Left Column: Business & Contact Information --}}
        <div class="col-12 col-lg-5">

            {{-- Core Profile Card --}}
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h3><i class="fa-solid fa-building me-2 text-primary"></i>Business Profile</h3>
                </div>
                <div class="admin-card-body p-3">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between px-0 py-2">
                            <span class="text-muted">Website:</span>
                            @if($lead->website)
                                <a href="{{ $lead->website }}" target="_blank" class="text-primary text-decoration-none fw-semibold">
                                    {{ $lead->website }} <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                                </a>
                            @else
                                <span class="badge bg-danger-subtle text-danger">None (Opportunity)</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-2">
                            <span class="text-muted">Primary Phone:</span>
                            <span class="fw-semibold">{{ $lead->primary_phone ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-2">
                            <span class="text-muted">Primary Email:</span>
                            <span class="fw-semibold">{{ $lead->primary_email ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-2">
                            <span class="text-muted">Google Rating:</span>
                            <span>
                                @if($lead->rating > 0)
                                    <span class="text-warning"><i class="fa-solid fa-star me-1"></i>{{ number_format($lead->rating, 1) }}</span>
                                    <span class="text-muted">({{ $lead->review_count }} reviews)</span>
                                @else
                                    <span class="text-muted">No reviews recorded</span>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 py-2">
                            <span class="text-muted">Google Place ID:</span>
                            <span class="font-monospace small text-muted">{{ Str::limit($lead->google_place_id ?? 'N/A', 20) }}</span>
                        </li>
                        @if($lead->address)
                        <li class="list-group-item px-0 py-2">
                            <span class="text-muted d-block mb-1">Physical Address:</span>
                            <div class="text-dark">{{ $lead->address }}</div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- Verified Contact Channels --}}
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h3><i class="fa-solid fa-address-book me-2 text-primary"></i>Verified Contacts</h3>
                    <span class="badge bg-secondary-subtle text-secondary">{{ $lead->contacts->count() }} records</span>
                </div>
                <div class="admin-card-body p-3">
                    @forelse($lead->contacts as $contact)
                    <div class="d-flex align-items-center justify-content-between py-2 border-bottom last-border-0">
                        <div>
                            <span class="badge bg-light text-dark text-uppercase me-2">{{ $contact->type }}</span>
                            <span class="fw-semibold small">{{ $contact->value }}</span>
                        </div>
                        <div>
                            @if($contact->is_offline_valid)
                                <span class="badge bg-success-subtle text-success small" title="Syntax format verified">
                                    <i class="fa-solid fa-check me-1"></i>Format OK
                                </span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-3 small">No extra contact records verified.</div>
                    @endforelse
                </div>
            </div>

            {{-- Connected Social Profiles --}}
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3><i class="fa-solid fa-share-nodes me-2 text-primary"></i>Social Presence</h3>
                </div>
                <div class="admin-card-body p-3">
                    @forelse($lead->socialProfiles as $sp)
                    <div class="d-flex align-items-center justify-content-between py-2 border-bottom last-border-0">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-light text-dark text-capitalize">{{ $sp->platform }}</span>
                            <a href="{{ $sp->profile_url }}" target="_blank" class="small text-primary text-decoration-none">
                                {{ Str::limit($sp->profile_url, 35) }}
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-3 small">No connected social profiles detected.</div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Right Column: Opportunity Analysis & Proposal Generation --}}
        <div class="col-12 col-lg-7">

            {{-- Digital Opportunity Scorecard --}}
            @php $analysis = $lead->latestAnalysis; @endphp
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h3><i class="fa-solid fa-gauge-high me-2 text-primary"></i>Digital Opportunity Scorecard</h3>
                    @if($analysis)
                        <span class="badge bg-primary px-3 py-1">Score: {{ $analysis->overall_score }}/100</span>
                    @endif
                </div>
                <div class="admin-card-body p-4">
                    @if($analysis)
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-3 text-center p-2 rounded bg-light">
                                <div class="text-muted small mb-1">Web Need</div>
                                <div class="h5 mb-0 fw-bold text-danger">{{ $analysis->web_score }}%</div>
                            </div>
                            <div class="col-6 col-md-3 text-center p-2 rounded bg-light">
                                <div class="text-muted small mb-1">Mobile App Fit</div>
                                <div class="h5 mb-0 fw-bold text-primary">{{ $analysis->mobile_score }}%</div>
                            </div>
                            <div class="col-6 col-md-3 text-center p-2 rounded bg-light">
                                <div class="text-muted small mb-1">SEO Need</div>
                                <div class="h5 mb-0 fw-bold text-warning-emphasis">{{ $analysis->seo_score }}%</div>
                            </div>
                            <div class="col-6 col-md-3 text-center p-2 rounded bg-light">
                                <div class="text-muted small mb-1">Brand Need</div>
                                <div class="h5 mb-0 fw-bold text-info">{{ $analysis->reputation_score }}%</div>
                            </div>
                        </div>

                        {{-- Executive Summary --}}
                        @if($analysis->executive_summary)
                        <div class="alert alert-light border small text-dark mb-4">
                            <strong><i class="fa-solid fa-lightbulb text-warning me-1"></i>Assessment:</strong>
                            {{ $analysis->executive_summary }}
                        </div>
                        @endif

                        {{-- Identified Deficits --}}
                        <h6 class="fw-bold text-dark small text-uppercase mb-2">Identified Deficiencies</h6>
                        <div class="mb-4">
                            @forelse($analysis->identified_gaps ?? [] as $gap)
                            <div class="p-2 border rounded mb-2 small d-flex align-items-start gap-2 bg-white">
                                <span class="badge bg-{{ $gap['severity'] === 'critical' ? 'danger' : ($gap['severity'] === 'high' ? 'warning' : 'info') }} mt-1">
                                    {{ ucfirst($gap['severity']) }}
                                </span>
                                <div>
                                    <strong class="text-dark">{{ $gap['title'] ?? $gap['code'] }}</strong>
                                    <div class="text-muted">{{ $gap['description'] }}</div>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted small">No critical deficits detected.</p>
                            @endforelse
                        </div>

                        {{-- Recommended Catalog Services --}}
                        <h6 class="fw-bold text-dark small text-uppercase mb-2">Recommended Catalog Services</h6>
                        <div>
                            @forelse($analysis->recommended_services ?? [] as $rec)
                            <div class="p-3 border rounded mb-2 bg-light d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <div class="fw-bold text-dark">{{ $rec['service_title'] }} &bull; <span class="text-muted">{{ $rec['plan_name'] }}</span></div>
                                    <div class="small text-muted">{{ $rec['rationale'] }}</div>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold text-primary">₹{{ number_format($rec['standard_price']) }}</div>
                                    <span class="badge bg-success-subtle text-success small">DB Verified</span>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted small">No specific catalog service recommended yet.</p>
                            @endforelse
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fa-solid fa-chart-line fa-3x text-muted opacity-50 mb-3"></i>
                            <h6>Audit Pending</h6>
                            <p class="text-muted small mb-3">Click the "Run Digital Audit" button above to evaluate this business's digital gaps and recommend catalog services.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Proposals & Human Approval Gate (Rules 13 & 14) --}}
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h3><i class="fa-solid fa-file-invoice-dollar me-2 text-primary"></i>Client Proposals &amp; Quotations</h3>
                    <span class="badge bg-secondary-subtle text-secondary">{{ $lead->proposals->count() }} drafts</span>
                </div>
                <div class="admin-card-body p-4">

                    {{-- Existing Proposals List --}}
                    @forelse($lead->proposals as $proposal)
                    <div class="border rounded p-3 mb-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <strong class="text-dark">{{ $proposal->proposal_number }}</strong> &bull;
                                <span class="small text-muted">{{ $proposal->title }}</span>
                            </div>
                            <div>
                                @if($proposal->status === 'approved')
                                    <span class="badge bg-success"><i class="fa-solid fa-check-double me-1"></i>Approved</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i>Draft (Pending Approval)</span>
                                @endif
                            </div>
                        </div>

                        {{-- Line Items --}}
                        <div class="small bg-light p-2 rounded mb-2">
                            @foreach($proposal->items as $pItem)
                            <div class="d-flex justify-content-between py-1">
                                <span>{{ $pItem->item_title }} (Qty: {{ $pItem->quantity }})</span>
                                <span class="fw-semibold">₹{{ number_format($pItem->line_total, 2) }}</span>
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-between border-top pt-1 fw-bold text-dark">
                                <span>Total Amount:</span>
                                <span>₹{{ number_format($proposal->total_amount, 2) }}</span>
                            </div>
                        </div>

                        {{-- Human Approval Gatekeeper Action (Rule 14) --}}
                        <div class="d-flex align-items-center justify-content-between mt-2 pt-2 border-top">
                            <span class="small text-muted">
                                @if($proposal->approved_at)
                                    Approved by {{ $proposal->approver?->name ?? 'Admin' }} on {{ $proposal->approved_at->format('M d, Y') }}
                                @else
                                    <span class="text-warning-emphasis"><i class="fa-solid fa-shield-halved me-1"></i>Requires human sign-off</span>
                                @endif
                            </span>

                            <div class="d-flex gap-2">
                                @if(!$proposal->approved_at)
                                <form action="{{ route('admin.leads.proposals.approve', [$lead->id, $proposal->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-check me-1"></i> Approve Proposal
                                    </button>
                                </form>
                                @else
                                <span class="badge bg-light text-secondary small">
                                    Token: {{ Str::limit($proposal->public_view_token, 16) }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-3 small mb-3">No proposal created for this prospect yet.</div>
                    @endforelse

                    {{-- Create / Customize Proposal Form (Rule 13) --}}
                    <div class="border-top pt-3">
                        <h6 class="fw-bold text-dark small text-uppercase mb-3"><i class="fa-solid fa-plus-circle me-1 text-primary"></i>Draft New Quotation</h6>
                        <form action="{{ route('admin.leads.proposals.store', $lead->id) }}" method="POST">
                            @csrf
                            <div class="row g-2 mb-2">
                                <div class="col-12 col-md-8">
                                    <label class="form-label small text-muted mb-1">Proposal Title</label>
                                    <input type="text" name="title" class="form-control form-control-sm" value="Digital Modernization Package — {{ $lead->business_name }}" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label small text-muted mb-1">Currency</label>
                                    <select name="currency" class="form-select form-select-sm">
                                        <option value="INR" selected>INR (₹)</option>
                                        <option value="USD">USD ($)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-12 col-md-6">
                                    <label class="form-label small text-muted mb-1">Select Catalog Service (Rule 13)</label>
                                    <select name="service_id" class="form-select form-select-sm" required>
                                        @foreach($services as $s)
                                            <option value="{{ $s->id }}">{{ $s->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small text-muted mb-1">Tier / Plan</label>
                                    <select name="plan_id" class="form-select form-select-sm">
                                        <option value="">None / Custom</option>
                                        @foreach($plans as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }} (₹{{ $p->price }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-3">
                                    <label class="form-label small text-muted mb-1">Price (₹)</label>
                                    <input type="number" name="unit_price" class="form-control form-control-sm" value="15000" min="0" required>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label small text-muted mb-1">Discount (₹)</label>
                                    <input type="number" name="discount_amount" class="form-control form-control-sm" value="0" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small text-muted mb-1">Tax / GST (₹)</label>
                                    <input type="number" name="tax_amount" class="form-control form-control-sm" value="0" min="0">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary w-100" style="background: var(--accent); border-color: var(--accent);">
                                <i class="fa-solid fa-file-pen me-1"></i> Generate Draft Proposal
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection
