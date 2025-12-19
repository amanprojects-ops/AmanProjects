<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Get settings first to determine what to load
        $settings = $this->getSettings();

        // Load user with profile and active social links
        $user = User::with([
            'profile',
            'socialLinks' => function ($query) {
                $query->where('is_active', true)->orderBy('name');
            }
        ])->first();

        // Base data
        $data = [
            'user' => $user,
            'profile' => $user?->profile,
            'socialLinks' => $user?->socialLinks ?? collect(),
            'settings' => $settings,
        ];

        // Load sections based on settings (avoid unnecessary queries)
        if ($settings['skills_enabled']) {
            $data['skills'] = Skill::where('show', true)
                ->orderBy('category')
                ->orderBy('name')
                ->get();
        }

        if ($settings['projects_enabled']) {
            $data['projects'] = Project::where('status', 'published')
                ->orderByDesc('featured')
                ->latest()
                ->get();
        }

        if ($settings['experience_enabled']) {
            $data['experiences'] = Experience::orderBy('order')
                ->orderByDesc('start_date')
                ->get();
        }

        if ($settings['education_enabled']) {
            $data['educations'] = Education::orderBy('order')
                ->orderByDesc('start_date')
                ->get();
        }

        if ($settings['blog_enabled']) {
            $data['posts'] = Post::with('categories')
                ->where('status', 'published')
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('home', $data);
    }

    public function blog(): View
    {
        $posts = Post::with('categories')
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(10);

        $settings = $this->getSettings();

        return view('blog.index', compact('posts', 'settings'));
    }

    public function blogShow(string $slug): View
    {
        $post = Post::with('categories')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $settings = $this->getSettings();

        return view('blog.show', compact('post', 'settings'));
    }

    public function contact(ContactRequest $request): RedirectResponse
    {
        if ($request->filled('honeypot')) {
            return back();
        }

        Contact::create($request->validated());

        return back()->with('success', 'Thank you for your message. I will get back to you soon!');
    }

    private function getSettings(): array
    {
        return Setting::getMany([
            'site_title' => 'Portfolio',
            'meta_description' => '',
            'meta_keywords' => '',
            'favicon' => '',
            'logo' => '',
            'primary_color' => '#3b82f6',
            'secondary_color' => '#1e40af',
            'about_enabled' => true,
            'skills_enabled' => true,
            'projects_enabled' => true,
            'experience_enabled' => true,
            'education_enabled' => true,
            'blog_enabled' => true,
            'contact_enabled' => true,
        ]);
    }
}
