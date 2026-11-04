<!-- Global Image Cropper & Generator Modal -->
<div id="cropperModal" class="cropper-modal-backdrop" style="display:none;">
    <div class="cropper-modal-container">
        
        <!-- Header -->
        <div class="cropper-modal-header">
            <h3><i class="fa-solid fa-crop-simple" style="color:#6366f1;"></i> Image Cropper & Generator</h3>
            <button type="button" class="cropper-modal-close" onclick="closeImageCropper()">&times;</button>
        </div>

        <!-- Body -->
        <div class="cropper-modal-body">
            <!-- Left: Workspace -->
            <div class="cropper-workspace">
                <div class="cropper-img-wrapper">
                    <img id="cropperTargetImage" src="" alt="Target Image for Cropping">
                </div>
            </div>

            <!-- Right: Generator & Aspect Ratio Controls -->
            <div class="cropper-controls-sidebar">
                
                <!-- Aspect Ratio Presets -->
                <div class="control-group">
                    <label class="control-label"><i class="fa-solid fa-vector-square"></i> Aspect Ratio Presets</label>
                    <div class="ratio-btn-grid">
                        <button type="button" class="ratio-btn active" data-ratio="1.7777777777777777" onclick="setCropperRatio(16/9, this)">
                            <span class="ratio-title">16:9</span>
                            <span class="ratio-sub">Blog Banner</span>
                        </button>
                        <button type="button" class="ratio-btn" data-ratio="1.3333333333333333" onclick="setCropperRatio(4/3, this)">
                            <span class="ratio-title">4:3</span>
                            <span class="ratio-sub">Card / Grid</span>
                        </button>
                        <button type="button" class="ratio-btn" data-ratio="1" onclick="setCropperRatio(1/1, this)">
                            <span class="ratio-title">1:1</span>
                            <span class="ratio-sub">Square</span>
                        </button>
                        <button type="button" class="ratio-btn" data-ratio="0.75" onclick="setCropperRatio(3/4, this)">
                            <span class="ratio-title">3:4</span>
                            <span class="ratio-sub">Portrait</span>
                        </button>
                        <button type="button" class="ratio-btn" data-ratio="NaN" onclick="setCropperRatio(NaN, this)">
                            <span class="ratio-title">Free</span>
                            <span class="ratio-sub">Custom</span>
                        </button>
                    </div>
                </div>

                <!-- Transform Tools -->
                <div class="control-group">
                    <label class="control-label"><i class="fa-solid fa-sliders"></i> Image Tools</label>
                    <div class="tool-btn-row">
                        <button type="button" class="tool-btn" onclick="cropperZoom(0.1)" title="Zoom In">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </button>
                        <button type="button" class="tool-btn" onclick="cropperZoom(-0.1)" title="Zoom Out">
                            <i class="fa-solid fa-magnifying-glass-minus"></i>
                        </button>
                        <button type="button" class="tool-btn" onclick="cropperRotate(-90)" title="Rotate Left 90°">
                            <i class="fa-solid fa-rotate-left"></i>
                        </button>
                        <button type="button" class="tool-btn" onclick="cropperRotate(90)" title="Rotate Right 90°">
                            <i class="fa-solid fa-rotate-right"></i>
                        </button>
                        <button type="button" class="tool-btn" onclick="cropperFlipX()" title="Flip Horizontal">
                            <i class="fa-solid fa-arrows-left-right"></i>
                        </button>
                        <button type="button" class="tool-btn" onclick="cropperFlipY()" title="Flip Vertical">
                            <i class="fa-solid fa-arrows-up-down"></i>
                        </button>
                        <button type="button" class="tool-btn danger" onclick="cropperReset()" title="Reset Image">
                            <i class="fa-solid fa-arrow-rotate-left"></i>
                        </button>
                    </div>
                </div>

                <!-- Output Resolution & Format Generator -->
                <div class="control-group">
                    <label class="control-label"><i class="fa-solid fa-gear"></i> Export Generator Settings</label>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                        <div>
                            <span class="sub-label">Max Width</span>
                            <select id="cropperMaxWidth" class="cropper-select">
                                <option value="1920">1920 px (Full HD)</option>
                                <option value="1200" selected>1200 px (Banner)</option>
                                <option value="800">800 px (Standard)</option>
                                <option value="600">600 px (Compact)</option>
                            </select>
                        </div>
                        <div>
                            <span class="sub-label">File Format</span>
                            <select id="cropperFormat" class="cropper-select">
                                <option value="image/webp" selected>WebP (Best SEO)</option>
                                <option value="image/jpeg">JPEG</option>
                                <option value="image/png">PNG</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <div class="cropper-modal-footer">
            <button type="button" class="btn-cropper-cancel" onclick="closeImageCropper()">Cancel</button>
            <button type="button" class="btn-cropper-apply" onclick="applyImageCrop()">
                <i class="fa-solid fa-check"></i> Apply &amp; Crop Image
            </button>
        </div>

    </div>
