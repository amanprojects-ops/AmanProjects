<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
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
</urlset>
