@extends('layouts.admin')

@section('title', 'Pricing Plans')
@section('page_title', '<span>Pricing Plans</span>')

@section('content')
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-money-bill"></i></span>
        Pricing Plans
    </h1>
    <a href="{{ route('admin.plans.create') }}" class="btn-admin-primary">
        <i class="fa-solid fa-plus"></i> Add Plan
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Billing Period</th>
                    <th>Featured</th>
                    <th>Features Count</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans as $plan)
                    <tr>
                        <td>
                            <span style="font-weight:600;color:#1e293b;">{{ $plan->name }}</span>
                            @if($plan->color)
                                <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:{{ $plan->color }};margin-left:6px;" title="Theme Color: {{ $plan->color }}"></span>
                            @endif
                        </td>
                        <td style="font-weight:700;color:#0f172a;">{{ $plan->price }}</td>
                        <td>
                            @if($plan->period)
                                <code style="background:#f1f5f9;padding:3px 8px;border-radius:6px;font-size:12.5px;color:#475569;">/ {{ $plan->period }}</code>
                            @else
                                <span style="color:#cbd5e1;font-size:12px;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($plan->featured)
                                <span class="status-badge published"><i class="fa-solid fa-star me-1" style="font-size:10px;"></i> Featured</span>
                            @else
                                <span class="status-badge inactive">No</span>
                            @endif
                        </td>
                        <td>
                            <span style="background:#ede9fe;color:#6d28d9;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:700;">
                                {{ is_array($plan->features) ? count($plan->features) : 0 }}
                            </span>
                        </td>
                        <td style="text-align:right;white-space:nowrap;">
                            <div style="display:inline-flex;gap:6px;">
                                <a href="{{ route('admin.plans.edit', $plan) }}" class="btn-admin-edit">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this pricing plan?')">
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
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fa-solid fa-money-bill"></i>
                                <p>No plans found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
