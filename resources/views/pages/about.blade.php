@extends('layouts.app')

@php
    $siteName = $data->settings['site_name'] ?? ($settings['site_name'] ?? 'AmanProjects');
    $siteTitle = $data->settings['site_title'] ?? ($settings['site_title'] ?? 'AmanProjects — Software Development Agency in Saharsa, Bihar');
    $metaDesc = $data->settings['meta_description'] ?? ($settings['meta_description'] ?? 'AmanProjects builds premium custom software, SaaS platforms, and cybersecurity solutions from Saharsa, Bihar, India.');
    $profile = $data->profile ?? null;
    $user = $data->user ?? null;
    $socialLinks = $data->socialLinks ?? collect();
    $services = $data->services ?? collect();
    $stats = $data->stats ?? collect();
    $whys = $data->whys ?? collect();
@endphp

@section('title', 'About Us | ' . $siteName)
@section('meta_description', $metaDesc)
@section('meta_keywords', $data->settings['meta_keywords'] ?? 'about amanprojects, software agency bihar, technical aman, laravel development bihar, software developer saharsa')
@section('use_tailwind', true)

@push('styles')
{{-- Structured JSON-LD Data for SEO, GEO & AEO --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph": [
    {
      "@type": "AboutPage",
      "@id": "{{ url('/about') }}/#aboutpage",
      "url": "{{ url('/about') }}",
      "name": "About {{ $siteName }}",
      "description": "{{ addslashes($metaDesc) }}",
      "isPartOf": {
        "@type": "WebSite",
        "@id": "{{ url('/') }}/#website"
      },
      "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
          {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ url('/') }}"
          },
          {
            "@type": "ListItem",
            "position": 2,
            "name": "About Us",
            "item": "{{ url('/about') }}"
          }
        ]
      }
    },
    {
      "@type": "Organization",
      "@id": "{{ url('/') }}/#organization",
      "name": "{{ $siteName }}",
      "url": "{{ url('/') }}",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ !empty($data->settings['logo']) ? asset($data->settings['logo']) : asset('assets/og-image.jpg') }}"
      },
      "founder": {
        "@type": "Person",
        "name": "{{ $user->name ?? 'Technical Aman' }}",
        "jobTitle": "{{ $profile->title ?? 'Founder & Lead Software Engineer' }}",
        "url": "{{ $profile->website ?? url('/') }}"
      },
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $profile->location ?? 'Saharsa, Bihar, India' }}",
        "addressLocality": "Saharsa",
        "addressRegion": "Bihar",
        "postalCode": "852201",
        "addressCountry": "IN"
      }
    }
  ]
}
</script>

<style>
    .page-header {
        padding: 8rem 0 4rem;
        background: linear-gradient(180deg, rgba(2, 8, 23, 0.9) 0%, rgba(10, 15, 30, 0.4) 100%);
    }
    .about-content {
        line-height: 1.8;
    }
</style>
@endpush

@section('content')

@include('partials.nav')