</div>

<style>
    .cropper-modal-backdrop {
        position: fixed; inset: 0;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 99999;
        display: flex; align-items: center; justify-content: center;
        padding: 20px;
        animation: fadeInCropper 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes fadeInCropper {
        from { opacity: 0; transform: scale(0.98); }
        to { opacity: 1; transform: scale(1); }
    }
    .cropper-modal-container {
        background: #ffffff;
        border-radius: 20px;
        width: 100%; max-width: 960px;
        max-height: 90vh;
        display: flex; flex-direction: column;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
        overflow: hidden;
    }
    .cropper-modal-header {
        padding: 16px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex; align-items: center; justify-content: space-between;
        background: #f8fafc;
    }
    .cropper-modal-header h3 {
        margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;
        display: flex; align-items: center; gap: 10px;
    }
    .cropper-modal-close {
        background: none; border: none; font-size: 24px; color: #94a3b8;
        cursor: pointer; line-height: 1; transition: color 0.15s;
    }
    .cropper-modal-close:hover { color: #ef4444; }

    .cropper-modal-body {
        display: grid; grid-template-columns: 1fr 340px;
        flex: 1; min-height: 420px; max-height: calc(90vh - 130px);
        overflow: hidden;
    }
    .cropper-workspace {
        background: #0f172a;
        display: flex; align-items: center; justify-content: center;
        padding: 20px; overflow: hidden; position: relative;
    }
    .cropper-img-wrapper {
        max-width: 100%; max-height: 100%;
        display: flex; align-items: center; justify-content: center;
    }
    .cropper-img-wrapper img {
        max-width: 100%; max-height: 100%; display: block;
    }

    .cropper-controls-sidebar {
        padding: 20px; background: #ffffff;
        border-left: 1px solid #e2e8f0;
        display: flex; flex-direction: column; gap: 20px;
        overflow-y: auto;
    }
    .control-group { display: flex; flex-direction: column; gap: 8px; }
    .control-label {
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.05em; color: #64748b;
        display: flex; align-items: center; gap: 6px;
    }
    .ratio-btn-grid {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;
    }
    .ratio-btn {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        padding: 8px 10px; border-radius: 10px;
        background: #f8fafc; border: 1.5px solid #e2e8f0;
        cursor: pointer; transition: all 0.15s;
    }
    .ratio-btn:hover { background: #f1f5f9; border-color: #cbd5e1; }
    .ratio-btn.active {
        background: #ede9fe; border-color: #6366f1; color: #4338ca;
    }
    .ratio-btn .ratio-title { font-size: 13px; font-weight: 700; }
    .ratio-btn .ratio-sub { font-size: 10.5px; opacity: 0.75; }

    .tool-btn-row {
        display: flex; flex-wrap: wrap; gap: 6px;
    }
    .tool-btn {
        width: 38px; height: 38px; border-radius: 10px;
        background: #f8fafc; border: 1.5px solid #e2e8f0;
        color: #334155; font-size: 14px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.15s;
    }
    .tool-btn:hover { background: #6366f1; color: #fff; border-color: #6366f1; }
    .tool-btn.danger:hover { background: #ef4444; color: #fff; border-color: #ef4444; }

    .sub-label { font-size: 11px; color: #64748b; margin-bottom: 4px; display: block; }
    .cropper-select {
        width: 100%; padding: 8px 10px; border-radius: 8px;
        border: 1.5px solid #e2e8f0; background: #f8fafc;
        font-size: 12.5px; color: #1e293b; font-weight: 500;
        outline: none;
    }
    .cropper-select:focus { border-color: #6366f1; background: #fff; }

    .cropper-modal-footer {
        padding: 14px 24px; border-top: 1px solid #e2e8f0;
        display: flex; align-items: center; justify-content: flex-end; gap: 12px;
        background: #f8fafc;
    }
    .btn-cropper-cancel {
        padding: 9px 18px; border-radius: 10px;
        background: #f1f5f9; border: 1px solid #e2e8f0;
        font-size: 13.5px; font-weight: 600; color: #475569;
        cursor: pointer; transition: background 0.15s;
    }
    .btn-cropper-cancel:hover { background: #e2e8f0; color: #0f172a; }
    .btn-cropper-apply {
        padding: 9px 20px; border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        border: none; color: #fff; font-size: 13.5px; font-weight: 600;
        cursor: pointer; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
        transition: all 0.15s;
    }
    .btn-cropper-apply:hover {
        background: linear-gradient(135deg, #4f46e5, #3730a3);
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .cropper-modal-body { grid-template-columns: 1fr; }
        .cropper-controls-sidebar { border-left: none; border-top: 1px solid #e2e8f0; }
    }
</style>

<script>
    let currentCropperInstance = null;
    let activeCropperInput = null;
    let activePreviewImg = null;
    let activeCurrentContainer = null;
    let cropperFlipScaleX = 1;
    let cropperFlipScaleY = 1;

    /**
     * Open Cropper Modal
     * @param {Object} options { input, previewImg, currentContainer, aspectRatio }
     */
    function openImageCropper(options) {
        const input = options.input;
        if (!input || !input.files || !input.files[0]) return;

        activeCropperInput = input;
        activePreviewImg = options.previewImg || null;
        activeCurrentContainer = options.currentContainer || null;

        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const targetImg = document.getElementById('cropperTargetImage');
            targetImg.src = e.target.result;

            document.getElementById('cropperModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';

            // Destroy previous cropper if exists
            if (currentCropperInstance) {
                currentCropperInstance.destroy();
                currentCropperInstance = null;
            }

            const initialRatio = options.aspectRatio !== undefined ? options.aspectRatio : (16 / 9);

            // Highlight corresponding ratio button
            document.querySelectorAll('.ratio-btn').forEach(btn => {
                const ratioAttr = parseFloat(btn.getAttribute('data-ratio'));
                if ((isNaN(ratioAttr) && isNaN(initialRatio)) || Math.abs(ratioAttr - initialRatio) < 0.05) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            // Initialize Cropper.js
            currentCropperInstance = new Cropper(targetImg, {
                aspectRatio: initialRatio,
                viewMode: 1,
                autoCropArea: 0.9,
                responsive: true,
                restore: false,
                checkCrossOrigin: false,
                background: false
            });

            cropperFlipScaleX = 1;
            cropperFlipScaleY = 1;
        };

        reader.readAsDataURL(file);
    }

    function closeImageCropper() {
        document.getElementById('cropperModal').style.display = 'none';
        document.body.style.overflow = '';
        if (currentCropperInstance) {
            currentCropperInstance.destroy();
            currentCropperInstance = null;
        }
    }

    function setCropperRatio(ratio, btnElement) {
        if (!currentCropperInstance) return;
        currentCropperInstance.setAspectRatio(ratio);
        document.querySelectorAll('.ratio-btn').forEach(btn => btn.classList.remove('active'));
        if (btnElement) btnElement.classList.add('active');
    }

    function cropperZoom(delta) {
        if (currentCropperInstance) currentCropperInstance.zoom(delta);
    }

    function cropperRotate(degree) {
        if (currentCropperInstance) currentCropperInstance.rotate(degree);
    }

    function cropperFlipX() {
        if (!currentCropperInstance) return;
        cropperFlipScaleX = -cropperFlipScaleX;
        currentCropperInstance.scaleX(cropperFlipScaleX);
    }

    function cropperFlipY() {
        if (!currentCropperInstance) return;
        cropperFlipScaleY = -cropperFlipScaleY;
        currentCropperInstance.scaleY(cropperFlipScaleY);
    }

    function cropperReset() {
        if (!currentCropperInstance) return;
        currentCropperInstance.reset();
        cropperFlipScaleX = 1;
        cropperFlipScaleY = 1;
    }

    function applyImageCrop() {
        if (!currentCropperInstance || !activeCropperInput) return;

        const maxWidth = parseInt(document.getElementById('cropperMaxWidth').value) || 1200;
        const mimeType = document.getElementById('cropperFormat').value || 'image/webp';

        const canvas = currentCropperInstance.getCroppedCanvas({
            maxWidth: maxWidth,
            maxHeight: maxWidth,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        if (!canvas) return;

        canvas.toBlob(function(blob) {
            if (!blob) return;

            // Determine file extension
            let ext = 'webp';
            if (mimeType === 'image/jpeg') ext = 'jpg';
            if (mimeType === 'image/png') ext = 'png';

            const originalName = activeCropperInput.files[0] ? activeCropperInput.files[0].name.replace(/\.[^/.]+$/, "") : "cropped";
            const croppedFileName = `${originalName}_cropped.${ext}`;

            // Create new File object
            const croppedFile = new File([blob], croppedFileName, { type: mimeType, lastModified: Date.now() });

            // Attach to native input via DataTransfer API
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(croppedFile);
            activeCropperInput.files = dataTransfer.files;

            // Update preview if provided
            if (activePreviewImg) {
                const blobUrl = URL.createObjectURL(blob);
                activePreviewImg.src = blobUrl;

                const previewContainer = activePreviewImg.closest('#image-preview-container') || activePreviewImg.parentElement;
                if (previewContainer) previewContainer.style.display = 'block';
                if (activeCurrentContainer) activeCurrentContainer.style.display = 'none';
            }

            closeImageCropper();
        }, mimeType, 0.92);
    }
</script>
