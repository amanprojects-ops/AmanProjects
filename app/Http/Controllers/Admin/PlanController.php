<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanRequest;
use App\Models\Plan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PlanController extends Controller
{
    public function index(): View
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create(): View
    {
        $plan = new Plan();
        return view('admin.plans.create', compact('plan'));
    }

    public function store(PlanRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['features'] = $request->filled('features')
            ? array_values(array_filter(array_map('trim', explode("\n", $request->features))))
            : [];
        
        Plan::create($data);
        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(Plan $plan): View
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(PlanRequest $request, Plan $plan): RedirectResponse
    {
        $data = $request->validated();
        $data['features'] = $request->filled('features')
            ? array_values(array_filter(array_map('trim', explode("\n", $request->features))))
            : [];

        $plan->update($data);
        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan): RedirectResponse
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
    }
}
