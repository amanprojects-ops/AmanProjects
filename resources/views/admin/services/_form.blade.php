<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-server" style="color:#6366f1;"></i> Service Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div>
                <label for="title" class="form-label-custom">Service Title <span style="color:#ef4444;">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $service->title ?? '') }}" required
                    class="form-control-custom" placeholder="e.g., Web Development, SaaS Platform…">
                @error('title')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="desc" class="form-label-custom">Description <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                <textarea name="desc" id="desc" class="form-control-custom" rows="4" placeholder="Describe the service details…">{{ old('desc', $service->desc ?? '') }}</textarea>
                @error('desc')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="color" class="form-label-custom">Theme Gradient <small style="color:#94a3b8;font-size:11px;">(optional — Tailwind gradient classes)</small></label>
                    <input type="text" name="color" id="color" value="{{ old('color', $service->color ?? '') }}"
                        class="form-control-custom" placeholder="e.g., from-blue-500 to-cyan-500">
                    @error('color')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="bg" class="form-label-custom">Background / Icon Base <small style="color:#94a3b8;font-size:11px;">(optional — Tailwind color class)</small></label>
                    <input type="text" name="bg" id="bg" value="{{ old('bg', $service->bg ?? '') }}"
                        class="form-control-custom" placeholder="e.g., blue-500">
                    @error('bg')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="icon_path" class="form-label-custom">SVG Icon Path <small style="color:#94a3b8;font-size:11px;">(optional — 'd' attribute of SVG &lt;path&gt;)</small></label>
                <textarea name="icon_path" id="icon_path" class="form-control-custom" rows="3" placeholder="e.g., M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4">{{ old('icon_path', $service->icon_path ?? '') }}</textarea>
                @if(old('icon_path', $service->icon_path ?? ''))
                    <div style="margin-top:8px;display:flex;align-items:center;gap:8px;color:#6366f1;">
                        <svg style="width:32px;height:32px;background:#0d1526;padding:4px;border-radius:6px;color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ old('icon_path', $service->icon_path ?? '') }}"/>
                        </svg>
                        <span style="font-size:12px;color:#94a3b8;">SVG Icon Preview</span>
                    </div>
                @endif
                @error('icon_path')<p class="form-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

</div>
