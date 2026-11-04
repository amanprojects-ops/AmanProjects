<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach($projects as $project)
    <url>
        <loc>{{ url('project/' . ($project->slug ?? $project->id)) }}</loc>
        <image:image>
            <image:loc>{{ \App\Helpers\FileUrlHelper::get($project->thumbnail_image) }}</image:loc>
            <image:title><![CDATA[{{ $project->title }}]]></image:title>
            <image:caption><![CDATA[{{ $project->title }} Thumbnail]]></image:caption>
        </image:image>
    </url>
@endforeach

@foreach($blogs as $blog)
    <url>
        <loc>{{ route('blog.show', $blog->slug) }}</loc>
        <image:image>
            <image:loc>{{ \App\Helpers\FileUrlHelper::get($blog->featured_image) }}</image:loc>
            <image:title><![CDATA[{{ $blog->title }}]]></image:title>
            <image:caption><![CDATA[{{ $blog->meta_description ?: $blog->title }}]]></image:caption>
        </image:image>
    </url>
@endforeach

@foreach($albumImages as $img)
    <url>
        <loc>{{ url('project/' . ($img->album->project->slug ?? $img->album->project->id)) }}</loc>
        <image:image>
            <image:loc>{{ \App\Helpers\FileUrlHelper::get($img->image_path) }}</image:loc>
            <image:title><![CDATA[{{ $img->caption ?? ($img->album->name ?? 'Screenshot') }}]]></image:title>
        </image:image>
    </url>
@endforeach
</urlset>
