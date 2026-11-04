<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    {{-- ===== Home URL ===== --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- ===== Static Pages ===== --}}
    <url>
        <loc>{{ url('/about') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/contact') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/terms') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.4</priority>
    </url>
    <url>
        <loc>{{ url('/privacy') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.4</priority>
    </url>
    <url>
        <loc>{{ url('/blog') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/project') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>

    {{-- ===== Dynamic Services (High Priority Local SEO) ===== --}}
@if(isset($services))
@foreach($services as $service)
    <url>
        <loc>{{ $service->url }}</loc>
        <lastmod>{{ $service->updated_at ? $service->updated_at->tz('UTC')->toAtomString() : now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
@endforeach
@endif

    {{-- ===== Categories ===== --}}
@foreach($categories as $category)
    <url>
        <loc>{{ url('category/' . $category->slug) }}</loc>
        <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach

    {{-- ===== Projects ===== --}}
@foreach($projects as $project)
    <url>
        <loc>{{ url('project/' . ($project->slug ?? $project->id)) }}</loc>
        <lastmod>{{ $project->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
@if($project->thumbnail_image)
        <image:image>
            <image:loc>{{ \App\Helpers\FileUrlHelper::get($project->thumbnail_image) }}</image:loc>
            <image:title><![CDATA[{{ $project->title }}]]></image:title>
            <image:caption><![CDATA[{{ $project->title }} Thumbnail]]></image:caption>
        </image:image>
@endif
    </url>
@endforeach

    {{-- ===== Blogs ===== --}}
@foreach($blogs as $blog)
    <url>
        <loc>{{ route('blog.show', $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
@if($blog->featured_image)
        <image:image>
            <image:loc>{{ \App\Helpers\FileUrlHelper::get($blog->featured_image) }}</image:loc>
            <image:title><![CDATA[{{ $blog->title }}]]></image:title>
            <image:caption><![CDATA[{{ $blog->meta_description ?: $blog->title }}]]></image:caption>
        </image:image>
@endif
    </url>
@endforeach

    {{-- ===== Album Images ===== --}}
@foreach($albumImages as $img)
@if($img->album?->project && $img->image_path)
    <url>
        <loc>{{ url('project/' . ($img->album->project->slug ?? $img->album->project->id)) }}</loc>
        <image:image>
            <image:loc>{{ \App\Helpers\FileUrlHelper::get($img->image_path) }}</image:loc>
            <image:title><![CDATA[{{ $img->caption ?? ($img->album->name ?? 'Screenshot') }}]]></image:title>
        </image:image>
    </url>
@endif
@endforeach
</urlset>
