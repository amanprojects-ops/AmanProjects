@extends('layouts.app')

@section('title', 'Blog — ' . ($settings['site_title'] ?? 'Portfolio'))
@section('meta_description', 'Read our latest articles, tutorials, and insights on software development, technology, and more.')

@push('styles')
<style>
    /* ── Blog Hero ── */
    .blog-hero {
        padding: 7rem 0 4rem;
        text-align: center;
        position: relative;
    }
    .blog-hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 6px 16px;
        background: rgba(6,182,212,0.1);
        border: 1px solid rgba(6,182,212,0.2);
        border-radius: 99px;
        font-size: 12px; font-weight: 600; letter-spacing: 0.08em;
        text-transform: uppercase; color: #06b6d4;
        margin-bottom: 20px;
    }
    .blog-hero h1 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2.2rem, 5vw, 3.5rem);
        font-weight: 700; color: #f1f5f9;
        line-height: 1.15; margin-bottom: 16px;
    }
    .blog-hero h1 span {
        background: linear-gradient(135deg, #06b6d4, #0ea5e9, #38bdf8);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .blog-hero p {
        font-size: 1.05rem; color: #94a3b8;
        max-width: 520px; margin: 0 auto;
        line-height: 1.7;
    }

    /* ── Section ── */
    .blog-section { padding: 0 0 6rem; }
    .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

    /* ── Grid ── */
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 28px;
    }

    /* ── Card ── */
    .blog-card {
        background: rgba(13, 21, 38, 0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(6,182,212,0.1);
        border-radius: 20px;
        overflow: hidden;
        display: flex; flex-direction: column;
        transition: all 0.3s ease;
    }
    .blog-card:hover {
        transform: translateY(-6px);
        border-color: rgba(6,182,212,0.35);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 30px rgba(6,182,212,0.08);
    }
    .blog-card-image {
        position: relative; overflow: hidden;
        height: 200px; flex-shrink: 0;
    }
    .blog-card-image img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.4s ease;
    }
    .blog-card:hover .blog-card-image img {
        transform: scale(1.06);
    }
    .blog-card-image-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(6,182,212,0.15), rgba(14,165,233,0.08));
        display: flex; align-items: center; justify-content: center;
        font-size: 40px; color: rgba(6,182,212,0.3);
    }
    .blog-card-badge {
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
    .blog-card-body {
        padding: 24px;
        display: flex; flex-direction: column;
        flex: 1;
    }
    .blog-card-meta {
        display: flex; align-items: center; gap: 14px;
        margin-bottom: 12px;
        font-size: 12px; color: #475569;
    }
    .blog-card-meta span {
        display: flex; align-items: center; gap: 5px;
    }
    .blog-card-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 18px; font-weight: 700;
        color: #f1f5f9; line-height: 1.4;
        margin-bottom: 10px;
        text-decoration: none;
        display: block;
        transition: color 0.2s;
    }
    .blog-card-title:hover { color: #06b6d4; }
    .blog-card-excerpt {
        font-size: 13.5px; color: #64748b;
        line-height: 1.7; flex: 1; margin-bottom: 18px;
    }
    .blog-card-footer {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.05);
    }
    .btn-read-more {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 8px 18px;
        background: rgba(6,182,212,0.1);
        border: 1px solid rgba(6,182,212,0.2);
        border-radius: 99px;
        font-size: 13px; font-weight: 600; color: #06b6d4;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-read-more:hover {
        background: rgba(6,182,212,0.2);
        border-color: rgba(6,182,212,0.45);
        color: #22d3ee;
        gap: 10px;
    }
    .btn-read-more i { font-size: 11px; }

    /* ── Categories filter ── */
    .blog-filters {
        display: flex; align-items: center; justify-content: center;
        flex-wrap: wrap; gap: 10px;
        margin-bottom: 40px;
    }

    /* ── Empty state ── */
    .blog-empty {
        grid-column: 1 / -1;
        text-align: center; padding: 60px 20px;
    }
    .blog-empty .empty-icon {
        font-size: 52px; color: rgba(6,182,212,0.2); margin-bottom: 16px;
    }
    .blog-empty p { color: #475569; font-size: 15px; }

    /* ── Pagination ── */
    .blog-pagination {
        margin-top: 48px;
        display: flex; justify-content: center;
    }
    .blog-pagination nav {
        display: flex; align-items: center; gap: 6px;
    }

    @media (max-width: 640px) {
        .blog-grid { grid-template-columns: 1fr; }
        .blog-hero { padding: 6rem 0 3rem; }
    }
</style>
@endpush

@section('content')

<!-- Nav (from partial if it exists, else inline back btn) -->
@if(view()->exists('partials.nav'))
    @include('partials.nav')
@endif

<!-- Hero -->
<section class="blog-hero">
    <div class="container">
        <div class="blog-hero-badge" data-aos="fade-down">
            <i class="fa-solid fa-pen-nib"></i> Blog & Articles
        </div>
        <h1 data-aos="fade-up" data-aos-delay="50">
            Thoughts &amp; <span>Insights</span>
        </h1>
        <p data-aos="fade-up" data-aos-delay="100">
            Deep dives into software development, technology trends, and building digital products.
        </p>
    </div>
</section>

<!-- Blog Posts -->
<section class="blog-section" aria-labelledby="blog-page-heading">
    <div class="container">

        <div class="blog-grid">
            @forelse($posts as $post)
                <article class="blog-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">

                    <!-- Image -->
                    <div class="blog-card-image">
                        @if($post->featured_image)
                            <a href="{{ route('blog.show', $post->slug) }}">
                                <img src="@fileUrl($post->featured_image)"
                                     alt="{{ $post->title }}"
                                     loading="lazy"
                                     onerror="this.parentElement.innerHTML='<div class=\'blog-card-image-placeholder\'><i class=\'fa-solid fa-newspaper\'></i></div>'">
                            </a>
                        @else
                            <div class="blog-card-image-placeholder">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                        @endif

                        @if($post->categories->first())
                            <span class="blog-card-badge">
                                {{ $post->categories->first()->name }}
                            </span>
                        @endif
                    </div>

                    <!-- Body -->
                    <div class="blog-card-body">
                        <div class="blog-card-meta">
                            @if($post->published_at)
                                <span>
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ $post->published_at->format('M d, Y') }}
                                </span>
                            @endif
                            <span>
                                <i class="fa-regular fa-clock"></i>
                                {{ max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read
                            </span>
                        </div>

                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-title">
                            {{ $post->title }}
                        </a>

                        <p class="blog-card-excerpt">
                            {{ Str::limit(strip_tags($post->content), 130) }}
                        </p>

                        <div class="blog-card-footer">
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn-read-more" aria-label="Read {{ $post->title }}">
                                Read more <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </article>
            @empty
                <div class="blog-empty" data-aos="fade-up">
                    <div class="empty-icon"><i class="fa-solid fa-pencil"></i></div>
                    <p>No blog posts published yet. Check back soon!</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($posts->hasPages())
            <div class="blog-pagination">
                {{ $posts->links() }}
            </div>
        @endif

    </div>
</section>

@endsection
