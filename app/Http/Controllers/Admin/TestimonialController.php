<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use App\Traits\HandlesFileUploads;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TestimonialController extends Controller
{
    use HandlesFileUploads;

    public function index(): View
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        $testimonial = new Testimonial();
        return view('admin.testimonials.create', compact('testimonial'));
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            try {
                $data['avatar'] = $this->uploadFile(
                    $request->file('avatar'),
                    'testimonials'
                );
            } catch (\Exception $e) {
                return back()->withErrors(['avatar' => $e->getMessage()])->withInput();
            }
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            try {
                $data['avatar'] = $this->uploadFile(
                    $request->file('avatar'),
                    'testimonials',
                    $testimonial->avatar
                );
            } catch (\Exception $e) {
                return back()->withErrors(['avatar' => $e->getMessage()])->withInput();
            }
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->avatar && str_starts_with($testimonial->avatar, 'uploads/')) {
            $this->deleteFile($testimonial->avatar);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
