<div class="form-layout" style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:8px;align-items:start;">

    <!-- Left Column -->
    <div style="display:grid;gap:24px;">
        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-align-left" style="color:#6366f1;"></i> Post Content</h3>
            </div>
            <div class="form-section-body" style="display:grid;gap:16px;">

                <div>
                    <label for="title" class="form-label-custom">Title <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}" required
                        class="form-control-custom" placeholder="Enter post title…">
                    @error('title')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="slug" class="form-label-custom">Slug <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug ?? '') }}" required
                        class="form-control-custom" placeholder="post-url-slug">
                    @error('slug')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="content" class="form-label-custom">Content <span style="color:#ef4444;">*</span></label>
                    <textarea name="content" id="content" rows="12"
                        class="form-control-custom" style="resize:vertical;">{{ old('content', $post->content ?? '') }}</textarea>
                    @error('content')<p class="form-error">{{ $message }}</p>@enderror
                </div>

            </div>
        </div>

        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-magnifying-glass" style="color:#6366f1;"></i> SEO Meta</h3>
            </div>
            <div class="form-section-body" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="meta_title" class="form-label-custom">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title ?? '') }}"
                        class="form-control-custom" placeholder="SEO title…">
                    @error('meta_title')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="meta_description" class="form-label-custom">Meta Description</label>
                    <input type="text" name="meta_description" id="meta_description" value="{{ old('meta_description', $post->meta_description ?? '') }}"
                        class="form-control-custom" placeholder="Short SEO description…">
                    @error('meta_description')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div style="display:grid;gap:24px;">
        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-image" style="color:#6366f1;"></i> Featured Image</h3>
            </div>
            <div class="form-section-body">
                @if(isset($post) && $post->featured_image)
                    <div id="current-thumbnail-container" style="margin-bottom:14px;">
                        <img src="@fileUrl($post->featured_image)" alt="Current Image" style="width:100%;height:auto;max-height:200px;object-fit:cover;border-radius:10px;border:2px solid #e2e8f0;">
                        <p style="font-size:12px;color:#94a3b8;margin-top:6px;display:flex;align-items:center;justify-content:space-between;">
                            <span>Current image</span>
                        </p>
                    </div>
                @endif
                <div id="image-preview-container" style="display:none; margin-bottom:14px;">
                    <img id="image-preview" src="#" alt="New image preview" style="width:100%;height:auto;max-height:200px;object-fit:cover;border-radius:10px;border:2px solid #6366f1;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:8px;">
                        <p style="font-size:12px;color:#6366f1;margin:0;font-weight:500;">New image preview</p>
                        <button type="button" onclick="triggerCropImage('featured_image')" style="padding:4px 10px;border-radius:6px;background:#ede9fe;color:#4c1d95;border:1px solid #c4b5fd;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:5px;">
                            <i class="fa-solid fa-crop-simple"></i> Crop / Resize
                        </button>
                    </div>
                </div>
                <div class="file-input-wrapper">
                    <input type="file" name="featured_image" id="featured_image" accept="image/*" onchange="previewAndCropImage(event, 16/9)">
                    <div class="file-input-label">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <div>
                            <p style="margin:0;font-weight:600;color:#334155;font-size:13.5px;">Click to upload image &amp; crop</p>
                            <p style="margin:0;font-size:12px;color:#94a3b8;">PNG, JPG, WebP up to 5MB (16:9 Banner recommended)</p>
                        </div>
                    </div>
                </div>
                @error('featured_image')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-folder-open" style="color:#6366f1;"></i> Categories</h3>
            </div>
            <div class="form-section-body">
                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    @foreach($categories as $category)
                        <label style="display:inline-flex;align-items:center;gap:8px;padding:7px 14px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:10px;cursor:pointer;transition:all 0.15s;font-size:13.5px;font-weight:500;color:#334155;" class="category-check-label">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', isset($post) ? $post->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                                style="accent-color:#6366f1;width:14px;height:14px;">
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-header">
                <h3><i class="fa-solid fa-sliders" style="color:#6366f1;"></i> Publishing</h3>
            </div>
            <div class="form-section-body" style="display:grid;grid-template-columns:1fr;gap:16px;">
                <div>
                    <label for="status" class="form-label-custom">Status</label>
                    <select name="status" id="status" class="form-control-custom">
                        <option value="draft" {{ old('status', $post->status ?? 'draft') === 'draft' ? 'selected' : '' }}>📝 Draft</option>
                        <option value="published" {{ old('status', $post->status ?? '') === 'published' ? 'selected' : '' }}>🚀 Published</option>
                    </select>
                </div>
                <div>
                    <label for="published_at" class="form-label-custom">Publish Date</label>
                    <input type="datetime-local" name="published_at" id="published_at"
                        value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                        class="form-control-custom">
                    @error('published_at')<p class="form-error">{{ $message }}</p>@enderror
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
    .category-check-label:has(input:checked) {
        background: #ede9fe !important; border-color: #6366f1 !important; color: #4c1d95 !important;
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
            min-height: 320px;
        }
        .note-statusbar {
            background: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
        }
    </style>
@endpush

<script>
    function previewAndCropImage(event, defaultRatio = 16/9) {
        const input = event.target;
        if (input.files && input.files[0]) {
            openImageCropper({
                input: input,
                previewImg: document.getElementById('image-preview'),
                currentContainer: document.getElementById('current-thumbnail-container'),
                aspectRatio: defaultRatio
            });
        }
    }

    function triggerCropImage(inputId, defaultRatio = 16/9) {
        const input = document.getElementById(inputId);
        if (input && input.files && input.files[0]) {
            openImageCropper({
                input: input,
                previewImg: document.getElementById('image-preview'),
                currentContainer: document.getElementById('current-thumbnail-container'),
                aspectRatio: defaultRatio
            });
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
                    .replace(/[^\w\s-]/g, '')     // Remove non-alphanumeric chars (except space and dash)
                    .replace(/[\s_-]+/g, '-')     // Replace spaces, underscores & multiple hyphens with single hyphen
                    .replace(/^-+|-+$/g, '');     // Trim leading & trailing hyphens
            }

            let isSlugManuallyEdited = {{ (isset($post) && $post->slug) ? 'true' : 'false' }};

            $('#slug').on('input', function() {
                isSlugManuallyEdited = $(this).val().trim().length > 0;
            });

            $('#title').on('input keyup change', function() {
                if (!isSlugManuallyEdited) {
                    $('#slug').val(generateSlug($(this).val()));
                }
            });

            // Summernote Editor
            $('#content').summernote({
                placeholder: 'Write your post content here...',
                tabsize: 2,
                height: 350,
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
