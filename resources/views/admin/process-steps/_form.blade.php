<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-list-ol" style="color:#6366f1;"></i> Process Step Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div style="display:grid;grid-template-columns:1fr 3fr;gap:16px;">
                <div>
                    <label for="num" class="form-label-custom">Step Number / Order <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="num" id="num" value="{{ old('num', $processStep->num ?? '') }}" required
                        class="form-control-custom" placeholder="e.g., 01, Step 1">
                    @error('num')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="title" class="form-label-custom">Step Title <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $processStep->title ?? '') }}" required
                        class="form-control-custom" placeholder="e.g., Research & Planning, Design, Development…">
                    @error('title')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="desc" class="form-label-custom">Description <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                <textarea name="desc" id="desc" class="form-control-custom" rows="4" placeholder="Briefly describe what happens in this step…">{{ old('desc', $processStep->desc ?? '') }}</textarea>
                @error('desc')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="icon" class="form-label-custom">Icon Class <small style="color:#94a3b8;font-size:11px;">(optional — Font Awesome class)</small></label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $processStep->icon ?? '') }}"
                    class="form-control-custom" placeholder="e.g., fa-solid fa-magnifying-glass, fa-solid fa-pencil, fa-solid fa-terminal">
                @if(old('icon', $processStep->icon ?? ''))
                    <div style="margin-top:8px;display:flex;align-items:center;gap:8px;color:#6366f1;">
                        <i class="{{ old('icon', $processStep->icon ?? '') }}" style="font-size:20px;"></i>
                        <span style="font-size:12px;color:#94a3b8;">Preview</span>
                    </div>
                @endif
                @error('icon')<p class="form-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

</div>
