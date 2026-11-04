<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-comment-dots" style="color:#6366f1;"></i> Testimonial Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="name" class="form-label-custom">Client Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $testimonial->name ?? '') }}" required
                        class="form-control-custom" placeholder="e.g., Sarah Jenkins">
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="designation" class="form-label-custom">Designation / Role <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                    <input type="text" name="designation" id="designation" value="{{ old('designation', $testimonial->designation ?? '') }}"
                        class="form-control-custom" placeholder="e.g., CEO at Acme Corp">
                    @error('designation')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="rating" class="form-label-custom">Rating <span style="color:#ef4444;">*</span></label>
                    <select name="rating" id="rating" required class="form-control-custom" style="padding:9px 14px;">
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>
                                {{ $i }} {{ Str::plural('Star', $i) }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="color" class="form-label-custom">Color Class / Theme <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                    <input type="text" name="color" id="color" value="{{ old('color', $testimonial->color ?? '') }}"
                        class="form-control-custom" placeholder="e.g., violet, primary, #f59e0b">
                    @error('color')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="text" class="form-label-custom">Testimonial Text <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                <textarea name="text" id="text" class="form-control-custom" rows="4" placeholder="What does the client say about your work…">{{ old('text', $testimonial->text ?? '') }}</textarea>
                @error('text')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label-custom">Client Avatar <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                
                @if(!empty($testimonial->avatar))
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;background:#f8fafc;padding:12px;border-radius:10px;border:1px solid #e2e8f0;width:fit-content;">
                        <img src="{{ asset($testimonial->avatar) }}" alt="Avatar" style="width:48px;height:48px;border-radius:50%;object-fit:cover;border:2px solid #6366f1;">
                        <div>
                            <p style="font-size:12px;font-weight:600;color:#334155;margin:0;">Current Avatar</p>
                            <p style="font-size:11px;color:#64748b;margin:0;max-width:200px;overflow:hidden;text-overflow:ellipsis;">{{ basename($testimonial->avatar) }}</p>
                        </div>
                    </div>
                @endif

                <div class="file-input-wrapper">
                    <input type="file" name="avatar" id="avatar" accept="image/*">
                    <div class="file-input-label">
                        <i class="fa-cloud-arrow-up fa-solid"></i>
                        <span>Upload new avatar image...</span>
                    </div>
                </div>
                @error('avatar')<p class="form-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

</div>
