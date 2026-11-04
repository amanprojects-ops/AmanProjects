<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-folder-open" style="color:#6366f1;"></i> Category Details</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div>
                <label for="name" class="form-label-custom">Category Name <span style="color:#ef4444;">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" required
                    class="form-control-custom" placeholder="e.g., Laravel, JavaScript…">
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="slug" class="form-label-custom">Slug <span style="color:#ef4444;">*</span></label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug ?? '') }}" required
                    class="form-control-custom" placeholder="category-url-slug">
                <p style="font-size:12px;color:#94a3b8;margin-top:5px;"><i class="fa-solid fa-circle-info me-1"></i> Used in URL. Use lowercase, hyphens only.</p>
                @error('slug')<p class="form-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

</div>
