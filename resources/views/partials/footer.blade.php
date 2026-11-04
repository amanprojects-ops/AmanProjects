@php
    $footerSettings = $settings ?? ($data->settings ?? []);
    $siteName = $footerSettings['site_name'] ?? 'AmanProjects';
    $isHome = request()->routeIs('home');
    $ttl = now()->addMinutes(30);

    // Split site name into two parts for gradient styling
    if (preg_match('/^([A-Z][a-z]+)([A-Z].*)$/', $siteName, $matches)) {
        $firstWord = $matches[1];
        $secondWord = $matches[2];
    } else {
        $parts = explode(' ', $siteName, 2);
        $firstWord = $parts[0] ?? 'Aman';
        $secondWord = $parts[1] ?? 'Projects';
    }

    // Resolve user & social links dynamically via Cache
    $user = $user ?? ($data->user ?? null);
    if (!$user) {
        $user = \Illuminate\Support\Facades\Cache::remember('ap_user_data', $ttl, function () {
            return \App\Models\User::with([
                'profile',
                'socialLinks' => function ($query) {
                    $query->where('is_active', true)->orderBy('name');
                }
            ])->first();
        });
    }
    $socialLinks = $user?->socialLinks ?? collect();
    $cleanPhone = preg_replace('/[^0-9]/', '', $user?->profile?->phone ?? '919876543210');

    // Resolve dynamic Services via Cache from DB
    $footerServices = isset($data->services) && $data->services->isNotEmpty() 
        ? $data->services 
        : \Illuminate\Support\Facades\Cache::remember('ap_services', $ttl, function () {
            return \App\Models\Service::all();
        });

    // Resolve dynamic Products/Projects via Cache from DB
    $footerProjects = isset($data->projects) && $data->projects->isNotEmpty() 
        ? $data->projects 
        : \Illuminate\Support\Facades\Cache::remember('ap_projects', $ttl, function () {
            return \App\Models\Project::where('status', 'published')
                ->orderByDesc('featured')
                ->latest()
                ->take(5)
                ->get();
        });
    
    // Dynamic Brand Description from DB Profile bio or Settings
    $footerBio = !empty($user?->profile?->bio) 
        ? \Illuminate\Support\Str::limit($user->profile->bio, 130) 
        : ($footerSettings['meta_description'] ?? 'Building digital excellence from Saharsa, Bihar, India. Custom software, SaaS products, and cybersecurity solutions.');
@endphp

