<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationRequest;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        $educations = Education::orderBy('order')->orderByDesc('start_date')->get();
        return view('admin.educations.index', compact('educations'));
    }

    public function create(): View
    {
        $education = new Education();
        return view('admin.educations.create', compact('education'));
    }

    public function store(EducationRequest $request): RedirectResponse
    {
        Education::create($request->validated());
        return redirect()->route('admin.educations.index')->with('success', 'Education created successfully.');
    }

    public function edit(Education $education): View
    {
        return view('admin.educations.edit', compact('education'));
    }

    public function update(EducationRequest $request, Education $education): RedirectResponse
    {
        $education->update($request->validated());
        return redirect()->route('admin.educations.index')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();
        return redirect()->route('admin.educations.index')->with('success', 'Education deleted successfully.');
    }
}
