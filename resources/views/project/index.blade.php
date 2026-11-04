@extends('layouts.app')

@section('title', 'Projects — ' . ($settings['site_title'] ?? 'AmanProjects'))
@section('meta_description', 'Explore our portfolio of custom software, web applications, and digital products built by AmanProjects.')

@push('styles')
<style>
    /* ── Project Hero ── */
    .project-hero {
        padding: 7rem 0 4rem;
        text-align: center;
        position: relative;
    }
    .project-hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 6px 16px;
        background: rgba(6,182,212,0.1);
        border: 1px solid rgba(6,182,212,0.2);
        border-radius: 99px;
        font-size: 12px; font-weight: 600; letter-spacing: 0.08em;
        text-transform: uppercase; color: #06b6d4;
        margin-bottom: 20px;
    }
    .project-hero h1 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2.2rem, 5vw, 3.5rem);
        font-weight: 700; color: #f1f5f9;
        line-height: 1.15; margin-bottom: 16px;
    }
    .project-hero h1 span {
        background: linear-gradient(135deg, #06b6d4, #0ea5e9, #38bdf8);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .project-hero p {
        font-size: 1.05rem; color: #94a3b8;
        max-width: 520px; margin: 0 auto;
        line-height: 1.7;
    }

    /* ── Section ── */
    .project-section { padding: 0 0 6rem; }
    .proj-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

    /* ── Grid ── */
    .project-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 28px;
    }

    /* ── Card ── */
    .project-card {
        background: rgba(13, 21, 38, 0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(6,182,212,0.1);
        border-radius: 20px;
        overflow: hidden;
        display: flex; flex-direction: column;
        transition: all 0.3s ease;
    }
    .project-card:hover {
        transform: translateY(-6px);
        border-color: rgba(6,182,212,0.35);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 30px rgba(6,182,212,0.08);
    }
    .project-card-image {
        position: relative; overflow: hidden;
        height: 210px; flex-shrink: 0;
    }
    .project-card-image img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.4s ease;
    }
    .project-card:hover .project-card-image img {
        transform: scale(1.06);
    }
    .project-card-image-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(6,182,212,0.15), rgba(14,165,233,0.08));
        display: flex; align-items: center; justify-content: center;
        font-size: 40px; color: rgba(6,182,212,0.3);
    }
    .project-card-featured {
        position: absolute; top: 14px; left: 14px;
        padding: 4px 12px;
        background: rgba(6,182,212,0.15);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(6,182,212,0.25);
        border-radius: 99px;
        font-size: 11px; font-weight: 600;
        color: #06b6d4; text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .project-card-body {
        padding: 24px;
        display: flex; flex-direction: column;
        flex: 1;
    }
    .project-card-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 18px; font-weight: 700;
        color: #f1f5f9; line-height: 1.4;
        margin-bottom: 10px;
        text-decoration: none;
        display: block;
        transition: color 0.2s;
    }
    .project-card-title:hover { color: #06b6d4; }
    .project-card-desc {
        font-size: 13.5px; color: #64748b;
        line-height: 1.7; flex: 1; margin-bottom: 14px;
    }
    .project-card-tags {
        display: flex; flex-wrap: wrap; gap: 6px;
        margin-bottom: 18px;
    }
    .project-card-tag {
        padding: 3px 10px;
        background: rgba(6,182,212,0.08);
        border: 1px solid rgba(6,182,212,0.12);
        border-radius: 99px;
        font-size: 11px; font-weight: 500; color: #06b6d4;
    }
    .project-card-footer {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.05);
        gap: 10px;
    }
    .btn-view-project {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 8px 18px;
        background: rgba(6,182,212,0.1);
        border: 1px solid rgba(6,182,212,0.2);
        border-radius: 99px;
        font-size: 13px; font-weight: 600; color: #06b6d4;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-view-project:hover {
        background: rgba(6,182,212,0.2);
        border-color: rgba(6,182,212,0.45);
        color: #22d3ee;
        gap: 10px;
    }
    .btn-view-project i { font-size: 11px; }
    .project-card-links {
        display: flex; gap: 8px;
    }
    .project-card-links a {
        display: inline-flex; align-items: center; justify-content: center;
        width: 34px; height: 34px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 50%;
        color: #64748b; font-size: 14px;
        text-decoration: none;
        transition: all 0.2s;
    }
    .project-card-links a:hover {
        background: rgba(6,182,212,0.12);
        border-color: rgba(6,182,212,0.3);
        color: #06b6d4;
    }

    /* ── Empty state ── */
    .project-empty {
        grid-column: 1 / -1;
        text-align: center; padding: 60px 20px;
    }
    .project-empty .empty-icon {
        font-size: 52px; color: rgba(6,182,212,0.2); margin-bottom: 16px;
    }
    .project-empty p { color: #475569; font-size: 15px; }

    /* ── Pagination ── */
    .project-pagination {
        margin-top: 48px;
        display: flex; justify-content: center;
    }
    .project-pagination nav {
        display: flex; align-items: center; gap: 6px;
    }

    @media (max-width: 640px) {
        .project-grid { grid-template-columns: 1fr; }
        .project-hero { padding: 6rem 0 3rem; }
    }
</style>
@endpush

@section('content')

<!-- Nav -->
@if(view()->exists('partials.nav'))
    @include('partials.nav')
@endif

<!-- Hero -->
<section class="project-hero">
    <div class="proj-container">
        <div class="project-hero-badge" data-aos="fade-down">
            <i class="fa-solid fa-code"></i> Our Portfolio
        </div>
        <h1 data-aos="fade-up" data-aos-delay="50">
            Our <span>Projects</span>
        </h1>
        <p data-aos="fade-up" data-aos-delay="100">
            Explore our portfolio of custom software, web applications, and digital products crafted with precision.
        </p>
    </div>
</section>

<!-- Projects Listing -->
<section class="project-section" aria-labelledby="projects-page-heading">
    <div class="proj-container">

        <div class="project-grid">
            @forelse($projects as $project)
                <article class="project-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">

                    <!-- Image -->
                    <div class="project-card-image">
                        @if($project->thumbnail_image)
                            <a href="{{ route('project.show', $project->slug) }}" title="{{ $project->title }}">
                                <img src="@fileUrl($project->thumbnail_image)"
                                     alt="{{ $project->title }}"
                                     title="{{ $project->title }}"
                                     loading="lazy"
                                     width="600" height="337"
                                     onerror="this.parentElement.innerHTML='<div class=\'project-card-image-placeholder\'><i class=\'fa-solid fa-folder-open\'></i></div>'">
                            </a>
                        @else
                            <div class="project-card-image-placeholder">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>
                        @endif

                        @if($project->featured)
                            <span class="project-card-featured">
                                <i class="fa-solid fa-star" style="margin-right:3px;font-size:9px"></i> Featured
                            </span>
                        @endif
                    </div>

                    <!-- Body -->
                    <div class="project-card-body">
                        <a href="{{ route('project.show', $project->slug) }}" class="project-card-title">
                            {{ $project->title }}
                        </a>

                        <p class="project-card-desc">
                            {{ Str::limit(strip_tags($project->description), 120) }}
                        </p>

                        @if($project->tech_stack_tags)
                            <div class="project-card-tags">
                                @foreach(array_slice($project->tech_stack_array, 0, 4) as $tag)
                                    <span class="project-card-tag">{{ $tag }}</span>
                                @endforeach
                                @if(count($project->tech_stack_array) > 4)
                                    <span class="project-card-tag">+{{ count($project->tech_stack_array) - 4 }}</span>
                                @endif
                            </div>
                        @endif

                        <div class="project-card-footer">
                            <a href="{{ route('project.show', $project->slug) }}" class="btn-view-project" aria-label="View {{ $project->title }}">
                                View Project <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <div class="project-card-links">
                                @if($project->github_link)
                                    <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" title="GitHub" aria-label="GitHub repository for {{ $project->title }}">
                                        <i class="fa-brands fa-github"></i>
                                    </a>
                                @endif
                                @if($project->live_demo_link)
                                    <a href="{{ $project->live_demo_link }}" target="_blank" rel="noopener noreferrer" title="Live Demo" aria-label="Live demo of {{ $project->title }}">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </article>
            @empty
                <div class="project-empty" data-aos="fade-up">
                    <div class="empty-icon"><i class="fa-solid fa-folder-open"></i></div>
                    <p>No projects published yet. Check back soon!</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($projects->hasPages())
            <div class="project-pagination">
                {{ $projects->links() }}
            </div>
        @endif

    </div>
</section>

@include('partials.footer')

@endsection
