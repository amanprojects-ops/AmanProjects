<?php

namespace App\Http\Controllers;

use App\Models\AlbumImage;
use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->view('sitemap.categories', compact('categories'))->header('Content-Type', 'text/xml');
    }

    public function projects()
    {
        $projects = Project::published()->get();
        return response()->view('sitemap.projects', compact('projects'))->header('Content-Type', 'text/xml');
    }

    public function blogs()
    {
        $blogs = Post::where('status', 'published')->get();
        return response()->view('sitemap.blogs', compact('blogs'))->header('Content-Type', 'text/xml');
    }

    public function images()
    {
        $projects = Project::published()->whereNotNull('thumbnail_image')->get();
        $blogs = Post::where('status', 'published')->whereNotNull('featured_image')->get();
        $albumImages = AlbumImage::with('album.project')->get();

        return response()->view('sitemap.images', compact('projects', 'blogs', 'albumImages'))->header('Content-Type', 'text/xml');
    }

    public function local()
    {
        $settings = Setting::getMany([
            'site_name' => config('app.name'),
            'local_business_address' => '',
            'local_business_phone' => '',
            'local_business_email' => '',
            'local_business_lat' => '',
            'local_business_lng' => '',
        ]);

        return response()->view('sitemap.local', compact('settings'))->header('Content-Type', 'text/xml');
    }
}
