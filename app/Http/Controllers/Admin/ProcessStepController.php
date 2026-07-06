<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProcessStepRequest;
use App\Models\ProcessStep;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProcessStepController extends Controller
{
    public function index(): View
    {
        $processSteps = ProcessStep::all();
        return view('admin.process-steps.index', compact('processSteps'));
    }

    public function create(): View
    {
        $processStep = new ProcessStep();
        return view('admin.process-steps.create', compact('processStep'));
    }

    public function store(ProcessStepRequest $request): RedirectResponse
    {
        ProcessStep::create($request->validated());
        return redirect()->route('admin.process-steps.index')->with('success', 'Process step created successfully.');
    }

    public function edit(ProcessStep $processStep): View
    {
        return view('admin.process-steps.edit', compact('processStep'));
    }

    public function update(ProcessStepRequest $request, ProcessStep $processStep): RedirectResponse
    {
        $processStep->update($request->validated());
        return redirect()->route('admin.process-steps.index')->with('success', 'Process step updated successfully.');
    }

    public function destroy(ProcessStep $processStep): RedirectResponse
    {
        $processStep->delete();
        return redirect()->route('admin.process-steps.index')->with('success', 'Process step deleted successfully.');
    }
}
