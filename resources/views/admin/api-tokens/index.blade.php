@extends('layouts.admin')

@section('title', 'API Tokens & Extension Connect')

@section('content')
<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h1 class="h4 mb-1 text-dark fw-bold">🔑 API Access Tokens</h1>
            <p class="text-muted small mb-0">Generate and manage secure personal access tokens to connect LeadHarvest Chrome Extension with AmanProjects CRM.</p>
        </div>
        <div>
            <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Leads
            </a>
        </div>
    </div>

    {{-- Generated Token Alert Banner (Shown Once Upon Creation) --}}
    @if(session('generated_token'))
    <div class="alert alert-success border-success shadow-sm mb-4 p-4" style="border-radius: 12px; background: #ecfdf5;">
        <div class="d-flex align-items-center gap-2 mb-2">
            <i class="fa-solid fa-circle-check text-success fs-5"></i>
            <strong class="text-success fs-6">API Token Generated Successfully!</strong>
        </div>
        <p class="text-muted small mb-3">
            Please copy this token now and paste it into the <strong>LeadHarvest Chrome Extension</strong> settings. For security reasons, this token will not be displayed again.
        </p>
        <div class="input-group">
            <input type="text" id="plainTextTokenInput" class="form-control font-monospace fw-bold bg-white" value="{{ session('generated_token') }}" readonly>
            <button class="btn btn-success px-4" type="button" onclick="copyToken()">
                <i class="fa-solid fa-copy me-1"></i> <span id="copyBtnText">Copy Token</span>
            </button>
        </div>
    </div>
    @endif

    <div class="row g-4">

        {{-- Left: Connection Settings & Quick Setup --}}
        <div class="col-12 col-lg-5">

            {{-- Endpoint URL Card --}}
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h3><i class="fa-solid fa-link me-2 text-primary"></i>Extension Connection URL</h3>
                </div>
                <div class="admin-card-body p-3">
                    <p class="small text-muted mb-2">Enter this API Endpoint URL in your LeadHarvest extension popup settings:</p>
                    <div class="input-group mb-3">
                        <input type="text" id="apiUrlInput" class="form-control form-control-sm font-monospace bg-light" value="{{ $apiUrl }}" readonly>
                        <button class="btn btn-outline-primary btn-sm" type="button" onclick="copyApiUrl()">
                            <i class="fa-solid fa-copy"></i> Copy
                        </button>
                    </div>

                    <div class="border rounded p-3 bg-light">
                        <h6 class="fw-bold small text-dark mb-2"><i class="fa-solid fa-circle-info me-1 text-primary"></i>Quick Setup Guide:</h6>
                        <ol class="small text-muted ps-3 mb-0" style="line-height: 1.6;">
                            <li>Copy the <strong>Endpoint URL</strong> above.</li>
                            <li>Generate a new token using the form on the right.</li>
                            <li>Open <strong>LeadHarvest</strong> in Chrome &rarr; Paste both values in the <strong>AmanProjects CRM</strong> card.</li>
                            <li>Click <strong>Test Connection</strong> &rarr; Start syncing leads with 1-click!</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Token Generator Card --}}
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3><i class="fa-solid fa-plus-circle me-2 text-primary"></i>Create New API Token</h3>
                </div>
                <div class="admin-card-body p-3">
                    <form action="{{ route('admin.api-tokens.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small text-muted">Token Name / Device Description</label>
                            <input type="text" name="token_name" class="form-control" placeholder="e.g. LeadHarvest Chrome Extension (Office PC)" value="LeadHarvest Chrome Extension">
                            <div class="form-text small">Helps you identify which browser or machine is using this token.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted d-block">Pre-Configured Scopes &amp; Abilities</label>
                            <span class="badge bg-light text-dark me-1"><i class="fa-solid fa-check text-success me-1"></i>leads:sync</span>
                            <span class="badge bg-light text-dark me-1"><i class="fa-solid fa-check text-success me-1"></i>leads:validate</span>
                            <span class="badge bg-light text-dark"><i class="fa-solid fa-check text-success me-1"></i>leads:read</span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" style="background: var(--accent); border-color: var(--accent); font-weight: 600;">
                            <i class="fa-solid fa-key me-1"></i> Generate API Token
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- Right: Active Tokens Table --}}
        <div class="col-12 col-lg-7">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3><i class="fa-solid fa-shield-halved me-2 text-primary"></i>Active Access Tokens</h3>
                    <span class="badge bg-secondary-subtle text-secondary">{{ $tokens->count() }} active</span>
                </div>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Token Device / Name</th>
                                <th>Abilities</th>
                                <th>Last Used</th>
                                <th>Created</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tokens as $t)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $t->name }}</div>
                                    <div class="font-monospace small text-muted">ID: {{ $t->id }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-indigo-subtle text-indigo small">
                                        {{ is_array($t->abilities) ? implode(', ', $t->abilities) : 'leads:*' }}
                                    </span>
                                </td>
                                <td>
                                    @if($t->last_used_at)
                                        <span class="small text-dark">{{ $t->last_used_at->diffForHumans() }}</span>
                                    @else
                                        <span class="small text-muted fst-italic">Never used</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="small text-muted">{{ $t->created_at->format('M d, Y') }}</span>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('admin.api-tokens.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Revoke this API token? Any extension using it will lose access.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;" title="Revoke Token">
                                            <i class="fa-solid fa-trash me-1"></i> Revoke
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state py-4 text-center">
                                        <i class="fa-solid fa-key fa-2x text-muted opacity-50 mb-2"></i>
                                        <h6 class="text-dark">No Active Tokens</h6>
                                        <p class="text-muted small mb-0">Generate a token using the form to connect the LeadHarvest extension.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script>
function copyToken() {
    const input = document.getElementById('plainTextTokenInput');
    const text = document.getElementById('copyBtnText');
    if (!input) return;
    input.select();
    input.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(input.value);
    text.textContent = 'Copied! ✓';
    setTimeout(() => text.textContent = 'Copy Token', 2000);
}

function copyApiUrl() {
    const input = document.getElementById('apiUrlInput');
    if (!input) return;
    input.select();
    input.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(input.value);
    alert('API URL copied to clipboard: ' + input.value);
}
</script>
@endpush
@endsection
