<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ===== PRIMARY META TAGS (SEO Core) ===== --}}
    <title>@yield('title', $settings['site_title'] ?? 'AmanProjects — Software Solutions & Digital Services')</title>
    <meta name="title" content="@yield('title', $settings['site_title'] ?? 'AmanProjects — Software Solutions & Digital Services')">
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'AmanProjects builds premium custom software, SaaS products, and security solutions from Bihar, India.')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['meta_keywords'] ?? 'software company, custom software, saas, laravel, web development, bihar, india, amanprojects')">
    <meta name="author" content="{{ $user->name ?? 'AmanProjects' }}">

    {{-- ===== CRAWLERS + AI OVERVIEW (AIO) ===== --}}
    {{-- max-snippet:-1 → AI models can use full snippet; max-image-preview:large → rich image in AI results --}}
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large">
    <meta name="bingbot" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <meta name="rating" content="general">

    {{-- ===== LOCAL SEO (GEO) ===== --}}
    <meta name="geo.region" content="IN-BR">
    <meta name="geo.placename" content="Saharsa, Bihar, India">
    <meta name="geo.position" content="25.0961;85.3131">
    <meta name="ICBM" content="25.0961, 85.3131">

    {{-- ===== CANONICAL URL ===== --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ===== OPEN GRAPH (GIO — Image in AI search results) ===== --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $settings['site_name'] ?? 'AmanProjects' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'AmanProjects — Software Solutions & Digital Services')">
    <meta property="og:description" content="@yield('meta_description', 'Custom Software, SaaS Products & Security Solutions from Bihar, India.')">
    <meta property="og:image" content="{{ asset('assets/og-image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $settings['site_name'] ?? 'AmanProjects' }} — Software Company Bihar India">
    <meta property="og:locale" content="en_IN">

    {{-- ===== TWITTER / X CARD ===== --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('title', 'AmanProjects — Software Solutions')">
    <meta name="twitter:description" content="@yield('meta_description', 'Custom Software, SaaS Products & Security Solutions from Bihar, India.')">
    <meta name="twitter:image" content="{{ asset('assets/og-image.jpg') }}">
    <meta name="twitter:creator" content="@AmanProjects">

    {{-- ===== FAVICON ===== --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($settings['favicon'] ?? '') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($settings['favicon'] ?? '') }}">
    <link rel="apple-touch-icon" href="{{ asset($settings['favicon'] ?? '') }}">
    <meta name="theme-color" content="#0a0f1e">
    <meta name="msapplication-TileColor" content="#0a0f1e">

    {{-- ===== DNS PREFETCH + PRECONNECT (Performance — reduce CDN latency) ===== --}}
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdn.tailwindcss.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//unpkg.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    {{-- ===== GOOGLE FONTS — Preloaded for zero-FOIT ===== --}}
    {{-- Preload the most-used font weight first --}}
    <link rel="preload" as="style"
          href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    </noscript>

    {{-- ===== TAILWIND CSS CDN ===== --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': {
                            950: '#020817',
                            900: '#0a0f1e',
                            800: '#0d1526',
                            700: '#111827',
                            600: '#1a2440',
                        },
                        'cyan': {
                            400: '#22d3ee',
                            500: '#06b6d4',
                            600: '#0891b2',
                        },
                        'electric': {
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                        }
                    },
                    fontFamily: {
                        'grotesk': ['Space Grotesk', 'sans-serif'],
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 5px #06b6d4, 0 0 10px #06b6d4' },
                            '100%': { boxShadow: '0 0 20px #06b6d4, 0 0 40px #06b6d4, 0 0 60px #06b6d4' },
                        }
                    },
                    backdropBlur: {
                        xs: '2px',
                    }
                }
            }
        }
    </script>

    {{-- ===== AOS — Animate On Scroll (non-blocking) ===== --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"></noscript>

    {{-- ===== SWIPER JS ===== --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- ===== FONT AWESOME (non-blocking) ===== --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          crossorigin="anonymous"
          referrerpolicy="no-referrer"
          media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              crossorigin="anonymous">
    </noscript>

    {{-- ===== LEGACY STYLES (for portfolio pages) ===== --}}
    @hasSection('use_tailwind')
    @else
        <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    @endif

    {{-- ===== CUSTOM GLOBAL STYLES ===== --}}
    <style>
        :root {
            --primary-bg: #0a0f1e;
            --card-bg: rgba(13, 21, 38, 0.7);
            --border-glass: rgba(6, 182, 212, 0.15);
            --accent-cyan: #06b6d4;
            --accent-blue: #0ea5e9;
            --text-muted: #94a3b8;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            background-color: #0a0f1e;
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Glassmorphism utility */
        .glass-card {
            background: rgba(13, 21, 38, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(6, 182, 212, 0.12);
            border-radius: 1rem;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #06b6d4, #0ea5e9, #38bdf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Cyan glow button */
        .btn-glow {
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(6, 182, 212, 0.4);
            transition: all 0.3s ease;
        }
        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(6, 182, 212, 0.7), 0 0 60px rgba(6, 182, 212, 0.3);
            transform: translateY(-2px);
        }

        /* Card hover glow */
        .card-hover:hover {
            border-color: rgba(6, 182, 212, 0.5) !important;
            box-shadow: 0 0 25px rgba(6, 182, 212, 0.15), inset 0 0 25px rgba(6, 182, 212, 0.03);
            transform: translateY(-4px);
            transition: all 0.3s ease;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0f1e; }
        ::-webkit-scrollbar-thumb { background: #06b6d4; border-radius: 3px; }

        /* Section divider gradient */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #06b6d4, transparent);
        }

        /* Swiper custom arrows */
        .swiper-button-next, .swiper-button-prev {
            color: #06b6d4 !important;
        }
        .swiper-pagination-bullet-active {
            background: #06b6d4 !important;
        }

        /* Improve LCP — prevent layout shift on images */
        img { max-width: 100%; height: auto; }
    </style>

    {{-- ===== JSON-LD STRUCTURED DATA (GIO + AIO) ===== --}}
    @php
        $schemaName        = $settings['site_name'] ?? 'AmanProjects';
        $schemaDescription = $settings['meta_description'] ?? 'AmanProjects builds premium custom software, SaaS products, and cybersecurity solutions from Bihar, India. Trusted by clients across India for Web Development, API Integration, and more.';
        $schemaUrl         = url('/');
        $schemaLogo        = !empty($settings['logo']) ? asset($settings['logo']) : asset('assets/og-image.jpg');
        $schemaPhone       = !empty($settings['local_business_phone']) ? $settings['local_business_phone'] : ($user->profile?->phone ?? '');
        $schemaEmail       = !empty($settings['local_business_email']) ? $settings['local_business_email'] : ($user->profile?->email ?? $user->email ?? '');
        $schemaLocation    = !empty($settings['local_business_address']) ? $settings['local_business_address'] : ($user->profile?->location ?? 'Saharsa, Bihar, India');
        $schemaLat         = !empty($settings['local_business_lat']) ? $settings['local_business_lat'] : '25.0961';
        $schemaLng         = !empty($settings['local_business_lng']) ? $settings['local_business_lng'] : '85.3131';
        $socialLinks       = $user->socialLinks ?? collect();
        $sameAs            = $socialLinks->pluck('url')->filter()->values()->toArray();
    @endphp

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@graph": [
            {
                "@type": ["Organization", "LocalBusiness", "ProfessionalService"],
                "@id": "{{ $schemaUrl }}/#organization",
                "name": "{{ $schemaName }}",
                "alternateName": ["Aman Saharsa", "Aman Projects", "Aman Projects Saharsa", "Aman Projects Bihar"],
                "url": "{{ $schemaUrl }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ $schemaLogo }}",
                    "width": 400,
                    "height": 400
                },
                "image": "{{ asset('assets/og-image.jpg') }}",
                "description": "{{ $schemaDescription }}",
                "telephone": "{{ $schemaPhone }}",
                "email": "{{ $schemaEmail }}",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "{{ $schemaLocation }}",
                    "addressCountry": "IN"
                },
                "geo": {
                    "@type": "GeoCoordinates",
                    "latitude": "{{ $schemaLat }}",
                    "longitude": "{{ $schemaLng }}"
                },
                "areaServed": ["Bihar", "India", "Worldwide"],
                "serviceType": ["Custom Software Development", "SaaS Development", "Cybersecurity", "Web Development", "API Integration"],
                "priceRange": "₹₹",
                "openingHoursSpecification": [
                    {
                        "@type": "OpeningHoursSpecification",
                        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
                        "opens": "09:00",
                        "closes": "19:00"
                    },
                    {
                        "@type": "OpeningHoursSpecification",
                        "dayOfWeek": "Saturday",
                        "opens": "10:00",
                        "closes": "16:00"
                    }
                ],
                "sameAs": {!! json_encode($sameAs) !!},
                "knowsLanguage": ["en", "hi"],
                "foundingLocation": {
                    "@type": "Place",
                    "name": "Bihar, India"
                }
            },
            {
                "@type": "WebSite",
                "@id": "{{ $schemaUrl }}/#website",
                "url": "{{ $schemaUrl }}",
                "name": "{{ $schemaName }}",
                "description": "{{ $schemaDescription }}",
                "publisher": {
                    "@id": "{{ $schemaUrl }}/#organization"
                },
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": {
                        "@type": "EntryPoint",
                        "urlTemplate": "{{ $schemaUrl }}/blog?q={search_term_string}"
                    },
                    "query-input": "required name=search_term_string"
                }
            },
            {
                "@type": "WebPage",
                "@id": "{{ url()->current() }}/#webpage",
                "url": "{{ url()->current() }}",
                "name": "@yield('title', $settings['site_title'] ?? 'AmanProjects')",
                "isPartOf": { "@id": "{{ $schemaUrl }}/#website" },
                "about": { "@id": "{{ $schemaUrl }}/#organization" },
                "description": "{{ $schemaDescription }}",
                "breadcrumb": {
                    "@type": "BreadcrumbList",
                    "itemListElement": [
                        {
                            "@type": "ListItem",
                            "position": 1,
                            "name": "Home",
                            "item": "{{ $schemaUrl }}"
                        }
                    ]
                }
            },
            {
                "@type": "FAQPage",
                "@id": "{{ $schemaUrl }}/#faqpage",
                "mainEntity": [
                    {
                        "@type": "Question",
                        "name": "What services does AmanProjects offer?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "AmanProjects offers custom software development, SaaS platform development, ethical hacking & cybersecurity audits, RESTful & GraphQL API development, and custom ERP/CRM solutions for startups and enterprises across India."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Is AmanProjects based in Bihar, India?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Yes. AmanProjects is a software company proudly based in Bihar, India. We serve clients across India and globally, delivering premium digital products remotely."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "What technologies does AmanProjects use?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "We specialize in Laravel (PHP), React, Node.js, MySQL, REST APIs, and cloud infrastructure on AWS and DigitalOcean. We follow security-first development practices."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "How much does a web application cost at AmanProjects?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Our pricing starts at ₹4,999/month for basic web applications. SaaS platforms and enterprise software are priced per project. Contact us for a free custom quote."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "Does AmanProjects provide cybersecurity services?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "Yes. We provide professional penetration testing, OWASP-based security audits, vulnerability assessments, and security consulting for web applications and APIs."
                        }
                    },
                    {
                        "@type": "Question",
                        "name": "How can I contact AmanProjects?",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "You can reach AmanProjects via the contact form on our website, by email, or on WhatsApp. We typically respond within 1 hour during business hours (Mon–Fri, 9 AM–7 PM IST)."
                        }
                    }
                ]
            }
        ]
    }
    </script>

    @stack('styles')
</head>
<body class="bg-navy-900 text-slate-200 font-inter antialiased">

    {{-- ===== ANIMATED BACKGROUND GRID ===== --}}
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden" aria-hidden="true">
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(6,182,212,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(6,182,212,0.03) 1px, transparent 1px); background-size: 64px 64px;"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-electric-500/5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-cyan-400/3 rounded-full blur-2xl animate-float"></div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="relative z-10">
        @yield('content')
    </div>

    {{-- ===== ALPINE JS (defer — non-blocking) ===== --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- ===== AOS JS (defer — non-blocking) ===== --}}
    <script defer src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    {{-- ===== SWIPER JS ===== --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>

    {{-- ===== LEGACY SCRIPTS (portfolio pages) ===== --}}
    @hasSection('use_tailwind')
    @else
        <script src="{{ asset('js/frontend.js') }}"></script>
    @endif

    {{-- ===== GLOBAL SCRIPTS ===== --}}
    <script>
        // Init AOS after DOM is ready
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 80,
                });
            } else {
                // Fallback: wait for AOS to load (deferred)
                window.addEventListener('load', function() {
                    if (typeof AOS !== 'undefined') AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true, offset: 80 });
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
