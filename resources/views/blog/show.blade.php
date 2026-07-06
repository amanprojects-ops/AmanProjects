@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' — ' . ($settings['site_title'] ?? 'Portfolio'))
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->content), 160))

@push('styles')
<meta property="og:title" content="{{ $post->meta_title ?: $post->title }}">
<meta property="og:description" content="{{ $post->meta_description ?: Str::limit(strip_tags($post->content), 160) }}">
@if($post->featured_image)
<meta property="og:image" content="@fileUrl($post->featured_image)">
@endif

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
        border: 1px solid rgba(6,182,212,0.1);
        border-radius: 24px;
        overflow: hidden;
    }
    .post-hero-image {
        width: 100%; max-height: 440px; object-fit: cover;
        display: block;
    }
    .post-body { padding: 40px; }

    /* Header */
    .post-header { margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.06); }
    .post-cats {
        display: flex; flex-wrap: wrap; gap: 8px;
        margin-bottom: 16px;
    }
    .post-cat-badge {
        padding: 4px 13px;
        background: rgba(6,182,212,0.1);
        border: 1px solid rgba(6,182,212,0.22);
        border-radius: 99px;
        font-size: 11.5px; font-weight: 600;
        color: #06b6d4; text-transform: uppercase; letter-spacing: 0.05em;
    }
    .post-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 700; color: #f1f5f9;
        line-height: 1.25; margin-bottom: 18px;
    }
    .post-meta {
        display: flex; align-items: center; flex-wrap: wrap; gap: 18px;
        font-size: 13px; color: #475569;
    }
    .post-meta span {
        display: flex; align-items: center; gap: 6px;
    }
    .post-meta i { color: #06b6d4; font-size: 12px; }

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

            {{-- Hero image --}}
            @if($post->featured_image)
                <img src="@fileUrl($post->featured_image)"
                     alt="{{ $post->title }}"
                     class="post-hero-image">
            @endif

            <div class="post-body">
                <header class="post-header">

                    {{-- Categories --}}
                    @if($post->categories->count())
                        <div class="post-cats">
                            @foreach($post->categories as $cat)
                                <span class="post-cat-badge">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <h1 class="post-title" id="post-heading">{{ $post->title }}</h1>

                    <div class="post-meta">
                        <span>
                            <i class="fa-regular fa-calendar"></i>
                            {{ $post->published_at?->format('F d, Y') ?? $post->created_at->format('F d, Y') }}
                        </span>
                        <span>
                            <i class="fa-regular fa-clock"></i>
                            {{ max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read
                        </span>
                    </div>
                </header>

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
