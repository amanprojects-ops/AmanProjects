<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-question-circle" style="color:#6366f1;"></i> Benefit Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div>
                <label for="title" class="form-label-custom">Title / Benefit <span style="color:#ef4444;">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $whyChooseUs->title ?? '') }}" required
                    class="form-control-custom" placeholder="e.g., On-Time Delivery, Expert Support, Affordable Pricing…">
                @error('title')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="desc" class="form-label-custom">Description <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                <textarea name="desc" id="desc" class="form-control-custom" rows="4" placeholder="Detail why this benefits our clients…">{{ old('desc', $whyChooseUs->desc ?? '') }}</textarea>
                @error('desc')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="color" class="form-label-custom">Color Class / Theme <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                    <input type="text" name="color" id="color" value="{{ old('color', $whyChooseUs->color ?? '') }}"
                        class="form-control-custom" placeholder="e.g., rose, violet, teal, #4f46e5">
                    @error('color')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="icon" class="form-label-custom">Icon Class <small style="color:#94a3b8;font-size:11px;">(optional — Font Awesome class)</small></label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $whyChooseUs->icon ?? '') }}"
                        class="form-control-custom" placeholder="e.g., fa-solid fa-star, fa-solid fa-shield-halved, fa-solid fa-award">
                    @if(old('icon', $whyChooseUs->icon ?? ''))
                        <div style="margin-top:8px;display:flex;align-items:center;gap:8px;color:#6366f1;">
                            <i class="{{ old('icon', $whyChooseUs->icon ?? '') }}" style="font-size:20px;"></i>
                            <span style="font-size:12px;color:#94a3b8;">Preview</span>
                        </div>
                    @endif
                    @error('icon')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

        </div>
    </div>

</div>
