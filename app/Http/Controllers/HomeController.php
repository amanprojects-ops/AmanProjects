<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Cache TTL constants
     */
    const CACHE_SETTINGS_TTL  = 60;   // minutes
    const CACHE_HOME_DATA_TTL = 30;   // minutes

    /**
     * Home page — cache-first, lightning-fast data delivery.
     * All heavy DB queries are cached; only contact session is live.
     */
    public function index(): View
    {
        $settings = $this->getSettings();

        // Load full page data from granular caches
        $data = $this->buildPageData($settings);

        // Pre-compute display helpers (these are pure functions, no DB)
        $siteNameParts = $this->splitSiteName($data->settings['site_name'] ?? 'AmanProjects');
        $cleanPhone    = $this->cleanPhone($data->profile?->phone ?? '919876543210');
        $heroProjects  = $this->buildHeroProjects($data);

        return view('welcome', compact('data', 'siteNameParts', 'cleanPhone', 'heroProjects'));
    }

    // =========================================================================
    // BLOG
    // =========================================================================

    public function blog(): View
    {
        $posts    = Post::with('categories')
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

    // =========================================================================
    // CONTACT
    // =========================================================================

    public function contact(ContactRequest $request): RedirectResponse
    {
        // Honeypot bot-trap
        if ($request->filled('honeypot')) {
            return back();
        }

        Contact::create($request->validated());

        return back()->with('success', 'Thank you for your message. I will get back to you soon!');
    }

    // =========================================================================
    // PRIVATE — CACHE HELPERS
    // =========================================================================

    /**
     * Build the complete page data object using granular caching.
     */
    private function buildPageData(array $settings): object
    {
        $ttl = now()->addMinutes(self::CACHE_HOME_DATA_TTL);

        // Load user with profile and active social links (single query)
        $user = Cache::remember('ap_user_data', $ttl, function () {
            return User::with([
                'profile',
                'socialLinks' => function ($query) {
                    $query->where('is_active', true)->orderBy('name');
                }
            ])->first();
        });

        $data = (object) [
            'user'        => $user,
            'profile'     => $user?->profile,
            'socialLinks' => $user?->socialLinks ?? collect(),
            'settings'    => $settings,
        ];

        // Conditional section loading
        if ($settings['skills_enabled']) {
            $data->skills = Cache::remember('ap_skills', $ttl, function () {
                return Skill::where('show', true)
                    ->orderBy('category')
                    ->orderBy('name')
                    ->get();
            });
        }

        if ($settings['projects_enabled']) {
            $data->projects = Cache::remember('ap_projects', $ttl, function () {
                return Project::where('status', 'published')
                    ->orderByDesc('featured')
                    ->latest()
                    ->get();
            });
        }

        if ($settings['blog_enabled']) {
            $data->posts = Cache::remember('ap_posts', $ttl, function () {
                return Post::with('categories')
                    ->where('status', 'published')
                    ->latest('published_at')
                    ->take(3)
                    ->get();
            });
        }

        if ($settings['stats_enabled']) {
            $data->stats = Cache::remember('ap_stats', $ttl, function () {
                return \App\Models\Stat::all();
            });
        }

        if ($settings['services_enabled']) {
            $data->services = Cache::remember('ap_services', $ttl, function () {
                return \App\Models\Service::all();
            });
        }

        if ($settings['pricing_enabled']) {
            $data->plans = Cache::remember('ap_plans', $ttl, function () {
                return \App\Models\Plan::all();
            });
        }

        if ($settings['testimonials_enabled']) {
            $data->testimonials = Cache::remember('ap_testimonials', $ttl, function () {
                return \App\Models\Testimonial::all();
            });
        }

        if ($settings['why_us_enabled']) {
            $data->whys = Cache::remember('ap_whys', $ttl, function () {
                return \App\Models\WhyChooseUs::all();
            });
        }

        if ($settings['how_we_work_enabled']) {
            $data->steps = Cache::remember('ap_steps', $ttl, function () {
                return \App\Models\ProcessStep::orderBy('num')->get();
            });
        }

        return $data;
    }

    /**
     * Settings — cached separately with longer TTL.
     * Admin can flush via Cache::forget('ap_settings') on save.
     */
    private function getSettings(): array
    {
        return Cache::remember('ap_settings', now()->addMinutes(self::CACHE_SETTINGS_TTL), function () {
            return Setting::getMany([
                'site_name'            => 'AmanProjects',
                'site_title'           => 'AmanProjects | Custom Software & Web Development in Saharsa, Bihar',
                'meta_description'     => 'AmanProjects (Aman Saharsa) is a leading software company based in Saharsa, Bihar. We specialize in custom software, SaaS products, web development, and cybersecurity solutions.',
                'meta_keywords'        => 'aman projects, aman saharsa, aman projects saharsa, aman projects saharsa bihar, aman projects bihar, software company saharsa, web development bihar, technical aman, laravel developer bihar',
                'favicon'              => '',
                'logo'                 => '',
                'primary_color'        => '#3b82f6',
                'secondary_color'      => '#1e40af',
                'about_enabled'        => true,
                'skills_enabled'       => true,
                'projects_enabled'     => true,
                'how_we_work_enabled'  => true,
                'blog_enabled'         => true,
                'contact_enabled'      => true,
                'stats_enabled'        => true,
                'services_enabled'     => true,
                'pricing_enabled'      => true,
                'testimonials_enabled' => true,
                'why_us_enabled'       => true,
                'hero_badge'           => 'Trusted Software Partner from Saharsa, Bihar',
                'hero_title_line1'     => 'We Build.',
                'hero_title_line2'     => 'We Scale.',
                'hero_title_line3'     => 'We Secure.',
                'hero_subtitle'        => 'AmanProjects is a premium digital agency in Saharsa, Bihar. We turn your ideas into powerful custom software, SaaS products, and security solutions that drive real business results.',
                'hero_cta1_text'       => 'View Demo',
                'hero_cta1_link'       => '#products',
                'hero_cta2_text'       => 'View Products',
                'hero_cta2_link'       => '#products',
                'hero_trust1'          => '20+ Projects Delivered',
                'hero_trust2'          => 'Security-First Approach',
                'hero_trust3'          => 'Made in India 🇮🇳',
                'services_badge'       => 'What We Do',
                'services_title'       => 'Our Services',
                'services_subtitle'    => 'We deliver end-to-end digital solutions tailored for startups, SMBs, and enterprises — built for performance, security, and scale.',
                'services_cta_title'   => 'Need Something Custom?',
                'services_cta_desc'    => "Every great product starts with a conversation. Let's discuss yours.",
                'services_cta_btn_text'=> 'Start a Project',
                'services_cta_btn_link'=> '#contact',
            ]);
        });
    }

    // =========================================================================
    // PRIVATE — VIEW HELPERS (pure, no DB, not cached — computed per request)
    // =========================================================================

    /**
     * Split site name into two parts for styled logo rendering.
     * e.g. "AmanProjects" → ['Aman', 'Projects']
     */
    private function splitSiteName(string $siteName): array
    {
        if (preg_match('/^([A-Z][a-z]+)([A-Z].*)$/', $siteName, $matches)) {
            return [$matches[1], $matches[2]];
        }
        if (str_contains($siteName, ' ')) {
            $parts = explode(' ', $siteName, 2);
            return [$parts[0], $parts[1]];
        }
        return [$siteName, ''];
    }

    /**
     * Strip non-numeric chars from phone for wa.me links.
     */
    private function cleanPhone(string $phone): string
    {
        return preg_replace('/[^0-9]/', '', $phone);
    }

    /**
     * Build hero carousel project cards.
     * Falls back to static demo projects if none exist.
     */
    private function buildHeroProjects(object $data): array
    {
        $colors = [
            'from-cyan-600 to-blue-700',
            'from-purple-600 to-indigo-700',
            'from-red-600 to-orange-700',
            'from-emerald-600 to-teal-700',
            'from-yellow-600 to-amber-700',
        ];

        $icons = [
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
        ];

        if (isset($data->projects) && $data->projects->isNotEmpty()) {
            return $data->projects->map(function ($proj, $idx) use ($colors, $icons) {
                return [
                    'name'      => $proj->title,
                    'desc'      => \Illuminate\Support\Str::limit($proj->description ?? '', 80),
                    'color'     => $colors[$idx % count($colors)],
                    'icon'      => $icons[$idx % count($icons)],
                    'url'       => $proj->live_demo_link ?? '#products',
                    'thumbnail' => $proj->thumbnail_image,
                    'slug'      => \Illuminate\Support\Str::slug($proj->title),
                ];
            })->toArray();
        }

        // Static fallback
        return [
            ['name' => 'AP Coaching',  'desc' => 'Coaching Centre Management SaaS',  'color' => $colors[0], 'icon' => $icons[0], 'url' => '#products', 'thumbnail' => null, 'slug' => 'ap-coaching'],
            ['name' => 'AP Library',   'desc' => 'Library Seat Booking Platform',    'color' => $colors[1], 'icon' => $icons[1], 'url' => '#products', 'thumbnail' => null, 'slug' => 'ap-library'],
            ['name' => 'SecureAudit',  'desc' => 'Cybersecurity Audit Dashboard',    'color' => $colors[2], 'icon' => $icons[2], 'url' => '#products', 'thumbnail' => null, 'slug' => 'secureaudit'],
            ['name' => 'API Gateway',  'desc' => 'Enterprise REST API Platform',     'color' => $colors[3], 'icon' => $icons[3], 'url' => '#products', 'thumbnail' => null, 'slug' => 'api-gateway'],
            ['name' => 'BizFlow ERP',  'desc' => 'Custom ERP for SMBs',              'color' => $colors[4], 'icon' => $icons[4], 'url' => '#products', 'thumbnail' => null, 'slug' => 'bizflow-erp'],
        ];
    }

    /**
     * Render a headline line with the last word wrapped in gradient-text span.
     * Used by the view for hero + section headings.
     */
    public static function renderHeadline(?string $line): string
    {
        if (empty($line)) return '';
        $words = explode(' ', trim($line));
        if (count($words) > 1) {
            $last = array_pop($words);
            return implode(' ', $words) . ' <span class="gradient-text">' . e($last) . '</span>';
        }
        return '<span class="gradient-text">' . e($line) . '</span>';
    }

    // =========================================================================
    // PUBLIC STATIC — Cache Flush (call from admin observers/controllers)
    // =========================================================================

    /**
     * Flush all home page caches.
     * Call this whenever settings or any home-page model is saved.
     *
     * Example in an Observer: HomeController::flushCache();
     */
    public static function flushCache(?string $key = null): void
    {
        if ($key) {
            Cache::forget($key);
        } else {
            // Flush all if no specific key is provided
            $keys = [
                'ap_settings', 'ap_user_data', 'ap_skills', 'ap_projects',
                'ap_posts', 'ap_stats', 'ap_services', 'ap_plans',
                'ap_testimonials', 'ap_whys', 'ap_steps'
            ];
            foreach ($keys as $k) {
                Cache::forget($k);
            }
        }
    }
}
