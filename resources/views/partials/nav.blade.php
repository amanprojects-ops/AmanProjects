@php
    $isHome = request()->routeIs('home');
    $siteName = $settings['site_name'] ?? 'AmanProjects';
    
    // Split site name into two parts for gradient styling
    if (preg_match('/^([A-Z][a-z]+)([A-Z].*)$/', $siteName, $matches)) {
        $firstWord = $matches[1];
        $secondWord = $matches[2];
    } else {
        $parts = explode(' ', $siteName, 2);
        $firstWord = $parts[0] ?? 'Aman';
        $secondWord = $parts[1] ?? 'Projects';
    }
@endphp

{{-- ======================================================
     GLOBAL UNIFIED NAVBAR (Driven by Cached DB Settings)
====================================================== --}}
<header
    id="mainNavbar"
    x-data="{ open: false, scrolled: false }"
    @scroll.window="scrolled = (window.scrollY > 40)"
    :class="scrolled ? 'bg-navy-900/95 backdrop-blur-xl shadow-lg shadow-cyan-500/5 border-b border-cyan-500/10' : 'bg-navy-950/80 backdrop-blur-md border-b border-cyan-500/10'"
    class="sticky top-0 z-50 transition-all duration-300 w-full">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- LOGO / BRAND --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group" aria-label="{{ $siteName }} — Home">
                @if(!empty($settings['logo']))
                    <img src="@fileUrl($settings['logo'])" alt="{{ $siteName }} logo" width="180" height="36" class="h-9 w-auto max-w-[180px] object-contain transition-all duration-200" fetchpriority="high">
                @else
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-cyan-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-cyan-500/30 group-hover:shadow-cyan-500/50 transition-all" aria-hidden="true">
                        <span class="text-white font-bold text-sm">
                            {{ strtoupper(substr($firstWord, 0, 1) . substr($secondWord, 0, 1)) }}
                        </span>
                    </div>
                    <span class="font-bold text-xl text-white tracking-tight">
                        {{ $firstWord }}<span class="text-cyan-400">{{ $secondWord }}</span><span class="text-cyan-500 ml-0.5">.</span>
                    </span>
                @endif
            </a>

            {{-- DESKTOP NAVIGATION LINKS --}}
            <nav class="hidden md:flex items-center gap-1" aria-label="Main navigation">
                <a href="{{ $isHome ? '#home' : route('home') }}"
                   class="px-3.5 py-2 text-slate-300 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/10 transition-all duration-200 relative group flex items-center gap-1.5">
                    <i class="fa-solid fa-house text-xs text-cyan-400/80"></i> Home
                </a>

                @if($settings['services_enabled'] ?? false)
                    <a href="{{ $isHome ? '#services' : route('home') . '#services' }}"
                       class="px-3.5 py-2 text-slate-300 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/10 transition-all duration-200 relative group">
                        Services
                    </a>
                @endif

                @if($settings['about_enabled'] ?? true)
                    <a href="{{ route('about') }}"
                       class="px-3.5 py-2 {{ request()->routeIs('about') ? 'text-cyan-400 bg-cyan-500/10 font-semibold' : 'text-slate-300 hover:text-cyan-400' }} text-sm font-medium rounded-lg hover:bg-cyan-500/10 transition-all duration-200 relative group">
                        About
                    </a>
                @endif

                @if($settings['projects_enabled'] ?? false)
                    <a href="{{ $isHome ? '#products' : route('home') . '#products' }}"
                       class="px-3.5 py-2 text-slate-300 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/10 transition-all duration-200 relative group">
                        Products
                    </a>
                @endif

                @if($settings['skills_enabled'] ?? false)
                    <a href="{{ $isHome ? '#skills' : route('home') . '#skills' }}"
                       class="px-3.5 py-2 text-slate-300 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/10 transition-all duration-200 relative group">
                        Skills
                    </a>
                @endif

                @if($settings['pricing_enabled'] ?? false)
                    <a href="{{ $isHome ? '#pricing' : route('home') . '#pricing' }}"
                       class="px-3.5 py-2 text-slate-300 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/10 transition-all duration-200 relative group">
                        Pricing
                    </a>
                @endif

                @if($settings['blog_enabled'] ?? false)
                    <a href="{{ route('blog') }}"
                       class="px-3.5 py-2 {{ request()->routeIs('blog*') ? 'text-cyan-400 bg-cyan-500/10 font-semibold' : 'text-slate-300 hover:text-cyan-400' }} text-sm font-medium rounded-lg hover:bg-cyan-500/10 transition-all duration-200 relative group flex items-center gap-1.5">
                        <i class="fa-solid fa-newspaper text-xs text-cyan-400/80"></i> Blog
                    </a>
                @endif

                @if($settings['contact_enabled'] ?? true)
                    <a href="{{ route('contact') }}"
                       class="ml-3 px-4 py-2 {{ request()->routeIs('contact') ? 'from-cyan-400 to-indigo-500 ring-2 ring-cyan-400' : 'from-cyan-500 to-indigo-600' }} bg-gradient-to-r text-white text-sm font-semibold rounded-lg shadow-md shadow-cyan-500/20 hover:shadow-cyan-500/40 hover:scale-105 transition-all duration-200 flex items-center gap-1.5">
                        <i class="fa-solid fa-envelope text-xs"></i> Contact
                    </a>
                @endif
            </nav>

            {{-- MOBILE HAMBURGER BUTTON --}}
            <button @click="open = !open" class="md:hidden text-slate-300 hover:text-cyan-400 transition-colors p-2 rounded-lg hover:bg-cyan-500/10" aria-label="Toggle menu" :aria-expanded="open">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- MOBILE DROPDOWN MENU --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden bg-navy-900/95 backdrop-blur-xl border-t border-cyan-500/10 py-4 px-2 space-y-1 rounded-b-2xl shadow-xl">
            
            <a href="{{ $isHome ? '#home' : route('home') }}" @click="open = false" class="block px-4 py-2.5 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-xl text-base font-medium transition-all">
                <i class="fa-solid fa-house w-6 text-cyan-400"></i> Home
            </a>

            @if($settings['services_enabled'] ?? false)
                <a href="{{ $isHome ? '#services' : route('home') . '#services' }}" @click="open = false" class="block px-4 py-2.5 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-xl text-base font-medium transition-all">
                    <i class="fa-solid fa-layer-group w-6 text-cyan-400"></i> Services
                </a>
            @endif

            @if($settings['about_enabled'] ?? true)
                <a href="{{ route('about') }}" @click="open = false" class="block px-4 py-2.5 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-xl text-base font-medium transition-all">
                    <i class="fa-solid fa-user w-6 text-cyan-400"></i> About
                </a>
            @endif

            @if($settings['projects_enabled'] ?? false)
                <a href="{{ $isHome ? '#products' : route('home') . '#products' }}" @click="open = false" class="block px-4 py-2.5 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-xl text-base font-medium transition-all">
                    <i class="fa-solid fa-diagram-project w-6 text-cyan-400"></i> Products & Projects
                </a>
            @endif

            @if($settings['skills_enabled'] ?? false)
                <a href="{{ $isHome ? '#skills' : route('home') . '#skills' }}" @click="open = false" class="block px-4 py-2.5 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-xl text-base font-medium transition-all">
                    <i class="fa-solid fa-code w-6 text-cyan-400"></i> Skills
                </a>
            @endif

            @if($settings['pricing_enabled'] ?? false)
                <a href="{{ $isHome ? '#pricing' : route('home') . '#pricing' }}" @click="open = false" class="block px-4 py-2.5 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-xl text-base font-medium transition-all">
                    <i class="fa-solid fa-tags w-6 text-cyan-400"></i> Pricing
                </a>
            @endif

            @if($settings['blog_enabled'] ?? false)
                <a href="{{ route('blog') }}" @click="open = false" class="block px-4 py-2.5 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-xl text-base font-medium transition-all">
                    <i class="fa-solid fa-newspaper w-6 text-cyan-400"></i> Blog
                </a>
            @endif

            @if($settings['contact_enabled'] ?? true)
                <div class="pt-2">
                    <a href="{{ route('contact') }}" @click="open = false" class="flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-cyan-500 to-indigo-600 text-white text-base font-semibold rounded-xl shadow-lg shadow-cyan-500/20">
                        <i class="fa-solid fa-envelope"></i> Contact Us
                    </a>
                </div>
            @endif
        </div>
    </div>
</header>
