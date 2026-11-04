<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WhyChooseUsRequest;
use App\Models\WhyChooseUs;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WhyChooseUsController extends Controller
{
    public function index(): View
    {
        $whyChooseUses = WhyChooseUs::all();
        return view('admin.why-choose-uses.index', compact('whyChooseUses'));
    }

    public function create(): View
    {
        $whyChooseUs = new WhyChooseUs();
        return view('admin.why-choose-uses.create', compact('whyChooseUs'));
    }

    public function store(WhyChooseUsRequest $request): RedirectResponse
    {
        WhyChooseUs::create($request->validated());
        return redirect()->route('admin.why-choose-uses.index')->with('success', 'Why choose us item created successfully.');
    }

    public function edit(WhyChooseUs $whyChooseUs): View
    {
        return view('admin.why-choose-uses.edit', compact('whyChooseUs'));
    }

    public function update(WhyChooseUsRequest $request, WhyChooseUs $whyChooseUs): RedirectResponse
    {
        $whyChooseUs->update($request->validated());
        return redirect()->route('admin.why-choose-uses.index')->with('success', 'Why choose us item updated successfully.');
    }

    public function destroy(WhyChooseUs $whyChooseUs): RedirectResponse
    {
        $whyChooseUs->delete();
        return redirect()->route('admin.why-choose-uses.index')->with('success', 'Why choose us item deleted successfully.');
    }
}
