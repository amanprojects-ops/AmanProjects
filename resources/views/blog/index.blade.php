@extends('layouts.app')

@section('title', 'Blog - ' . ($settings['site_title'] ?? 'Portfolio'))

@section('content')
<section class="projects-section" style="padding-top: 8rem;" aria-labelledby="blog-page-heading">
    <div class="container">
        <h1 id="blog-page-heading" class="section-title">✍️ Blog Posts</h1>

        <div class="projects-grid">
            @forelse($posts as $post)
                <article class="project-card glass-card fade-in">
                    @if($post->featured_image)
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <img src="@fileUrl($post->featured_image)"
                                 alt="{{ $post->title }}"
                                 class="project-image"
                                 loading="lazy"
                                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22%3E%3Crect fill=%22%238b5cf6%22 width=%22400%22 height=%22200%22/%3E%3Ctext fill=%22%23ffffff%22 font-family=%22Arial%22 font-size=%2220%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3E{{ $post->title }}%3C/text%3E%3C/svg%3E'">
                        </a>
                    @else
                        <img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22%3E%3Crect fill=%22%238b5cf6%22 width=%22400%22 height=%22200%22/%3E%3Ctext fill=%22%23ffffff%22 font-family=%22Arial%22 font-size=%2220%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3E{{ $post->title }}%3C/text%3E%3C/svg%3E"
                             alt="{{ $post->title }}"
                             class="project-image"
                             loading="lazy">
                    @endif
                    <div class="project-content">
                        <h2 class="project-title">
                            <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: inherit;">{{ $post->title }}</a>
                        </h2>
                        <p class="project-description">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                        @if($post->category)
                            <div class="project-tags">
                                <span class="tag">{{ $post->category->name }}</span>
                            </div>
                        @endif
                        <div class="project-links">
                            <a href="{{ route('blog.show', $post->slug) }}" class="project-link" aria-label="Read {{ $post->title }}">
                                <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                                Read More
                            </a>
                            @if($post->published_at)
                                <span class="project-link" style="cursor: default; opacity: 0.7;">
                                    <i class="fa-solid fa-calendar" aria-hidden="true"></i>
                                    {{ $post->published_at->format('M d, Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    <p style="color: var(--text-muted); font-size: 1.1rem;">😕 No blog posts yet.</p>
                </div>
            @endforelse
        </div>

        @if($posts->hasPages())
            <div style="margin-top: 3rem; display: flex; justify-content: center;">
                <div class="glass-card" style="padding: 1rem 2rem;">
                    {{ $posts->links() }}
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
