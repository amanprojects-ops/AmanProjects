<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-images" style="color:#6366f1;"></i> Album Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div>
                <label for="project_id" class="form-label-custom">Associated Project <span style="color:#ef4444;">*</span></label>
                <select name="project_id" id="project_id" required class="form-control-custom">
                    <option value="">Select Project...</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $album->project_id ?? '') == $project->id ? 'selected' : '' }}>
                            {{ $project->title }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="name" class="form-label-custom">Album Name / Section <span style="color:#ef4444;">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $album->name ?? '') }}" required
                    class="form-control-custom" placeholder="e.g. Mobile Application, Web Dashboard, UI Components...">
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="description" class="form-label-custom">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="form-control-custom" style="resize:vertical;" placeholder="Describe the screenshot collection... (optional)">{{ old('description', $album->description ?? '') }}</textarea>
                @error('description')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="sort_order" class="form-label-custom">Display Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $album->sort_order ?? 0) }}"
                        min="0" class="form-control-custom" placeholder="0">
                    @error('sort_order')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div style="display:flex;align-items:center;margin-top:28px;">
                    <label class="form-label-custom" style="display:flex;align-items:center;gap:8px;cursor:pointer;margin-bottom:0;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $album->is_active ?? true) ? 'checked' : '' }} style="width:18px;height:18px;accent-color:#6366f1;">
                        Is Active
                    </label>
                    @error('is_active')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

        </div>
    </div>

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-cloud-arrow-up" style="color:#6366f1;"></i> Upload Screenshots</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">
            <div>
                <label for="images" class="form-label-custom">Choose Screenshots (Multiple allowed)</label>
                <input type="file" name="images[]" id="images" class="form-control-custom" multiple accept="image/*">
                <small style="color:#94a3b8;font-size:12px;margin-top:4px;display:block;">Allowed formats: jpeg, png, webp, gif, svg. Max size: 5MB per file.</small>
                @error('images')<p class="form-error">{{ $message }}</p>@enderror
                @error('images.*')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            @if(isset($album) && $album->images && $album->images->count() > 0)
                <div style="margin-top:12px;">
                    <label class="form-label-custom" style="margin-bottom:12px;">Existing Screenshots (Select to Delete)</label>
                    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(130px, 1fr));gap:16px;">
                        @foreach($album->images as $image)
                            <div style="position:relative;border:1px solid #e2e8f0;border-radius:8px;padding:6px;background:#f8fafc;display:flex;flex-direction:column;align-items:center;">
                                <div style="width:100%;height:90px;border-radius:6px;overflow:hidden;background:#cbd5e1;display:flex;align-items:center;justify-content:center;margin-bottom:8px;">
                                    <img src="{{ asset($image->image_path) }}" alt="Screenshot" style="max-width:100%;max-height:100%;object-fit:cover;">
                                </div>
                                <label style="display:flex;align-items:center;gap:6px;font-size:11.5px;color:#ef4444;font-weight:600;cursor:pointer;margin-bottom:0;user-select:none;">
                                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" style="accent-color:#ef4444;cursor:pointer;">
                                    Delete
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-header" style="cursor:pointer;" onclick="document.getElementById('seoSection').style.display = document.getElementById('seoSection').style.display === 'none' ? 'grid' : 'none'">
            <h3 style="display:flex;align-items:center;justify-content:space-between;width:100%;margin:0;">
                <span><i class="fa-solid fa-magnifying-glass" style="color:#6366f1;"></i> SEO Metadata <small style="color:#94a3b8;font-size:12px;">(optional)</small></span>
                <i class="fa-solid fa-chevron-down" style="font-size:13px;color:#94a3b8;"></i>
            </h3>
        </div>
        <div id="seoSection" class="form-section-body" style="display:none;gap:16px;margin-top:16px;">
            <div>
                <label for="meta_title" class="form-label-custom">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $album->meta_title ?? '') }}"
                    class="form-control-custom" placeholder="SEO Title...">
                @error('meta_title')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="meta_description" class="form-label-custom">Meta Description</label>
                <input type="text" name="meta_description" id="meta_description" value="{{ old('meta_description', $album->meta_description ?? '') }}"
                    class="form-control-custom" placeholder="SEO Description...">
                @error('meta_description')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="meta_keywords" class="form-label-custom">Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $album->meta_keywords ?? '') }}"
                    class="form-control-custom" placeholder="SEO Keywords (comma separated)...">
                @error('meta_keywords')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

</div>
