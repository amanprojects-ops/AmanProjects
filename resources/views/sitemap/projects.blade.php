<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
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
</urlset>
