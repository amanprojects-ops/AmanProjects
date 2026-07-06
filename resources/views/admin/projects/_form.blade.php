<div class="form-layout" style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:8px;align-items:start;">

    <!-- Left Column -->
    <div style="display:grid;gap:24px;">
        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-diagram-project" style="color:#6366f1;"></i> Project Details</h3>
            </div>
            <div class="form-section-body" style="display:grid;gap:16px;">

                <div>
                    <label for="title" class="form-label-custom">Title <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $project->title ?? '') }}" required
                        class="form-control-custom" placeholder="Project name…">
                    @error('title')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="description" class="form-label-custom">Description</label>
                    <textarea name="description" id="description" rows="5"
                        class="form-control-custom" style="resize:vertical;" placeholder="Describe the project…">{{ old('description', $project->description ?? '') }}</textarea>
                    @error('description')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="tech_stack_tags" class="form-label-custom">Tech Stack</label>
                    <input type="text" name="tech_stack_tags" id="tech_stack_tags"
                        value="{{ old('tech_stack_tags', $project->tech_stack_tags ?? '') }}"
                        class="form-control-custom" placeholder="Laravel, Vue.js, MySQL (comma separated)">
                    @error('tech_stack_tags')<p class="form-error">{{ $message }}</p>@enderror
                </div>

            </div>
        </div>

        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-link" style="color:#6366f1;"></i> Links</h3>
            </div>
            <div class="form-section-body" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="github_link" class="form-label-custom">GitHub URL</label>
                    <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $project->github_link ?? '') }}"
                        class="form-control-custom" placeholder="https://github.com/…">
                    @error('github_link')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="live_demo_link" class="form-label-custom">Live Demo URL</label>
                    <input type="url" name="live_demo_link" id="live_demo_link" value="{{ old('live_demo_link', $project->live_demo_link ?? '') }}"
                        class="form-control-custom" placeholder="https://…">
                    @error('live_demo_link')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div style="display:grid;gap:24px;">
        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-image" style="color:#6366f1;"></i> Thumbnail Image</h3>
            </div>
            <div class="form-section-body">
                @if(isset($project) && $project->thumbnail_image)
                    <div id="current-thumbnail-container" style="margin-bottom:14px;">
                        <img src="@fileUrl($project->thumbnail_image)" alt="Current thumbnail" style="width:100%;height:auto;max-height:200px;object-fit:cover;border-radius:10px;border:2px solid #e2e8f0;">
                        <p style="font-size:12px;color:#94a3b8;margin-top:6px;">Current thumbnail</p>
                    </div>
                @endif
                <div id="image-preview-container" style="display:none; margin-bottom:14px;">
                    <img id="image-preview" src="#" alt="New thumbnail preview" style="width:100%;height:auto;max-height:200px;object-fit:cover;border-radius:10px;border:2px solid #6366f1;">
                    <p style="font-size:12px;color:#6366f1;margin-top:6px;font-weight:500;">New thumbnail preview</p>
                </div>
                <div class="file-input-wrapper">
                    <input type="file" name="thumbnail_image" id="thumbnail_image" accept="image/*" onchange="previewImage(event)">
                    <div class="file-input-label">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <div>
                            <p style="margin:0;font-weight:600;color:#334155;font-size:13.5px;">Click to upload thumbnail</p>
                            <p style="margin:0;font-size:12px;color:#94a3b8;">PNG, JPG, WebP up to 5MB</p>
                        </div>
                    </div>
                </div>
                @error('thumbnail_image')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-sliders" style="color:#6366f1;"></i> Settings</h3>
            </div>
            <div class="form-section-body" style="display:grid;gap:16px;">
                <div>
                    <label for="status" class="form-label-custom">Status</label>
                    <select name="status" id="status" class="form-control-custom">
                        <option value="draft" {{ old('status', $project->status ?? 'draft') === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                        <option value="published" {{ old('status', $project->status ?? '') === 'published' ? 'selected' : '' }}>🚀 Published</option>
                    </select>
                </div>
                <div>
                    <input type="hidden" name="featured" value="0">
                    <div class="switch-wrapper">
                        <input type="checkbox" name="featured" id="featured" value="1"
                            {{ old('featured', $project->featured ?? false) ? 'checked' : '' }}
                            style="accent-color:#6366f1;width:18px;height:18px;cursor:pointer;">
                        <div>
                            <label for="featured" class="switch-label" style="cursor:pointer;">
                                <i class="fa-solid fa-star" style="color:#f59e0b;font-size:12px;margin-right:4px;"></i>
                                Featured Project
                            </label>
                            <p style="font-size:12px;color:#94a3b8;margin:0;">Show on homepage featured section</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    @media (max-width: 1024px) {
        .form-layout {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('image-preview');
        const currentContainer = document.getElementById('current-thumbnail-container');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                
                if (currentContainer) {
                    currentContainer.style.display = 'none';
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.style.display = 'none';
            if (currentContainer) {
                currentContainer.style.display = 'block';
            }
        }
    }
</script>
