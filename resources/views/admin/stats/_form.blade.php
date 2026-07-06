<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-chart-simple" style="color:#6366f1;"></i> Stat Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div>
                <label for="label" class="form-label-custom">Stat Label <span style="color:#ef4444;">*</span></label>
                <input type="text" name="label" id="label" value="{{ old('label', $stat->label ?? '') }}" required
                    class="form-control-custom" placeholder="e.g., Projects Completed, Happy Clients…">
                @error('label')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="value" class="form-label-custom">Value <span style="color:#ef4444;">*</span></label>
                    <input type="number" name="value" id="value" value="{{ old('value', $stat->value ?? 0) }}" required
                        class="form-control-custom" placeholder="e.g., 150">
                    @error('value')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="suffix" class="form-label-custom">Suffix <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                    <input type="text" name="suffix" id="suffix" value="{{ old('suffix', $stat->suffix ?? '') }}"
                        class="form-control-custom" placeholder="e.g., +, %, K, M">
                    @error('suffix')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="icon" class="form-label-custom">Icon Class <small style="color:#94a3b8;font-size:11px;">(optional — Font Awesome class)</small></label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $stat->icon ?? '') }}"
                    class="form-control-custom" placeholder="e.g., fa-solid fa-briefcase, fa-solid fa-code, fa-solid fa-heart">
                @if(old('icon', $stat->icon ?? ''))
                    <div style="margin-top:8px;display:flex;align-items:center;gap:8px;color:#6366f1;">
                        <i class="{{ old('icon', $stat->icon ?? '') }}" style="font-size:20px;"></i>
                        <span style="font-size:12px;color:#94a3b8;">Preview</span>
                    </div>
                @endif
                @error('icon')<p class="form-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

</div>