{{-- ===== HEADER SECTION ===== --}}
<header class="page-header relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-10 left-10 w-64 h-64 bg-cyan-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-indigo-500/5 rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 md:px-8 text-center relative z-10">
        <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3" data-aos="fade-down">Who We Are</span>
        <h1 class="font-grotesk font-bold text-4xl sm:text-5xl lg:text-6xl text-white mb-6" data-aos="fade-up">
            About <span class="gradient-text">{{ $siteName }}</span>
        </h1>
        <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            {{ $data->settings['hero_subtitle'] ?? 'Custom Software, SaaS Products & Security Solutions from Saharsa, Bihar, India. We turn your ideas into powerful digital products that drive real business results.' }}
        </p>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 md:px-8 py-16 relative z-10">

    {{-- ===== MISSION & COMPANY INTRODUCTION ===== --}}
    <section class="grid lg:grid-cols-2 gap-12 items-center mb-24">
        <div data-aos="fade-right">
            <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-white mb-6">
                Our Mission & <span class="gradient-text">Engineering Vision</span>
            </h2>
            <div class="text-slate-300 space-y-5 about-content">
                <p>
                    <strong>{{ $siteName }}</strong> is a premier software engineering and cybersecurity agency based in {{ $profile->location ?? 'Saharsa, Bihar, India' }}. Founded by <em>{{ $user->name ?? 'Technical Aman' }}</em>, we specialize in constructing high-performance web applications and SaaS platforms.
                </p>
                <p>
                    Unlike standard digital agencies, we enforce a strict <strong>security-first development methodology</strong>. Every database model, REST API endpoint, and Blade UI layout undergoes security assessment to guard against web application exploits (such as SQL Injection, XSS, and CSRF attacks).
                </p>
                <p>
                    Our core mission is to enable growing businesses in Bihar and across India to scale digitally with absolute reliability and high speed.
                </p>
            </div>
        </div>

        {{-- Dynamic Stats or Why Choose Us Cards from Cached DB --}}
        <div class="grid grid-cols-2 gap-5" data-aos="fade-left" data-aos-delay="150">
            @if($whys->isNotEmpty())
                @foreach($whys->take(4) as $why)
                <div class="glass-card border border-white/5 p-6 card-hover text-center">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 mx-auto mb-4">
                        <i class="{{ $why->icon ?? 'fa-solid fa-check' }} text-xl"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">{{ $why->title }}</h3>
                    <p class="text-slate-400 text-sm">{{ $why->description }}</p>
                </div>
                @endforeach
            @else
                <div class="glass-card border border-white/5 p-6 card-hover text-center">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 mx-auto mb-4">
                        <i class="fa-solid fa-shield-halved text-xl"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Security-First</h3>
                    <p class="text-slate-400 text-sm">Every application is fortified using OWASP security standards.</p>
                </div>
                <div class="glass-card border border-white/5 p-6 card-hover text-center">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400 mx-auto mb-4">
                        <i class="fa-solid fa-bolt text-xl"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">High Performance</h3>
                    <p class="text-slate-400 text-sm">Lightweight structures ensure maximum SEO indexability and speed.</p>
                </div>
                <div class="glass-card border border-white/5 p-6 card-hover text-center">
                    <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center text-green-400 mx-auto mb-4">
                        <i class="fa-solid fa-code text-xl"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Modern Tech Stack</h3>
                    <p class="text-slate-400 text-sm">Powered by Laravel, PHP, React, Tailwind, and AWS services.</p>
                </div>
                <div class="glass-card border border-white/5 p-6 card-hover text-center">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400 mx-auto mb-4">
                        <i class="fa-solid fa-globe text-xl"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Made In India</h3>
                    <p class="text-slate-400 text-sm">Engineered in Bihar for startups & clients globally.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ===== DYNAMIC STATS STRIP (from Cached DB Stats) ===== --}}
    @if($stats->isNotEmpty())
    <section class="mb-24" data-aos="fade-up">
        <div class="glass-card border border-cyan-500/10 p-8 rounded-2xl grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @foreach($stats as $st)
            <div>
                <div class="font-grotesk font-bold text-3xl md:text-4xl text-cyan-400 mb-1">{{ $st->value }}</div>
                <div class="text-slate-400 text-sm font-medium">{{ $st->label }}</div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ===== DYNAMIC FOUNDER & PROFILE SECTION ===== --}}
    <section class="mb-24">
        <div class="glass-card border border-cyan-500/10 p-8 md:p-12 relative overflow-hidden" data-aos="fade-up">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-cyan-500/5 rounded-full blur-3xl"></div>
            <div class="grid md:grid-cols-3 gap-8 items-center relative z-10">
                
                {{-- Left: Dynamic User & Profile Image --}}
                <div class="text-center md:border-r md:border-white/10 md:pr-8 flex flex-col items-center">
                    <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-cyan-500 to-indigo-600 p-1 shadow-lg shadow-cyan-500/20 mb-4 overflow-hidden">
                        @if(!empty($profile?->profile_image))
                            <img src="@fileUrl($profile->profile_image)" alt="{{ $user->name ?? 'Founder' }}" class="w-full h-full object-cover rounded-xl">
                        @else
                            <div class="w-full h-full bg-navy-950 rounded-xl flex items-center justify-center text-white text-3xl font-extrabold font-grotesk">
                                {{ strtoupper(substr($user->name ?? 'Aman', 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <h3 class="font-grotesk font-bold text-xl text-white">{{ $user->name ?? 'Technical Aman' }}</h3>
                    <p class="text-cyan-400 text-sm font-medium">{{ $profile->title ?? 'Founder & Lead Software Engineer' }}</p>
                    
                    {{-- Social links dynamically loaded from DB --}}
                    @if($socialLinks->isNotEmpty())
                        <div class="flex flex-wrap justify-center gap-3 mt-4">
                            @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-cyan-400 transition-colors" aria-label="{{ $link->name }}" title="{{ $link->name }}">
                                <i class="{{ $link->icon ?? 'fa-solid fa-link' }} text-lg"></i>
                            </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Right: Bio & Experience --}}
                <div class="col-span-2">
                    <h4 class="font-grotesk font-bold text-xl text-white mb-4">Leadership Bio</h4>
                    <p class="text-slate-300 text-base leading-relaxed mb-4">
                        {{ $profile->bio ?? 'At AmanProjects, we build software that is secure, fast, and scalable. Based in Saharsa, Bihar, we bring enterprise-grade software standards to ambitious companies and startups across India.' }}
                    </p>
                    <div class="flex flex-wrap gap-4 mt-6">
                        <span class="px-3 py-1.5 rounded-lg bg-navy-800 border border-white/5 text-xs text-slate-300 flex items-center gap-1.5">
                            <i class="fa-solid fa-location-dot text-cyan-400"></i> {{ $profile->location ?? 'Saharsa, Bihar, India' }}
                        </span>
                        @if($profile?->phone)
                        <span class="px-3 py-1.5 rounded-lg bg-navy-800 border border-white/5 text-xs text-slate-300 flex items-center gap-1.5">
                            <i class="fa-solid fa-phone text-green-400"></i> {{ $profile->phone }}
                        </span>
                        @endif
                        @if($user?->email)
                        <span class="px-3 py-1.5 rounded-lg bg-navy-800 border border-white/5 text-xs text-slate-300 flex items-center gap-1.5">
                            <i class="fa-solid fa-envelope text-indigo-400"></i> {{ $user->email }}
                        </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== DYNAMIC SERVICES SECTION ===== --}}
    @if($services->isNotEmpty())
    <section class="mb-24" data-aos="fade-up">
        <div class="text-center mb-12">
            <h2 class="font-grotesk font-bold text-3xl text-white">Our Core <span class="gradient-text">Services</span></h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($services->take(6) as $svc)
            <div class="glass-card border border-white/5 p-6 card-hover">
                <div class="w-10 h-10 rounded-lg bg-cyan-500/10 flex items-center justify-center text-cyan-400 mb-4">
                    <i class="{{ $svc->icon ?? 'fa-solid fa-layer-group' }} text-base"></i>
                </div>
                <h3 class="font-bold text-white text-lg mb-2">{{ $svc->title }}</h3>
                <p class="text-slate-400 text-sm leading-relaxed">{{ $svc->description }}</p>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ===== FAQ SECTION (AEO Target) ===== --}}
    <section class="max-w-4xl mx-auto" data-aos="fade-up">
        <h2 class="font-grotesk font-bold text-2xl sm:text-3xl text-center text-white mb-10">
            Frequently Asked <span class="gradient-text">Questions</span>
        </h2>
        <div class="space-y-4">
            @foreach([
                [
                    'What services does ' . $siteName . ' offer?',
                    'We provide end-to-end web application development using Laravel, React, Node.js, SaaS platform building, cybersecurity audits, and RESTful API integrations.'
                ],
                [
                    'Where is ' . $siteName . ' located?',
                    'We are proudly based in ' . ($profile->location ?? 'Saharsa, Bihar, India') . ', serving clients locally across Bihar and globally.'
                ],
                [
                    'How do you secure web applications?',
                    'We implement OWASP security standards, strict CSRF tokens, PDO parameter binding against SQL injection, XSS input filtering, and route throttling.'
                ],
                [
                    'How can I get a consultation or quote?',
                    'You can submit a query on our contact page or directly message us on WhatsApp to discuss your project specifications.'
                ]
            ] as $faq)
            <div x-data="{ open: false }" class="glass-card border border-white/5 overflow-hidden transition-all">
                <button @click="open = !open" class="w-full px-6 py-4 flex items-center justify-between text-left focus:outline-none bg-navy-800/20 hover:bg-navy-800/40">
                    <span class="font-bold text-white text-base md:text-lg">{{ $faq[0] }}</span>
                    <i class="fa-solid" :class="open ? 'fa-chevron-up text-cyan-400' : 'fa-chevron-down text-slate-500'"></i>
                </button>
                <div x-show="open" x-transition class="px-6 py-4 border-t border-white/5 bg-navy-950/20">
                    <p class="text-slate-300 text-sm md:text-base leading-relaxed">{{ $faq[1] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

</main>

@include('partials.footer')

@endsection
