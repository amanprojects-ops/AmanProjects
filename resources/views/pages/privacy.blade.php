@extends('layouts.app')

@php
    $siteName = $data->settings['site_name'] ?? ($settings['site_name'] ?? 'AmanProjects');
    $metaDesc = $data->settings['meta_description'] ?? ($settings['meta_description'] ?? 'Privacy Policy of AmanProjects. Understand how we process and protect your personal data.');
    $user = $data->user ?? null;
@endphp

@section('title', 'Privacy Policy | ' . $siteName)
@section('meta_description', $metaDesc)
@section('meta_keywords', $data->settings['meta_keywords'] ?? 'privacy policy, data collection, gdpr bihar, dpdp compliance, data security')
@section('use_tailwind', true)

@push('styles')
{{-- Structured JSON-LD Data --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "WebPage",
  "@id": "{{ url('/privacy') }}/#webpage",
  "url": "{{ url('/privacy') }}",
  "name": "Privacy Policy — {{ $siteName }}",
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
        "name": "Privacy Policy",
        "item": "{{ url('/privacy') }}"
      }
    ]
  }
}
</script>

<style>
    .page-header {
        padding: 8rem 0 4rem;
        background: linear-gradient(180deg, rgba(2, 8, 23, 0.9) 0%, rgba(10, 15, 30, 0.4) 100%);
    }
    .privacy-text h2 {
        font-family: 'Space Grotesk', sans-serif;
        color: #ffffff;
        font-weight: 700;
        font-size: 1.5rem;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        border-left: 3px solid #06b6d4;
        padding-left: 12px;
    }
    .privacy-text p {
        color: #94a3b8;
        margin-bottom: 1.25rem;
        font-size: 15px;
        line-height: 1.8;
    }
    .privacy-text ul {
        list-disc: inside;
        color: #94a3b8;
        margin-bottom: 1.25rem;
        padding-left: 1.25rem;
        font-size: 15px;
        line-height: 1.8;
    }
    .privacy-text li {
        margin-bottom: 0.5rem;
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
        <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3" data-aos="fade-down">Information Safety</span>
        <h1 class="font-grotesk font-bold text-4xl sm:text-5xl lg:text-6xl text-white mb-6" data-aos="fade-up">
            Privacy <span class="gradient-text">Policy</span>
        </h1>
        <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            We value your privacy and trust. Read below to understand how we collect, process, and safeguard your personal information.
        </p>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 md:px-8 py-16 relative z-10">
    <div class="grid lg:grid-cols-12 gap-12">
        
        {{-- ===== LEFT: SIDEBAR TOC (3 Columns) ===== --}}
        <aside class="lg:col-span-3 hidden lg:block">
            <div class="glass-card border border-white/5 p-6 sticky top-24">
                <h3 class="font-grotesk font-bold text-sm text-slate-400 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Privacy Sections</h3>
                <nav class="flex flex-col gap-3 text-sm">
                    <a href="#collect" class="text-slate-400 hover:text-cyan-400 transition-colors">1. Info We Collect</a>
                    <a href="#howuse" class="text-slate-400 hover:text-cyan-400 transition-colors">2. How We Use Info</a>
                    <a href="#cookies" class="text-slate-400 hover:text-cyan-400 transition-colors">3. Cookies & Tracking</a>
                    <a href="#protection" class="text-slate-400 hover:text-cyan-400 transition-colors">4. Data Security</a>
                    <a href="#sharing" class="text-slate-400 hover:text-cyan-400 transition-colors">5. Third-Party Sharing</a>
                    <a href="#rights" class="text-slate-400 hover:text-cyan-400 transition-colors">6. Your Data Rights</a>
                    <a href="#updates" class="text-slate-400 hover:text-cyan-400 transition-colors">7. Policy Changes</a>
                </nav>
            </div>
        </aside>

        {{-- ===== RIGHT: PRIVACY CONTENT (9 Columns) ===== --}}
        <article class="lg:col-span-9 glass-card border border-white/5 p-8 md:p-12 privacy-text" data-aos="fade-up">
            <div class="text-xs text-slate-500 mb-6">Last updated: {{ date('F d, Y') }}</div>
            
            <p class="text-slate-300 font-medium">
                At {{ $siteName }}, accessible from <a href="{{ url('/') }}" class="text-cyan-400 hover:underline">{{ url('/') }}</a>, one of our main priorities is the privacy of our visitors. This Privacy Policy document outlines the types of information collected and recorded by us and how we utilize it.
            </p>

            <h2 id="collect">1. Information We Collect</h2>
            <p>
                We may collect personal data directly from you when you complete our secure contact form, subscribe to our newsletter, or contract our services.
            </p>

            <h2 id="howuse">2. How We Use Your Information</h2>
            <p>
                We utilize your personal details exclusively for ethical business operations, including responding to queries, project delivery, and security monitoring.
            </p>

            <h2 id="cookies">3. Cookies & Tracking Technologies</h2>
            <p>
                We utilize minimal cookies to store preferences and analyze page performance. You can disable cookies through your browser options.
            </p>

            <h2 id="protection">4. Data Security & Storage</h2>
            <p>
                As a security-first agency, we employ OWASP-level data security practices, TLS encryption, and secure database parameters.
            </p>

            <h2 id="sharing">5. Third-Party Sharing</h2>
            <p>
                We do not sell, trade, or lease your personal identification data to third parties.
            </p>

            <h2 id="rights">6. Your Data Rights (GDPR & DPDP Act)</h2>
            <p>
                Under the DPDP Act and GDPR, you have the right to access, rectify, or erase your data records.
            </p>
            @if(!empty($user?->email))
            <p>
                To exercise any data rights, write to us at <a href="mailto:{{ $user->email }}" class="text-cyan-400 hover:underline">{{ $user->email }}</a>.
            </p>
            @endif

            <h2 id="updates">7. Changes to This Privacy Policy</h2>
            <p>
                We may revise this Privacy Policy periodically. Changes are effective immediately upon posting.
            </p>

            <div class="mt-12 pt-6 border-t border-white/5 text-slate-500 text-sm">
                For privacy inquiries or requests, write to us via our <a href="{{ route('contact') }}" class="text-cyan-400 hover:underline">Contact Page</a>.
            </div>

        </article>
    </div>
</main>

@include('partials.footer')

@endsection
