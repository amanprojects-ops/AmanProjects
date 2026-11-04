@extends('layouts.app')

@section('title', $project->title . ' — ' . ($settings['site_title'] ?? 'AmanProjects'))
@section('meta_description', Str::limit(strip_tags($project->description), 160))

@push('styles')
<meta property="og:title" content="{{ $project->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($project->description), 160) }}">
@if($project->thumbnail_image)
<meta property="og:image" content="@fileUrl($project->thumbnail_image)">
@endif

<style>
    .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

    /* ── Back nav ── */
    .project-nav {
        padding: 7rem 0 2rem;
    }
    .btn-back {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 9px 20px;
        background: rgba(6, 182, 212, 0.08);
        border: 1px solid rgba(6, 182, 212, 0.18);
        border-radius: 99px;
        font-size: 13.5px; font-weight: 500; color: #94a3b8;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-back:hover {
        background: rgba(6, 182, 212, 0.15);
        color: #06b6d4; border-color: rgba(6, 182, 212, 0.35);
        gap: 11px;
    }
    .btn-back i { font-size: 12px; transition: transform 0.2s; }
    .btn-back:hover i { transform: translateX(-2px); }

    /* ── Layout ── */
    .project-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 32px;
        padding-bottom: 6rem;
        align-items: start;
    }

    /* ── Main Details ── */
    .project-detail-card {
        background: rgba(13, 21, 38, 0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(6, 182, 212, 0.1);
        border-radius: 24px;
        overflow: hidden;
    }
    .project-hero-container {
        width: 100%;
        background: rgba(2, 6, 23, 0.5);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .project-hero-image {
        width: 100%;
        height: auto;
        max-height: 540px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
    }
    .project-body { padding: 40px; }

    /* Header */
    .project-header { margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid rgba(255, 255, 255, 0.06); }
    .project-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 700; color: #f1f5f9;
        line-height: 1.25; margin-bottom: 18px;
    }

    /* Content */
    .project-description {
        font-size: 16px; color: #94a3b8;
        line-height: 1.9;
    }
    .project-description h1, .project-description h2, .project-description h3, .project-description h4 {
        color: #f1f5f9; font-weight: 700; margin-top: 1.5rem; margin-bottom: 0.8rem; font-family: 'Space Grotesk', sans-serif;
    }
    .project-description h2 { font-size: 1.5rem; }
    .project-description h3 { font-size: 1.25rem; }
    .project-description p { margin-bottom: 1.2rem; }
    .project-description strong { color: #f8fafc; font-weight: 600; }
    .project-description a { color: #06b6d4; text-decoration: underline; text-decoration-color: rgba(6,182,212,0.4); }
    .project-description a:hover { color: #38bdf8; }
    .project-description ul, .project-description ol { margin-left: 1.4rem; margin-bottom: 1.2rem; }
    .project-description ul { list-style-type: disc; }
    .project-description ol { list-style-type: decimal; }
    .project-description li { margin-bottom: 0.4rem; color: #cbd5e1; }
    .project-description blockquote { border-left: 3px solid #06b6d4; margin: 1.2rem 0; color: #cbd5e1; font-style: italic; background: rgba(6, 182, 212, 0.05); padding: 10px 16px; border-radius: 0 10px 10px 0; }

    /* Gallery Grid */
    .gallery-section {
        margin-top: 40px;
        padding-top: 32px;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    .gallery-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 20px; font-weight: 600;
        color: #f1f5f9; margin-bottom: 20px;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
    }
    .gallery-item {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.08);
        cursor: pointer;
        transition: all 0.3s ease;
        height: 165px;
    }
    .gallery-item:hover {
        transform: translateY(-4px);
        border-color: rgba(6, 182, 212, 0.45);
        box-shadow: 0 10px 25px rgba(6, 182, 212, 0.2);
    }
    .gallery-item img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.4s ease;
    }
    .gallery-item:hover img {
        transform: scale(1.08);
    }
    .gallery-item-overlay {
        position: absolute; inset: 0;
        background: rgba(2, 8, 23, 0.45);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease;
        color: #06b6d4; font-size: 22px;
    }
    .gallery-item:hover .gallery-item-overlay {
        opacity: 1;
    }

    /* ── Lightbox Modal Slider ── */
    .lightbox-modal {
        position: fixed; inset: 0; z-index: 9999;
        display: none; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.25s ease;
    }
    .lightbox-modal.active {
        display: flex; opacity: 1;
    }
    .lightbox-backdrop {
        position: absolute; inset: 0;
        background: rgba(2, 8, 23, 0.94);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }
    .lightbox-dialog {
        position: relative; z-index: 10;
        max-width: 92vw; max-height: 92vh;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    .lightbox-stage {
        position: relative;
        display: flex; align-items: center; justify-content: center;
    }
    .lightbox-stage img {
        max-width: 85vw; max-height: 75vh;
        object-fit: contain; border-radius: 16px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.85);
        border: 1px solid rgba(6, 182, 212, 0.3);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    .lightbox-info {
        margin-top: 16px; display: flex; align-items: center; gap: 14px;
        color: #e2e8f0; font-size: 14.5px; font-weight: 500; text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }
    .lightbox-badge {
        background: rgba(6, 182, 212, 0.15); border: 1px solid rgba(6, 182, 212, 0.35);
        color: #06b6d4; padding: 4px 14px; border-radius: 99px;
        font-size: 12.5px; font-weight: 600; letter-spacing: 0.03em;
    }
    .lightbox-btn-close {
        position: absolute; top: -52px; right: 0;
        width: 42px; height: 42px; border-radius: 50%;
        background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.18);
        color: #f1f5f9; font-size: 18px; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .lightbox-btn-close:hover {
        background: #ef4444; border-color: #ef4444; color: #fff;
        transform: scale(1.1);
    }
    .lightbox-btn-nav {
        position: absolute; top: 50%; transform: translateY(-50%);
        width: 50px; height: 50px; border-radius: 50%;
        background: rgba(13, 21, 38, 0.85); border: 1px solid rgba(6, 182, 212, 0.35);
        color: #f1f5f9; font-size: 18px; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s ease; z-index: 20;
    }
    .lightbox-btn-nav:hover {
        background: #06b6d4; border-color: #06b6d4; color: #fff;
        box-shadow: 0 0 25px rgba(6, 182, 212, 0.6);
        transform: translateY(-50%) scale(1.08);
    }
    .lightbox-btn-prev { left: -75px; }
    .lightbox-btn-next { right: -75px; }

    /* ── Action Buttons ── */
    .cta-buttons {
        display: flex; flex-direction: column; gap: 12px;
    }
    .btn-action {
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        padding: 13px 20px;
        border-radius: 14px;
        font-size: 14px; font-weight: 600;
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        box-sizing: border-box;
    }
    .btn-action-primary {
        background: linear-gradient(135deg, #06b6d4 0%, #0284c7 100%);
        color: #ffffff !important;
        box-shadow: 0 4px 18px rgba(6, 182, 212, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .btn-action-primary:hover {
        box-shadow: 0 6px 25px rgba(6, 182, 212, 0.6);
        transform: translateY(-2px);
        color: #ffffff !important;
    }
    .btn-action-secondary {
        background: rgba(15, 23, 42, 0.7);
        border: 1px solid rgba(6, 182, 212, 0.3);
        color: #38bdf8 !important;
    }
    .btn-action-secondary:hover {
        background: rgba(6, 182, 212, 0.15);
        border-color: rgba(6, 182, 212, 0.6);
        color: #06b6d4 !important;
        transform: translateY(-2px);
    }
    .btn-action-contact {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #cbd5e1 !important;
    }
    .btn-action-contact:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.25);
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    /* ── Sidebar ── */
    .project-sidebar { position: sticky; top: 20px; }

    .sidebar-card {
        background: rgba(13, 21, 38, 0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(6, 182, 212, 0.12);
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 20px;
    }
    .sidebar-card-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 13px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.07em;
        color: #64748b; margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .tech-tags {
        display: flex; flex-wrap: wrap; gap: 8px;
    }
    .tech-tag-badge {
        padding: 6px 14px;
        background: rgba(6, 182, 212, 0.1);
        border: 1px solid rgba(6, 182, 212, 0.22);
        border-radius: 99px;
        font-size: 12px; font-weight: 500;
        color: #06b6d4;
    }

    .share-buttons {
        display: flex; flex-direction: column; gap: 10px;
    }
    .share-btn {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 13.5px; font-weight: 500;
        text-decoration: none !important; color: #94a3b8 !important;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        transition: all 0.2s;
        cursor: pointer;
    }
    .share-btn:hover {
        background: rgba(6, 182, 212, 0.08);
        border-color: rgba(6, 182, 212, 0.2);
        color: #06b6d4 !important;
    }
    .share-btn i { width: 18px; text-align: center; }

    @media (max-width: 900px) {
        .project-layout { grid-template-columns: 1fr; }
        .project-sidebar { position: static; }
        .lightbox-btn-prev { left: -15px; }
        .lightbox-btn-next { right: -15px; }
        .lightbox-btn-close { top: -45px; right: 10px; }
    }
    @media (max-width: 600px) {
        .project-body { padding: 24px; }
        .project-nav { padding: 6rem 0 1.5rem; }
    }
</style>
@endpush

@section('content')

@if(view()->exists('partials.nav'))
    @include('partials.nav')
@endif

<div class="project-nav">
    <div class="container">
        <a href="{{ route('home') }}#products" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back to Projects
        </a>
    </div>
</div>

<div class="container">
    <div class="project-layout">

        <!-- Main Content -->
        <div class="project-detail-card" data-aos="fade-up">
            @if($project->thumbnail_image)
                <div class="project-hero-container">
                    <img src="@fileUrl($project->thumbnail_image)"
                         alt="{{ $project->title }}"
                         class="project-hero-image">
                </div>
            @endif

            <div class="project-body">
                <header class="project-header">
                    <h1 class="project-title" id="project-heading">{{ $project->title }}</h1>
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
                        <span class="text-cyan-400 text-sm font-semibold tracking-wider uppercase">Project Details</span>
                    </div>
                </header>

                <div class="project-description">
                    {!! \App\Helpers\HtmlPurifier::clean($project->description) !!}
                </div>

                {{-- Gallery / Album Images --}}
                @php 
                    $allGalleryPhotos = [];
                    $globalImgIndex = 0; 
                @endphp
                @if($project->albums->isNotEmpty())
                    @foreach($project->albums as $album)
                        @if($album->images->isNotEmpty())
                            <div class="gallery-section">
                                <h3 class="gallery-title"><i class="fa-solid fa-images me-2" style="color:#06b6d4;"></i> {{ $album->name }}</h3>
                                <div class="gallery-grid">
                                    @foreach($album->images as $img)
                                        @php
                                            $imgUrl = \App\Helpers\FileUrlHelper::get($img->image_path);
                                            $allGalleryPhotos[] = [
                                                'url' => $imgUrl,
                                                'album' => $album->name
                                            ];
                                        @endphp
                                        <div class="gallery-item" onclick="openLightboxModal({{ $globalImgIndex }})">
                                            <img src="{{ $imgUrl }}" alt="{{ $album->name }} photo" loading="lazy">
                                            <div class="gallery-item-overlay">
                                                <i class="fa-solid fa-expand"></i>
                                            </div>
                                        </div>
                                        @php $globalImgIndex++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="project-sidebar" data-aos="fade-left" data-aos-delay="150">

            {{-- Actions --}}
            @php
                $demoUrl = $project->live_demo_link ? (Str::startsWith($project->live_demo_link, ['http://', 'https://']) ? $project->live_demo_link : 'https://' . $project->live_demo_link) : null;
                $githubUrl = $project->github_link ? (Str::startsWith($project->github_link, ['http://', 'https://']) ? $project->github_link : 'https://' . $project->github_link) : null;
            @endphp
            <div class="sidebar-card">
                <div class="sidebar-card-title"><i class="fa-solid fa-bolt me-2" style="color:#06b6d4;"></i> Actions</div>
                <div class="cta-buttons">
                    @if($demoUrl)
                        <a href="{{ $demoUrl }}" target="_blank" rel="noopener noreferrer" class="btn-action btn-action-primary">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Live Demo
                        </a>
                    @endif
                    @if($githubUrl)
                        <a href="{{ $githubUrl }}" target="_blank" rel="noopener noreferrer" class="btn-action btn-action-secondary">
                            <i class="fa-brands fa-github"></i> Source Code
                        </a>
                    @endif
                    <a href="{{ route('home') }}#contact" class="btn-action btn-action-contact">
                        <i class="fa-solid fa-paper-plane"></i> Inquire About Project
                    </a>
                </div>
            </div>

            {{-- Tech Stack --}}
            @if($project->tech_stack_tags)
                <div class="sidebar-card">
                    <div class="sidebar-card-title"><i class="fa-solid fa-code me-2" style="color:#06b6d4;"></i> Tech Stack</div>
                    <div class="tech-tags">
                        @foreach(explode(',', $project->tech_stack_tags) as $tag)
                            <span class="tech-tag-badge">{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Share --}}
            <div class="sidebar-card">
                <div class="sidebar-card-title"><i class="fa-solid fa-share-nodes me-2" style="color:#06b6d4;"></i> Share Project</div>
                <div class="share-buttons">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}"
                       target="_blank" rel="noopener" class="share-btn">
                        <i class="fa-brands fa-x-twitter"></i> Share on X
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($project->title) }}"
                       target="_blank" rel="noopener" class="share-btn">
                        <i class="fa-brands fa-linkedin"></i> Share on LinkedIn
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                       target="_blank" rel="noopener" class="share-btn">
                        <i class="fa-brands fa-facebook"></i> Share on Facebook
                    </a>
                    <button class="share-btn" onclick="copyLink()" id="copyBtn">
                        <i class="fa-solid fa-link" id="copyIcon"></i>
                        <span id="copyText">Copy Link</span>
                    </button>
                </div>
            </div>

        </aside>

    </div>
</div>

{{-- Lightbox Modal Slider --}}
<div id="lightboxModal" class="lightbox-modal">
    <div class="lightbox-backdrop" onclick="closeLightboxModal()"></div>
    <div class="lightbox-dialog">
        <button type="button" class="lightbox-btn-close" onclick="closeLightboxModal()" aria-label="Close modal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <button type="button" class="lightbox-btn-nav lightbox-btn-prev" onclick="prevLightboxImage()" aria-label="Previous photo">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div class="lightbox-stage">
            <img id="lightboxImg" src="" alt="Full view photo">
        </div>

        <div class="lightbox-info">
            <span id="lightboxAlbumTitle" style="color:#f1f5f9;font-weight:600;"></span>
            <span id="lightboxCounter" class="lightbox-badge"></span>
        </div>

        <button type="button" class="lightbox-btn-nav lightbox-btn-next" onclick="nextLightboxImage()" aria-label="Next photo">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
</div>

@include('partials.footer')

@endsection

@push('scripts')
<script>
    const galleryPhotos = @json($allGalleryPhotos ?? []);
    let currentPhotoIndex = 0;

    function openLightboxModal(index) {
        if (!galleryPhotos || galleryPhotos.length === 0) return;
        currentPhotoIndex = index;
        updateLightboxContent();
        const modal = document.getElementById('lightboxModal');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightboxModal() {
        const modal = document.getElementById('lightboxModal');
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    function updateLightboxContent() {
        if (currentPhotoIndex < 0) currentPhotoIndex = galleryPhotos.length - 1;
        if (currentPhotoIndex >= galleryPhotos.length) currentPhotoIndex = 0;

        const photo = galleryPhotos[currentPhotoIndex];
        const imgEl = document.getElementById('lightboxImg');
        const albumEl = document.getElementById('lightboxAlbumTitle');
        const counterEl = document.getElementById('lightboxCounter');

        if (imgEl && photo) {
            imgEl.style.opacity = '0.3';
            imgEl.src = photo.url;
            imgEl.onload = function() {
                imgEl.style.opacity = '1';
            };
            albumEl.textContent = photo.album || 'Gallery';
            counterEl.textContent = `${currentPhotoIndex + 1} / ${galleryPhotos.length}`;
        }
    }

    function prevLightboxImage() {
        currentPhotoIndex--;
        updateLightboxContent();
    }

    function nextLightboxImage() {
        currentPhotoIndex++;
        updateLightboxContent();
    }

    // Keyboard Navigation Listener
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('lightboxModal');
        if (modal && modal.classList.contains('active')) {
            if (e.key === 'Escape') {
                closeLightboxModal();
            } else if (e.key === 'ArrowLeft') {
                prevLightboxImage();
            } else if (e.key === 'ArrowRight') {
                nextLightboxImage();
            }
        }
    });

    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(function() {
            document.getElementById('copyText').textContent = 'Copied!';
            document.getElementById('copyIcon').className = 'fa-solid fa-check';
            setTimeout(function() {
                document.getElementById('copyText').textContent = 'Copy Link';
                document.getElementById('copyIcon').className = 'fa-solid fa-link';
            }, 2000);
        });
    }
</script>
@endpush

