@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' - ' . ($settings['site_title'] ?? 'Portfolio'))

@push('styles')
<meta property="og:title" content="{{ $post->meta_title ?: $post->title }}">
<meta property="og:description" content="{{ $post->meta_description ?: Str::limit(strip_tags($post->content), 160) }}">
@if($post->featured_image)
<meta property="og:image" content="@fileUrl($post->featured_image)">
@endif
@endpush

@section('content')
<section class="about-section" style="padding-top: 8rem;" aria-labelledby="post-heading">
    <div class="container" style="max-width: 900px;">
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('blog') }}" class="btn btn-secondary glass-btn" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to Blog
            </a>
        </div>

        <article class="glass-card">
            @if($post->featured_image)
                <img src="@fileUrl($post->featured_image)"
                     alt="{{ $post->title }}"
                     style="width: 100%; height: 400px; object-fit: cover; border-radius: 15px; margin-bottom: 2rem;">
            @endif

            <header style="margin-bottom: 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 1.5rem;">
                <h1 id="post-heading" style="font-size: 2.5rem; font-weight: bold; margin-bottom: 1rem; color: var(--text-light);">
                    {{ $post->title }}
                </h1>
                <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; color: var(--text-muted); font-size: 0.95rem;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-calendar" aria-hidden="true"></i>
                        {{ $post->published_at?->format('F d, Y') ?? $post->created_at->format('F d, Y') }}
                    </span>
                    @if($post->category)
                        <span style="display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fa-solid fa-folder" aria-hidden="true"></i>
                            <span class="tag">{{ $post->category->name }}</span>
                        </span>
                    @endif
                </div>
            </header>

            <div class="about-text" style="color: var(--text-muted); line-height: 1.8; font-size: 1.05rem;">
                {!! $post->content !!}
            </div>
        </article>

        <div style="margin-top: 2rem; text-align: center;">
            <a href="{{ route('blog') }}" class="btn btn-primary glass-btn">
                <i class="fa-solid fa-newspaper" aria-hidden="true"></i> View All Posts
            </a>
        </div>
    </div>
</section>
@endsection
