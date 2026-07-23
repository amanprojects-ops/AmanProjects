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
                    <label for="slug" class="form-label-custom">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $project->slug ?? '') }}"
                        class="form-control-custom" placeholder="project-url-slug">
                    @error('slug')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="description" class="form-label-custom">Description</label>
                    <textarea name="description" id="description" rows="8"
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

@push('styles')
    <!-- Summernote Lite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .note-editor.note-frame {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: none !important;
        }
        .note-toolbar {
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 8px 10px !important;
        }
        .note-btn-group {
            margin-right: 6px !important;
        }
        .note-btn {
            background: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            color: #334155 !important;
            padding: 5px 10px !important;
            font-size: 13px !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
        }
        .note-btn:hover, .note-btn.active {
            background: #6366f1 !important;
            color: #ffffff !important;
            border-color: #6366f1 !important;
        }
        .note-dropdown-menu {
            border-radius: 10px !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
            border: 1px solid #e2e8f0 !important;
        }
        .note-editable {
            font-family: 'Inter', sans-serif !important;
            font-size: 14.5px !important;
            line-height: 1.6 !important;
            color: #0f172a !important;
            background: #ffffff !important;
            min-height: 250px;
        }
        .note-statusbar {
            background: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
        }
    </style>
@endpush

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

@push('scripts')
    <!-- jQuery & Summernote Lite JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            // Slug Auto Generator
            function generateSlug(text) {
                return text
                    .toString()
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '')     // Remove non-alphanumeric chars
                    .replace(/[\s_-]+/g, '-')     // Replace spaces/underscores with -
                    .replace(/^-+|-+$/g, '');     // Trim -
            }

            let isSlugManuallyEdited = {{ (isset($project) && $project->slug) ? 'true' : 'false' }};

            $('#slug').on('input', function() {
                isSlugManuallyEdited = $(this).val().trim().length > 0;
            });

            $('#title').on('input keyup change', function() {
                if (!isSlugManuallyEdited) {
                    $('#slug').val(generateSlug($(this).val()));
                }
            });

            // Summernote Editor
            $('#description').summernote({
                placeholder: 'Describe the project...',
                tabsize: 2,
                height: 280,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endpush
