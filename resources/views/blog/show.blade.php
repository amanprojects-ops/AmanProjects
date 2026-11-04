@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' — ' . ($settings['site_title'] ?? 'Portfolio'))
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->content), 160))

@push('styles')
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $post->meta_title ?: $post->title }}">
<meta property="og:description" content="{{ $post->meta_description ?: Str::limit(strip_tags($post->content), 160) }}">
<meta property="og:url" content="{{ route('blog.show', $post->slug) }}">
@if($post->featured_image)
<meta property="og:image" content="@fileUrl($post->featured_image)">
<meta property="og:image:alt" content="{{ $post->title }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->meta_title ?: $post->title }}">
<meta name="twitter:description" content="{{ $post->meta_description ?: Str::limit(strip_tags($post->content), 160) }}">
<meta name="twitter:image" content="@fileUrl($post->featured_image)">
@endif

<script type="application/ld+json">
{!! json_encode(array_filter([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $post->title,
    'description' => $post->meta_description ?: Str::limit(strip_tags($post->content), 160),
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => route('blog.show', $post->slug),
    ],
    'image' => $post->featured_image ? [\App\Helpers\FileUrlHelper::get($post->featured_image)] : null,
    'datePublished' => $post->published_at?->toIso8601String() ?? $post->created_at->toIso8601String(),
    'dateModified' => $post->updated_at->toIso8601String(),
    'author' => [
        '@type' => 'Person',
        'name' => $settings['site_author'] ?? 'Aman',
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => $settings['site_title'] ?? config('app.name'),
    ],
]), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>

<style>
    .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

    /* ── Back nav ── */
    .post-nav {
        padding: 7rem 0 2rem;
    }
    .btn-back {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 9px 20px;
        background: rgba(6,182,212,0.08);
        border: 1px solid rgba(6,182,212,0.18);
        border-radius: 99px;
        font-size: 13.5px; font-weight: 500; color: #94a3b8;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-back:hover {
        background: rgba(6,182,212,0.15);
        color: #06b6d4; border-color: rgba(6,182,212,0.35);
        gap: 11px;
    }
    .btn-back i { font-size: 12px; transition: transform 0.2s; }
    .btn-back:hover i { transform: translateX(-2px); }

    /* ── Layout ── */
    .post-layout {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 32px;
        padding-bottom: 6rem;
        align-items: start;
    }

    /* ── Article ── */
    .post-article {
        background: rgba(13, 21, 38, 0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(6,182,212,0.12);
        border-radius: 24px;
        overflow: hidden;
    }
    .post-hero-wrapper {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        margin: 24px 0 32px;
        border: 1px solid rgba(6, 182, 212, 0.2);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4), 0 0 20px rgba(6, 182, 212, 0.1);
    }
    .post-hero-image {
        width: 100%; max-height: 480px; object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .post-hero-wrapper:hover .post-hero-image {
        transform: scale(1.02);
    }
    .post-body { padding: 40px; }

    /* Header */
    .post-header { margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.06); }
    .post-cats {
        display: flex; flex-wrap: wrap; gap: 10px;
        margin-bottom: 16px;
    }
    .post-cat-badge {
        padding: 6px 16px;
        background: linear-gradient(135deg, rgba(6,182,212,0.15), rgba(14,165,233,0.08));
        border: 1px solid rgba(6,182,212,0.3);
        border-radius: 99px;
        font-size: 12px; font-weight: 700;
        color: #22d3ee; text-transform: uppercase; letter-spacing: 0.06em;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex; align-items: center; gap: 6px;
    }
    .post-cat-badge:hover {
        background: linear-gradient(135deg, rgba(6,182,212,0.3), rgba(14,165,233,0.2));
        border-color: rgba(6,182,212,0.6);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(6,182,212,0.25);
    }
    .post-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(2rem, 4.5vw, 2.85rem) !important;
        font-weight: 800 !important;
        color: #ffffff !important;
        line-height: 1.25 !important;
        margin-top: 10px !important;
        margin-bottom: 20px !important;
        letter-spacing: -0.02em;
        word-break: break-word;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        text-shadow: 0 2px 14px rgba(0, 0, 0, 0.5);
    }
    .post-meta {
        display: flex; align-items: center; flex-wrap: wrap; gap: 14px;
        font-size: 13.5px; color: #94a3b8;
    }
    .meta-item {
        display: flex; align-items: center; gap: 7px;
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: 6px 14px;
        border-radius: 99px;
    }
    .post-meta i { color: #06b6d4; font-size: 13px; }

    /* Content */
    .post-content {
        font-size: 16px; color: #94a3b8;
        line-height: 1.9;
    }
    .post-content h1, .post-content h2, .post-content h3, .post-content h4 {
        font-family: 'Space Grotesk', sans-serif;
        color: #e2e8f0; margin: 2rem 0 1rem;
    }
    .post-content h2 { font-size: 1.6rem; }
    .post-content h3 { font-size: 1.3rem; }
    .post-content p { margin-bottom: 1.4rem; }
    .post-content a { color: #06b6d4; text-decoration: underline; text-decoration-color: rgba(6,182,212,0.3); }
    .post-content a:hover { color: #22d3ee; }
    .post-content img { max-width: 100%; border-radius: 12px; margin: 1.5rem 0; }
    .post-content code {
        background: rgba(6,182,212,0.08);
        border: 1px solid rgba(6,182,212,0.15);
        border-radius: 6px;
        padding: 2px 7px; font-size: 0.88em; color: #06b6d4;
    }
    .post-content pre {
        background: rgba(6,12,24,0.8);
        border: 1px solid rgba(6,182,212,0.12);
        border-radius: 14px;
        padding: 20px 24px; overflow-x: auto;
        margin: 1.5rem 0;
    }
    .post-content pre code {
        background: none; border: none; padding: 0; color: #e2e8f0;
    }
    .post-content blockquote {
        border-left: 3px solid #06b6d4;
        padding: 12px 20px;
        margin: 1.5rem 0;
        background: rgba(6,182,212,0.06);
        border-radius: 0 10px 10px 0;
        color: #64748b;
    }
    .post-content ul, .post-content ol {
        padding-left: 1.5rem; margin-bottom: 1.4rem;
    }
    .post-content li { margin-bottom: 0.5rem; }

    /* ── Sidebar ── */
    .post-sidebar { position: sticky; top: 20px; }

    .sidebar-card {
        background: rgba(13, 21, 38, 0.6);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(6,182,212,0.1);
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
        border-bottom: 1px solid rgba(255,255,255,0.05);
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
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        transition: all 0.2s;
    }
    .share-btn:hover {
        background: rgba(6,182,212,0.08);
        border-color: rgba(6,182,212,0.2);
        color: #06b6d4;
    }
    .share-btn i { width: 18px; text-align: center; }

    /* ── Post Footer ── */
    .post-footer {
        margin-top: 36px; padding-top: 28px;
        border-top: 1px solid rgba(255,255,255,0.06);
        display: flex; justify-content: center;
    }
    .btn-all-posts {
        display: inline-flex; align-items: center; gap: 9px;
        padding: 12px 28px;
        background: linear-gradient(135deg, rgba(6,182,212,0.12), rgba(14,165,233,0.08));
        border: 1px solid rgba(6,182,212,0.25);
        border-radius: 12px;
        color: #06b6d4; font-size: 14px; font-weight: 600;
        text-decoration: none;
        transition: all 0.25s;
    }
    .btn-all-posts:hover {
        background: linear-gradient(135deg, rgba(6,182,212,0.2), rgba(14,165,233,0.15));
        border-color: rgba(6,182,212,0.45);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(6,182,212,0.15);
    }

    @media (max-width: 900px) {
        .post-layout { grid-template-columns: 1fr; }
        .post-sidebar { position: static; }
    }
    @media (max-width: 600px) {
        .post-body { padding: 24px; }
        .post-nav { padding: 6rem 0 1.5rem; }
    }
</style>
@endpush

@section('content')

@if(view()->exists('partials.nav'))
    @include('partials.nav')
@endif

<div class="post-nav">
    <div class="container">
        <a href="{{ route('blog') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back to Blog
        </a>
    </div>
</div>

<div class="container">
    <div class="post-layout">

        <!-- Main Article -->
        <article class="post-article" data-aos="fade-up">

            <div class="post-body">
                <header class="post-header">

                    {{-- Categories --}}
                    @if($post->categories->count())
                        <div class="post-cats">
                            @foreach($post->categories as $cat)
                                <a href="{{ route('category.show', $cat->slug) }}" class="post-cat-badge">
                                    <i class="fa-solid fa-tag" style="font-size:10px;opacity:0.8;"></i> {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    {{-- Post Title --}}
                    <h1 class="post-title" id="post-heading">{{ $post->title }}</h1>

                    {{-- Meta Bar --}}
                    <div class="post-meta">
                        <span class="meta-item">
                            <i class="fa-regular fa-calendar-check"></i>
                            {{ $post->published_at?->format('F d, Y') ?? $post->created_at->format('F d, Y') }}
                        </span>
                        <span class="meta-item">
                            <i class="fa-regular fa-clock"></i>
                            {{ max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read
                        </span>
                        <span class="meta-item">
                            <i class="fa-solid fa-user-pen"></i>
                            {{ $settings['site_author'] ?? 'Aman' }}
                        </span>
                    </div>
                </header>

                {{-- Hero image --}}
                @if($post->featured_image)
                    <div class="post-hero-wrapper">
                        <img src="@fileUrl($post->featured_image)"
                             alt="{{ $post->title }} - Featured Image"
                             title="{{ $post->title }}"
                             itemprop="image"
                             loading="eager"
                             class="post-hero-image">
                    </div>
                @endif

                <div class="post-content">
                    {!! $post->content !!}
                </div>

                <div class="post-footer">
                    <a href="{{ route('blog') }}" class="btn-all-posts">
                        <i class="fa-solid fa-newspaper"></i>
                        View All Posts
                    </a>
                </div>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="post-sidebar" data-aos="fade-left" data-aos-delay="150">

            {{-- Share --}}
            <div class="sidebar-card">
                <div class="sidebar-card-title"><i class="fa-solid fa-share-nodes me-2" style="color:#06b6d4;"></i> Share Article</div>
                <div class="share-buttons">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                       target="_blank" rel="noopener" class="share-btn">
                        <i class="fa-brands fa-x-twitter"></i> Share on X
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}"
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

            {{-- Post info --}}
            <div class="sidebar-card">
                <div class="sidebar-card-title"><i class="fa-solid fa-circle-info me-2" style="color:#06b6d4;"></i> Post Info</div>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;font-size:13px;">
                        <span style="color:#475569;">Published</span>
                        <span style="color:#94a3b8;font-weight:500;">{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;font-size:13px;">
                        <span style="color:#475569;">Reading time</span>
                        <span style="color:#94a3b8;font-weight:500;">{{ max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200)) }} min</span>
                    </div>
                    @if($post->categories->count())
                    <div style="display:flex;justify-content:space-between;align-items:center;font-size:13px;">
                        <span style="color:#475569;">Categories</span>
                        <span style="color:#94a3b8;font-weight:500;">{{ $post->categories->pluck('name')->join(', ') }}</span>
                    </div>
                    @endif
                </div>
            </div>

        </aside>

    </div>
</div>

@include('partials.footer')

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
</script>
@endpush
