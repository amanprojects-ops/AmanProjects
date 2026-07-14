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
    .project-hero-image {
        width: 100%; max-height: 480px; object-fit: cover;
        display: block;
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
        white-space: pre-wrap;
    }

    /* Gallery */
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
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.05);
        cursor: pointer;
        transition: all 0.3s ease;
        height: 160px;
    }
    .gallery-item:hover {
        transform: scale(1.03);
        border-color: rgba(6, 182, 212, 0.35);
    }
    .gallery-item img {
        width: 100%; height: 100%; object-fit: cover;
    }

    /* ── Sidebar ── */
    .project-sidebar { position: sticky; top: 20px; }

    .sidebar-card {
        background: rgba(13, 21, 38, 0.6);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(6, 182, 212, 0.1);
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 20px;
    }
    .sidebar-card-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 13px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.07em;
        color: #475569; margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
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

    .cta-buttons {
        display: flex; flex-direction: column; gap: 12px;
    }
    .btn-action {
        display: flex; align-items: center; justify-content: center; gap: 10px;
        padding: 12px;
        border-radius: 12px;
        font-size: 14px; font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    .btn-action-primary {
        background: linear-gradient(135deg, #06b6d4, #0ea5e9);
        color: #fff;
        box-shadow: 0 0 15px rgba(6, 182, 212, 0.3);
    }
    .btn-action-primary:hover {
        box-shadow: 0 0 25px rgba(6, 182, 212, 0.6);
        transform: translateY(-2px);
    }
    .btn-action-secondary {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #e2e8f0;
    }
    .btn-action-secondary:hover {
        background: rgba(6, 182, 212, 0.08);
        border-color: rgba(6, 182, 212, 0.25);
        color: #06b6d4;
        transform: translateY(-2px);
    }

    .share-buttons {
        display: flex; flex-direction: column; gap: 10px;
    }
    .share-btn {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 13.5px; font-weight: 500;
        text-decoration: none; color: #94a3b8;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        transition: all 0.2s;
    }
    .share-btn:hover {
        background: rgba(6, 182, 212, 0.08);
        border-color: rgba(6, 182, 212, 0.2);
        color: #06b6d4;
    }
    .share-btn i { width: 18px; text-align: center; }

    @media (max-width: 900px) {
        .project-layout { grid-template-columns: 1fr; }
        .project-sidebar { position: static; }
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
                <img src="@fileUrl($project->thumbnail_image)"
                     alt="{{ $project->title }}"
                     class="project-hero-image">
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
                    {!! nl2br(e($project->description)) !!}
                </div>

                {{-- Gallery / Album Images --}}
                @if($project->albums->isNotEmpty())
                    @foreach($project->albums as $album)
                        @if($album->images->isNotEmpty())
                            <div class="gallery-section">
                                <h3 class="gallery-title">{{ $album->name }}</h3>
                                <div class="gallery-grid">
                                    @foreach($album->images as $img)
                                        <div class="gallery-item" onclick="openLightbox('@fileUrl($img->image_path)')">
                                            <img src="@fileUrl($img->image_path)" alt="{{ $album->name }} image" loading="lazy">
                                        </div>
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
            <div class="sidebar-card">
                <div class="sidebar-card-title"><i class="fa-solid fa-bolt me-2" style="color:#06b6d4;"></i> Actions</div>
                <div class="cta-buttons">
                    @if($project->live_demo_link)
                        <a href="{{ $project->live_demo_link }}" target="_blank" rel="noopener noreferrer" class="btn-action btn-action-primary">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Live Demo
                        </a>
                    @endif
                    @if($project->github_link)
                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="btn-action btn-action-secondary">
                            <i class="fa-brands fa-github"></i> Source Code
                        </a>
                    @endif
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

@endsection

@push('scripts')
<script>
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

    function openLightbox(url) {
        window.open(url, '_blank');
    }
</script>
@endpush