<footer class="relative border-t border-white/5 pt-16 pb-8" style="background: rgba(2,8,23,0.9); z-index: 10;">
    <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #06b6d4, transparent); opacity:0.3;"></div>
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Footer Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-10 mb-12">

            {{-- Brand Column --}}
            <div class="col-span-2 md:col-span-4 lg:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    @if(!empty($footerSettings['logo']))
                        <img src="@fileUrl($footerSettings['logo'])" alt="{{ $siteName }}" class="h-9 w-auto max-w-[180px] object-contain transition-all duration-200">
                    @else
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-cyan-500 to-electric-500 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                            <span class="text-white font-grotesk font-bold text-sm">
                                {{ strtoupper(substr($firstWord, 0, 1) . substr($secondWord, 0, 1)) }}
                            </span>
                        </div>
                        <span class="font-grotesk font-bold text-xl text-white">{{ $firstWord }}<span class="text-cyan-400">{{ $secondWord }}</span><span class="text-cyan-500 ml-0.5">.</span></span>
                    @endif
                </a>
                <p class="text-slate-400 text-sm leading-relaxed mb-5 max-w-xs">
                    {{ $footerBio }}
                </p>

                {{-- Dynamic Social Icons from DB --}}
                <div class="flex items-center gap-3">
                    @if(isset($socialLinks) && $socialLinks->isNotEmpty())
                        @foreach($socialLinks as $link)
                            @php
                                $lowerName = strtolower($link->name);
                                $iconClass = match(true) {
                                    str_contains($lowerName, 'github') => 'fa-brands fa-github text-slate-400 hover:text-white',
                                    str_contains($lowerName, 'youtube') => 'fa-brands fa-youtube text-red-400 hover:text-white',
                                    str_contains($lowerName, 'linkedin') => 'fa-brands fa-linkedin text-blue-400 hover:text-white',
                                    str_contains($lowerName, 'whatsapp') => 'fa-brands fa-whatsapp text-green-400 hover:text-white',
                                    str_contains($lowerName, 'twitter') || str_contains($lowerName, 'x') => 'fa-brands fa-x-twitter text-slate-400 hover:text-white',
                                    str_contains($lowerName, 'facebook') => 'fa-brands fa-facebook text-blue-500 hover:text-white',
                                    str_contains($lowerName, 'instagram') => 'fa-brands fa-instagram text-pink-500 hover:text-white',
                                    default => 'fa-solid fa-link text-cyan-400'
                                };
                                $bgClass = match(true) {
                                    str_contains($lowerName, 'github') => 'bg-white/5 border-white/10 hover:border-white/20',
                                    str_contains($lowerName, 'youtube') => 'bg-red-500/10 border-red-500/20 hover:border-red-500/40 hover:bg-red-500/20',
                                    str_contains($lowerName, 'linkedin') => 'bg-blue-500/10 border-blue-500/20 hover:border-blue-500/40 hover:bg-blue-500/20',
                                    str_contains($lowerName, 'whatsapp') => 'bg-green-500/10 border-green-500/20 hover:border-green-500/40 hover:bg-green-500/20',
                                    str_contains($lowerName, 'twitter') || str_contains($lowerName, 'x') => 'bg-white/5 border-white/10 hover:border-white/20',
                                    str_contains($lowerName, 'facebook') => 'bg-blue-500/10 border-blue-500/20 hover:border-blue-500/40',
                                    str_contains($lowerName, 'instagram') => 'bg-pink-500/10 border-pink-500/20 hover:border-pink-500/40',
                                    default => 'bg-cyan-500/10 border-cyan-500/20 hover:border-cyan-500/40'
                                };
                            @endphp
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                               class="w-9 h-9 rounded-lg {{ $bgClass }} flex items-center justify-center transition-all hover:scale-105" aria-label="{{ $link->name }}" title="{{ $link->name }}">
                                <i class="{{ $iconClass }} text-base"></i>
                            </a>
                        @endforeach
                    @else
                        {{-- Fallback --}}
                        <a href="https://github.com/amanprojects" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all" aria-label="GitHub">
                            <i class="fa-brands fa-github text-base"></i>
                        </a>
                        <a href="https://youtube.com/@SafeBanda" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400 hover:bg-red-500/20 hover:border-red-500/40 transition-all" aria-label="YouTube">
                            <i class="fa-brands fa-youtube text-base"></i>
                        </a>
                        <a href="https://linkedin.com/company/amanprojects" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 hover:bg-blue-500/20 hover:border-blue-500/40 transition-all" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin text-base"></i>
                        </a>
                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer"
                           class="w-9 h-9 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center text-green-400 hover:bg-green-500/20 hover:border-green-500/40 transition-all" aria-label="WhatsApp">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-grotesk font-semibold text-white mb-4 text-sm tracking-wide">Quick Links</h4>
                <ul class="flex flex-col gap-2.5">
                    @foreach([
                        [$isHome ? '#home' : route('home'), 'Home'],
                        [$isHome ? '#services' : route('home') . '#services', 'Services'],
                        [$isHome ? '#products' : route('home') . '#products', 'Products'],
                        [$isHome ? '#pricing' : route('home') . '#pricing', 'Pricing'],
                        [route('blog'), 'Blog'],
                        [route('contact'), 'Contact Us'],
                    ] as [$href, $label])
                    <li><a href="{{ $href }}" class="text-slate-400 text-sm hover:text-cyan-400 transition-colors hover:translate-x-1 inline-block">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Dynamic Services Column from DB --}}
            <div>
                <h4 class="font-grotesk font-semibold text-white mb-4 text-sm tracking-wide">Our Services</h4>
                <ul class="flex flex-col gap-2.5">
                    @if($footerServices->isNotEmpty())
                        @foreach($footerServices as $svc)
                        <li>
                            <a href="{{ $svc->url }}" class="text-slate-400 text-sm hover:text-cyan-400 transition-colors">
                                {{ $svc->title }}
                            </a>
                        </li>
                        @endforeach
                    @else
                        @foreach([
                            ['/website-developer-in-saharsa', 'Web Development'],
                            ['/app-developer-in-saharsa', 'Mobile App Development'],
                            ['/saas-development-in-saharsa', 'SaaS Development'],
                            ['/cybersecurity-services-in-saharsa', 'Ethical Hacking & Security'],
                            ['/api-development-in-saharsa', 'API Development'],
                            ['/software-developer-in-saharsa', 'Custom Software'],
                        ] as [$link, $service])
                        <li>
                            <a href="{{ url($link) }}" class="text-slate-400 text-sm hover:text-cyan-400 transition-colors">
                                {{ $service }}
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Dynamic Products/Projects Column from DB --}}
            <div>
                <h4 class="font-grotesk font-semibold text-white mb-4 text-sm tracking-wide">Products & Projects</h4>
                <ul class="flex flex-col gap-2.5">
                    @if($footerProjects->isNotEmpty())
                        @foreach($footerProjects->take(5) as $proj)
                        <li>
                            <a href="{{ route('project.show', $proj->slug ?? $proj->id) }}" class="text-slate-400 text-sm hover:text-cyan-400 transition-colors">
                                {{ $proj->title }}
                                @if(!empty($proj->tech_stack_tags))
                                    <span class="text-slate-600 text-xs block">{{ \Illuminate\Support\Str::limit($proj->tech_stack_tags, 24) }}</span>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    @else
                        @foreach([
                            ['AP Coaching', 'Coaching SaaS'],
                            ['AP Library', 'Library Booking SaaS'],
                            ['CodeBB', 'Developer Community'],
                            ['SafeBanda', 'YouTube Channel'],
                        ] as [$name, $desc])
                        <li>
                            <a href="{{ $isHome ? '#products' : route('home') . '#products' }}" class="text-slate-400 text-sm hover:text-cyan-400 transition-colors">
                                {{ $name }}
                                <span class="text-slate-600 text-xs block">{{ $desc }}</span>
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

        {{-- Newsletter Strip --}}
        <div class="glass-card border border-cyan-500/10 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-5 mb-10">
            <div>
                <h4 class="font-grotesk font-semibold text-white mb-1">Stay Updated</h4>
                <p class="text-slate-400 text-sm">Get the latest product updates and tech insights in your inbox.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <input type="email" placeholder="Enter your email" id="newsletter-email"
                    class="flex-1 md:w-60 px-4 py-2.5 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 transition-all" style="background:rgba(13,21,38,0.5);">
                <button id="newsletter-submit-btn" class="px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-electric-500 text-white text-sm font-semibold rounded-xl btn-glow transition-all hover:scale-105 whitespace-nowrap">
                    Subscribe
                </button>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-white/5 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-slate-500 text-sm text-center md:text-left">
                &copy; {{ date('Y') }} <span class="text-slate-400 font-medium">{{ $siteName }}</span>. All rights reserved.
                <span class="mx-2 text-slate-700">|</span>
                <a href="{{ route('about') }}" class="text-slate-500 hover:text-cyan-400 text-xs transition-colors">About Us</a>
                <span class="mx-1.5 text-slate-800">&middot;</span>
                <a href="{{ route('contact') }}" class="text-slate-500 hover:text-cyan-400 text-xs transition-colors">Contact Us</a>
                <span class="mx-1.5 text-slate-800">&middot;</span>
                <a href="{{ route('terms') }}" class="text-slate-500 hover:text-cyan-400 text-xs transition-colors">Terms of Service</a>
                <span class="mx-1.5 text-slate-800">&middot;</span>
                <a href="{{ route('privacy') }}" class="text-slate-500 hover:text-cyan-400 text-xs transition-colors">Privacy Policy</a>
            </p>
            <p class="text-slate-500 text-sm flex items-center gap-1">
                Made with
                <svg class="w-4 h-4 text-red-400 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                in <span class="text-orange-400 font-medium">Saharsa, Bihar, India 🇮🇳</span>
            </p>
        </div>
    </div>
</footer>
