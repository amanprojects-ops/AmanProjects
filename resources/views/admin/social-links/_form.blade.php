<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-share-nodes" style="color:#6366f1;"></i> Social Link Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div>
                <label for="name" class="form-label-custom">Platform Name <span style="color:#ef4444;">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $socialLink->name ?? '') }}" required
                    class="form-control-custom" placeholder="e.g., GitHub, LinkedIn, Twitter…">
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="url" class="form-label-custom">Profile URL <span style="color:#ef4444;">*</span></label>
                <input type="url" name="url" id="url" value="{{ old('url', $socialLink->url ?? '') }}" required
                    class="form-control-custom" placeholder="https://github.com/yourprofile">
                @error('url')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="icon" class="form-label-custom">Icon Class <small style="color:#94a3b8;font-size:11px;">(optional — Font Awesome class)</small></label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $socialLink->icon ?? '') }}"
                    class="form-control-custom" placeholder="e.g., fab fa-github, fab fa-linkedin">
                @if(old('icon', $socialLink->icon ?? ''))
                    <div style="margin-top:8px;display:flex;align-items:center;gap:8px;color:#6366f1;">
                        <i class="{{ old('icon', $socialLink->icon ?? '') }}" style="font-size:20px;"></i>
                        <span style="font-size:12px;color:#94a3b8;">Preview</span>
                    </div>
                @endif
                @error('icon')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <input type="hidden" name="is_active" value="0">
                <div class="switch-wrapper">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $socialLink->is_active ?? true) ? 'checked' : '' }}
                        style="accent-color:#6366f1;width:18px;height:18px;cursor:pointer;">
                    <div>
                        <label for="is_active" class="switch-label" style="cursor:pointer;">Active</label>
                        <p style="font-size:12px;color:#94a3b8;margin:0;">Show this link on your portfolio</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
