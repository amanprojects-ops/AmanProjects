<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatRequest;
use App\Models\Stat;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StatController extends Controller
{
    public function index(): View
    {
        $stats = Stat::all();
        return view('admin.stats.index', compact('stats'));
    }

    public function create(): View
    {
        $stat = new Stat();
        return view('admin.stats.create', compact('stat'));
    }

    public function store(StatRequest $request): RedirectResponse
    {
        Stat::create($request->validated());
        return redirect()->route('admin.stats.index')->with('success', 'Stat created successfully.');
    }

    public function edit(Stat $stat): View
    {
        return view('admin.stats.edit', compact('stat'));
    }

    public function update(StatRequest $request, Stat $stat): RedirectResponse
    {
        $stat->update($request->validated());
        return redirect()->route('admin.stats.index')->with('success', 'Stat updated successfully.');
    }

    public function destroy(Stat $stat): RedirectResponse
    {
        $stat->delete();
        return redirect()->route('admin.stats.index')->with('success', 'Stat deleted successfully.');
    }
}
