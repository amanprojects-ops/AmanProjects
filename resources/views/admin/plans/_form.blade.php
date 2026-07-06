<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-money-bill" style="color:#6366f1;"></i> Plan Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div style="display:grid;grid-template-columns:2fr 1fr 1fr;gap:16px;">
                <div>
                    <label for="name" class="form-label-custom">Plan Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $plan->name ?? '') }}" required
                        class="form-control-custom" placeholder="e.g., Professional, Enterprise, Basic…">
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="price" class="form-label-custom">Price <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="price" id="price" value="{{ old('price', $plan->price ?? '') }}" required
                        class="form-control-custom" placeholder="e.g., $19, Free">
                    @error('price')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="period" class="form-label-custom">Billing Period <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                    <input type="text" name="period" id="period" value="{{ old('period', $plan->period ?? '') }}"
                        class="form-control-custom" placeholder="e.g., month, year, one-time">
                    @error('period')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="desc" class="form-label-custom">Description <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                <textarea name="desc" id="desc" class="form-control-custom" rows="3" placeholder="A short overview of who this plan is for…">{{ old('desc', $plan->desc ?? '') }}</textarea>
                @error('desc')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="color" class="form-label-custom">Color Class / Hex <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                    <input type="text" name="color" id="color" value="{{ old('color', $plan->color ?? '') }}"
                        class="form-control-custom" placeholder="e.g., #6366f1, indigo, primary">
                    @error('color')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="btn_style" class="form-label-custom">Button Class <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                    <input type="text" name="btn_style" id="btn_style" value="{{ old('btn_style', $plan->btn_style ?? '') }}"
                        class="form-control-custom" placeholder="e.g., btn-admin-primary, btn-outline-primary">
                    @error('btn_style')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="features" class="form-label-custom">Plan Features <small style="color:#94a3b8;font-size:11px;">(optional — write each feature on a new line)</small></label>
                <textarea name="features" id="features" class="form-control-custom" rows="5" placeholder="e.g.&#10;5 Projects&#10;24/7 Support&#10;Custom Domain">{{ old('features', is_array($plan->features) ? implode("\n", $plan->features) : ($plan->features ?? '')) }}</textarea>
                @error('features')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <input type="hidden" name="featured" value="0">
                <div class="switch-wrapper">
                    <input type="checkbox" name="featured" id="featured" value="1"
                        {{ old('featured', $plan->featured ?? false) ? 'checked' : '' }}
                        style="accent-color:#6366f1;width:18px;height:18px;cursor:pointer;">
                    <div>
                        <label for="featured" class="switch-label" style="cursor:pointer;">Featured Plan</label>
                        <p style="font-size:12px;color:#94a3b8;margin:0;">Highlight this plan on the pricing table</p>
                    </div>
                </div>
                @error('featured')<p class="form-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

</div>
