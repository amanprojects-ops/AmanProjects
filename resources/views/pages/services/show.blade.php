@extends('layouts.app')

@php
    $siteName = $data->settings['site_name'] ?? ($settings['site_name'] ?? 'AmanProjects');
    $cleanPhone = preg_replace('/[^0-9]/', '', $data->profile?->phone ?? ($settings['local_business_phone'] ?? '919876543210'));
    $displayPhone = $data->profile?->phone ?? ($settings['local_business_phone'] ?? '+91 98765 43210');
    $pageTitle = $service->meta_title ?: ($service->title . ' in Saharsa | Top Digital Agency Bihar — ' . $siteName);
    $metaDesc = $service->meta_description ?: ($service->desc ?? ('Professional ' . $service->title . ' in Saharsa, Bihar by ' . $siteName));
    $metaKeywords = $service->meta_keywords ?: ($service->title . ', ' . $service->title . ' in Saharsa, web development saharsa, app developer saharsa, software company bihar');
    $serviceColor = $service->color ?: 'from-cyan-500 to-electric-500';
    $whatsappText = urlencode("Hi AmanProjects! I am interested in your {$service->title} service in Saharsa. Let's discuss.");
@endphp

@section('title', $pageTitle)
@section('meta_description', $metaDesc)
@section('meta_keywords', $metaKeywords)
@section('use_tailwind', true)

@php
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Service',
                '@id' => $service->url . '#service',
                'name' => $service->title . ' in Saharsa',
                'serviceType' => $service->title,
                'description' => $service->desc ?? $metaDesc,
                'url' => $service->url,
                'provider' => [
                    '@type' => 'LocalBusiness',
                    '@id' => url('/') . '#organization',
                    'name' => $siteName,
                    'url' => url('/'),
                    'telephone' => '+' . $cleanPhone,
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => $settings['local_business_locality'] ?? 'Saharsa',
                        'addressRegion' => $settings['local_business_region'] ?? 'Bihar',
                        'addressCountry' => 'IN'
                    ],
                    'geo' => [
                        '@type' => 'GeoCoordinates',
                        'latitude' => $settings['local_business_lat'] ?? '25.8835',
                        'longitude' => $settings['local_business_lng'] ?? '86.6006'
                    ]
                ],
                'areaServed' => [
                    ['@type' => 'City', 'name' => 'Saharsa'],
                    ['@type' => 'City', 'name' => 'Supaul'],
                    ['@type' => 'City', 'name' => 'Madhepura'],
                    ['@type' => 'AdministrativeArea', 'name' => 'Bihar']
                ]
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => $service->url . '#breadcrumb',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => url('/#services')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $service->title, 'item' => $service->url]
                ]
            ]
        ]
    ];

    if (!empty($service->faqs) && is_array($service->faqs)) {
        $faqItems = [];
        foreach ($service->faqs as $f) {
            $faqItems[] = [
                '@type' => 'Question',
                'name' => $f['question'] ?? '',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $f['answer'] ?? ''
                ]
            ];
        }
        $schema['@graph'][] = [
            '@type' => 'FAQPage',
            '@id' => $service->url . '#faq',
            'mainEntity' => $faqItems
        ];
    }
@endphp

@push('styles')
{{-- Structured JSON-LD Data for Google Rich Snippets, Local SEO & FAQPage --}}
<script type="application/ld+json">
{!! json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<style>
    .service-content h2 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.85rem;
        font-weight: 700;
        color: #ffffff;
        margin-top: 2.2rem;
        margin-bottom: 1rem;
        line-height: 1.3;
    }
    .service-content h3 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.45rem;
        font-weight: 600;
        color: #22d3ee;
        margin-top: 1.8rem;
        margin-bottom: 0.8rem;
    }
    .service-content p {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #94a3b8;
        margin-bottom: 1.25rem;
    }
    .service-content strong {
        color: #f1f5f9;
        font-weight: 600;
    }
    .service-content ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 1.5rem;
        display: grid;
        gap: 0.75rem;
    }
    .service-content ul li {
        position: relative;
        padding-left: 1.85rem;
        color: #cbd5e1;
        font-size: 1rem;
        line-height: 1.6;
    }
    .service-content ul li::before {
        content: "✓";
        position: absolute;
        left: 0;
        top: 0;
        color: #22d3ee;
        font-weight: 700;
    }
</style>
@endpush

