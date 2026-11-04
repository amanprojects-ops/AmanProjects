<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        $service = new Service();
        return view('admin.services.create', compact('service'));
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        $data = $this->prepareServiceData($request);

        Service::create($data);
        Cache::forget('ap_services');

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $this->prepareServiceData($request);

        $service->update($data);
        Cache::forget('ap_services');

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();
        Cache::forget('ap_services');

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    /**
     * Process and sanitize input data before saving
     */
    protected function prepareServiceData(ServiceRequest $request): array
    {
        $data = $request->validated();

        // Auto-generate or sanitize slug
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        } elseif (!empty($data['slug'])) {
            $data['slug'] = Str::slug($data['slug']);
        }

        // Checkbox status
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        // Features (Newline-delimited string to array)
        if ($request->filled('features')) {
            if (is_string($request->features)) {
                $data['features'] = array_values(array_filter(array_map('trim', explode("\n", $request->features))));
            }
        } else {
            $data['features'] = [];
        }

        // Pricing Tiers (JSON string or array)
        if ($request->filled('pricing_tiers')) {
            if (is_string($request->pricing_tiers)) {
                $decoded = json_decode($request->pricing_tiers, true);
                $data['pricing_tiers'] = json_last_error() === JSON_ERROR_NONE ? $decoded : $request->pricing_tiers;
            }
        }

        // Process Steps (JSON string or array)
        if ($request->filled('process_steps')) {
            if (is_string($request->process_steps)) {
                $decoded = json_decode($request->process_steps, true);
                $data['process_steps'] = json_last_error() === JSON_ERROR_NONE ? $decoded : $request->process_steps;
            }
        }

        // FAQs (JSON string or array)
        if ($request->filled('faqs')) {
            if (is_string($request->faqs)) {
                $decoded = json_decode($request->faqs, true);
                $data['faqs'] = json_last_error() === JSON_ERROR_NONE ? $decoded : $request->faqs;
            }
        }

        return $data;
    }
}