@section('content')
<main class="min-h-screen relative pt-8 pb-20 overflow-hidden" style="background-color: #0a0f1e;">

    {{-- Ambient Ambient Glow Orbs --}}
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-gradient-to-r from-cyan-500/10 via-electric-500/15 to-purple-500/10 blur-[130px] pointer-events-none rounded-full" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">

        {{-- BREADCRUMBS --}}
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-400 mb-8" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-cyan-400 transition-colors">Home</a>
            <span class="text-slate-600">/</span>
            <a href="{{ url('/#services') }}" class="hover:text-cyan-400 transition-colors">Services</a>
            <span class="text-slate-600">/</span>
            <span class="text-cyan-400 font-medium">{{ $service->title }}</span>
        </nav>

        {{-- HERO SECTION --}}
        <header class="mb-16" data-aos="fade-up">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    {{ $service->badge ?: 'Top-Rated in Saharsa, Bihar' }}
                </span>
                <span class="text-xs text-slate-400 font-medium bg-white/5 px-3 py-1 rounded-full border border-white/10">
                    <i class="fa-solid fa-location-dot text-cyan-400 mr-1"></i> Saharsa • Supaul • Madhepura
                </span>
            </div>

            <h1 class="font-grotesk font-extrabold text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white tracking-tight leading-[1.15] mb-6">
                {{ $service->title }} <span class="gradient-text">in Saharsa</span>
            </h1>

            @if($service->tagline)
                <p class="text-xl md:text-2xl text-cyan-300 font-medium font-grotesk mb-4 max-w-4xl">
                    {{ $service->tagline }}
                </p>
            @endif

            <p class="text-slate-300 text-lg md:text-xl leading-relaxed max-w-3xl mb-8">
                {{ $service->desc }}
            </p>

            {{-- Hero Action CTAs --}}
            <div class="flex flex-wrap items-center gap-4 pt-2">
                <a href="https://wa.me/{{ $cleanPhone }}?text={{ $whatsappText }}"
                   target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-white font-semibold rounded-xl shadow-lg shadow-emerald-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    Chat on WhatsApp
                </a>

                <a href="tel:{{ $cleanPhone }}"
                   class="inline-flex items-center gap-2.5 px-6 py-3.5 bg-gradient-to-r from-cyan-500 to-electric-500 hover:from-cyan-400 hover:to-electric-400 text-white font-semibold rounded-xl btn-glow transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <i class="fa-solid fa-phone text-sm"></i>
                    Call {{ $displayPhone }}
                </a>

                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 px-6 py-3.5 glass-card text-white hover:text-cyan-400 font-medium rounded-xl border border-white/10 hover:border-cyan-500/40 transition-all">
                    <span>Send Message</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            {{-- Trust Badges Strip --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-12 pt-8 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm">Lightning Fast</div>
                        <div class="text-slate-400 text-xs">Sub-1s Load Time</div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm">Clean Hand-Code</div>
                        <div class="text-slate-400 text-xs">Zero Bloat / No Templates</div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm">Bank-Grade Security</div>
                        <div class="text-slate-400 text-xs">OWASP Hardened</div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm">Local Saharsa Support</div>
                        <div class="text-slate-400 text-xs">Direct Developer Access</div>
                    </div>
                </div>
            </div>
        </header>

        {{-- KEY CAPABILITIES / FEATURES GRID --}}
        @if(!empty($service->features) && is_array($service->features))
        <section class="mb-20" data-aos="fade-up">
            <div class="text-center md:text-left mb-8">
                <span class="text-cyan-400 text-xs font-semibold tracking-widest uppercase">Core Capabilities</span>
                <h2 class="font-grotesk font-bold text-2xl md:text-3xl text-white mt-1">
                    What You Get with Our {{ $service->title }} in Saharsa
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($service->features as $i => $feat)
                <div class="glass-card p-6 rounded-2xl border border-white/5 hover:border-cyan-500/30 transition-all duration-300 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $serviceColor }} p-0.5 mb-4 shadow-md group-hover:scale-110 transition-transform">
                        <div class="w-full h-full bg-navy-900 rounded-[10px] flex items-center justify-center text-cyan-400 text-sm">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </div>
                    <h3 class="text-white font-grotesk font-semibold text-base mb-2 group-hover:text-cyan-300 transition-colors">
                        {{ $feat }}
                    </h3>
                    <p class="text-slate-400 text-xs leading-relaxed">
                        Engineered to current web standards with maximum uptime, clean architecture, and localized search optimization.
                    </p>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- MAIN DETAILED LONG-FORM CONTENT (600–900 words) --}}
        @if($service->content)
        <section class="mb-20" data-aos="fade-up">
            <div class="glass-card p-8 md:p-12 rounded-3xl border border-white/10 relative overflow-hidden">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-cyan-500/5 rounded-full blur-3xl pointer-events-none"></div>
                <div class="service-content max-w-4xl">
                    {!! $service->content !!}
                </div>
            </div>
        </section>
        @endif

        {{-- DEVELOPMENT PROCESS ROADMAP --}}
        @if(!empty($service->process_steps) && is_array($service->process_steps))
        <section class="mb-20" data-aos="fade-up">
            <div class="text-center mb-12">
                <span class="text-cyan-400 text-xs font-semibold tracking-widest uppercase">Transparent Lifecycle</span>
                <h2 class="font-grotesk font-bold text-2xl md:text-4xl text-white mt-2">
                    Our 5-Stage Development Process
                </h2>
                <p class="text-slate-400 text-base max-w-2xl mx-auto mt-2">
                    How we take your project from initial concept in Saharsa to a published, high-converting product.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                @foreach($service->process_steps as $step)
                <div class="glass-card p-6 rounded-2xl border border-white/5 hover:border-cyan-500/30 transition-all flex flex-col justify-between group">
                    <div>
                        <span class="font-grotesk font-black text-3xl text-cyan-400/40 group-hover:text-cyan-400 transition-colors block mb-3">
                            {{ $step['step'] ?? ('0' . ($loop->index + 1)) }}
                        </span>
                        <h3 class="font-grotesk font-semibold text-white text-base mb-2 group-hover:text-cyan-300 transition-colors">
                            {{ $step['title'] }}
                        </h3>
                        <p class="text-slate-400 text-xs leading-relaxed">
                            {{ $step['desc'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- TRANSPARENT PRICING PACKAGES --}}
        @if(!empty($service->pricing_tiers) && is_array($service->pricing_tiers))
        <section class="mb-20" id="pricing" data-aos="fade-up">
            <div class="text-center mb-12">
                <span class="text-cyan-400 text-xs font-semibold tracking-widest uppercase">Fair & Transparent</span>
                <h2 class="font-grotesk font-bold text-2xl md:text-4xl text-white mt-2">
                    Pricing Packages for Saharsa & Bihar
                </h2>
                <p class="text-slate-400 text-base max-w-2xl mx-auto mt-2">
                    Honest, milestone-based pricing with zero hidden maintenance fees.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($service->pricing_tiers as $plan)
                @php
                    $isFeatured = !empty($plan['is_featured']);
                @endphp
                <div class="glass-card rounded-3xl p-8 border transition-all duration-300 relative flex flex-col justify-between {{ $isFeatured ? 'border-cyan-500/50 shadow-xl shadow-cyan-500/10 scale-[1.02] bg-gradient-to-b from-navy-800/90 to-navy-900/90' : 'border-white/10 hover:border-white/20' }}">
                    @if($isFeatured)
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-cyan-500 to-electric-500 text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md">
                        Recommended Choice
                    </div>
                    @endif

                    <div>
                        <h3 class="font-grotesk font-bold text-xl text-white mb-2">{{ $plan['name'] }}</h3>
                        <p class="text-slate-400 text-xs mb-6 leading-relaxed">{{ $plan['desc'] ?? '' }}</p>

                        <div class="mb-6 pb-6 border-b border-white/10">
                            <span class="font-grotesk font-extrabold text-3xl md:text-4xl text-white">{{ $plan['price'] }}</span>
                            @if(!empty($plan['period']))
                                <span class="text-slate-400 text-xs ml-1">/ {{ $plan['period'] }}</span>
                            @endif
                        </div>

                        @if(!empty($plan['features']) && is_array($plan['features']))
                        <ul class="flex flex-col gap-3 mb-8">
                            @foreach($plan['features'] as $f)
                            <li class="flex items-start gap-2.5 text-xs text-slate-300">
                                <i class="fa-solid fa-check text-cyan-400 mt-0.5 shrink-0"></i>
                                <span>{{ $f }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Hi AmanProjects, I want to inquire about the ' . $plan['name'] . ' for ' . $service->title . ' in Saharsa.') }}"
                       target="_blank" rel="noopener"
                       class="w-full py-3.5 text-center font-semibold rounded-xl transition-all text-sm {{ $isFeatured ? 'bg-gradient-to-r from-cyan-500 to-electric-500 text-white btn-glow' : 'bg-white/10 hover:bg-white/15 text-white' }}">
                        Choose This Package
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- FREQUENTLY ASKED QUESTIONS (FAQ) --}}
        @if(!empty($service->faqs) && is_array($service->faqs))
        <section class="mb-20 max-w-4xl mx-auto" data-aos="fade-up" x-data="{ active: null }">
            <div class="text-center mb-12">
                <span class="text-cyan-400 text-xs font-semibold tracking-widest uppercase">Got Questions?</span>
                <h2 class="font-grotesk font-bold text-2xl md:text-4xl text-white mt-2">
                    Frequently Asked Questions
                </h2>
                <p class="text-slate-400 text-sm max-w-xl mx-auto mt-2">
                    Everything you need to know about our {{ strtolower($service->title) }} in Saharsa and across Bihar.
                </p>
            </div>

            <div class="flex flex-col gap-4">
                @foreach($service->faqs as $i => $faq)
                <div class="glass-card rounded-2xl border border-white/5 overflow-hidden transition-all">
                    <button type="button"
                            @click="active = (active === {{ $i }}) ? null : {{ $i }}"
                            class="w-full p-6 text-left flex items-center justify-between gap-4 transition-colors"
                            :class="active === {{ $i }} ? 'text-cyan-300' : 'text-white hover:text-cyan-300'">
                        <span class="font-grotesk font-semibold text-base md:text-lg">
                            {{ $faq['question'] }}
                        </span>
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center shrink-0 text-cyan-400 text-xs transition-transform duration-300"
                             :class="active === {{ $i }} ? 'rotate-180 bg-cyan-500/20' : ''">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </button>
                    <div x-show="active === {{ $i }}"
                         x-collapse
                         class="px-6 pb-6 text-slate-300 text-sm leading-relaxed border-t border-white/5 pt-4">
                        {{ $faq['answer'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- OTHER SERVICES SHOWCASE --}}
        @if(isset($otherServices) && $otherServices->isNotEmpty())
        <section class="mb-20" data-aos="fade-up">
            <div class="text-center md:text-left mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="text-cyan-400 text-xs font-semibold tracking-widest uppercase">Complete Digital Suite</span>
                    <h2 class="font-grotesk font-bold text-2xl md:text-3xl text-white mt-1">
                        Explore Our Other Services in Saharsa
                    </h2>
                </div>
                <a href="{{ url('/#services') }}" class="text-cyan-400 text-sm font-semibold hover:underline inline-flex items-center gap-1.5">
                    View All Services <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($otherServices->take(3) as $other)
                <a href="{{ $other->url }}" class="glass-card p-6 rounded-2xl border border-white/5 hover:border-cyan-500/30 transition-all duration-300 group block relative">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $other->color ?: 'from-blue-500 to-cyan-500' }} p-0.5 mb-4 shadow-md group-hover:scale-105 transition-transform">
                        <div class="w-full h-full bg-navy-900 rounded-[10px] flex items-center justify-center text-white">
                            @if($other->icon_path)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $other->icon_path }}"/></svg>
                            @else
                                <i class="fa-solid fa-cube text-cyan-400"></i>
                            @endif
                        </div>
                    </div>
                    <h3 class="font-grotesk font-semibold text-lg text-white mb-2 group-hover:text-cyan-300 transition-colors">
                        {{ $other->title }}
                    </h3>
                    <p class="text-slate-400 text-xs line-clamp-2 mb-4 leading-relaxed">
                        {{ $other->desc }}
                    </p>
                    <span class="text-cyan-400 text-xs font-semibold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">
                        Learn More <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- BOTTOM HIGH-CONVERTING CTA BANNER --}}
        <section class="glass-card rounded-3xl p-8 md:p-14 border border-cyan-500/30 text-center relative overflow-hidden bg-gradient-to-br from-cyan-500/10 via-electric-500/5 to-purple-500/10 shadow-2xl" data-aos="fade-up">
            <div class="max-w-3xl mx-auto relative z-10">
                <span class="inline-block text-cyan-400 text-xs font-semibold uppercase tracking-widest px-3 py-1 bg-cyan-500/10 rounded-full border border-cyan-500/20 mb-4">
                    Ready to Scale Your Business?
                </span>
                <h2 class="font-grotesk font-extrabold text-3xl md:text-5xl text-white tracking-tight mb-4">
                    Let's Build Your {{ $service->title }} in Saharsa
                </h2>
                <p class="text-slate-300 text-base md:text-lg mb-8 leading-relaxed">
                    Have questions about timeline, tech stack, or pricing? Contact AmanProjects directly. We offer free on-demand technical consultations for local businesses in Saharsa, Supaul, and Madhepura.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="https://wa.me/{{ $cleanPhone }}?text={{ $whatsappText }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 transition-all hover:scale-105">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                        Direct WhatsApp Chat
                    </a>

                    <a href="tel:{{ $cleanPhone }}"
                       class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-cyan-500 to-electric-500 hover:from-cyan-400 hover:to-electric-400 text-white font-bold rounded-xl btn-glow transition-all hover:scale-105">
                        <i class="fa-solid fa-phone"></i>
                        Call {{ $displayPhone }}
                    </a>

                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 px-8 py-4 glass-card text-white hover:text-cyan-400 font-bold rounded-xl border border-white/20 transition-all">
                        Schedule Consultation
                    </a>
                </div>
            </div>
        </section>

    </div>
</main>
@endsection
