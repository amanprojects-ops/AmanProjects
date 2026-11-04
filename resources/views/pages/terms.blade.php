@extends('layouts.app')

@php
    $siteName = $data->settings['site_name'] ?? ($settings['site_name'] ?? 'AmanProjects');
    $metaDesc = $data->settings['meta_description'] ?? ($settings['meta_description'] ?? 'Terms and Conditions of using AmanProjects services and website.');
@endphp

@section('title', 'Terms and Conditions | ' . $siteName)
@section('meta_description', $metaDesc)
@section('meta_keywords', $data->settings['meta_keywords'] ?? 'terms and conditions, amanprojects terms, client contracts, software agreement, bihar law')
@section('use_tailwind', true)

@push('styles')
{{-- Structured JSON-LD Data --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "WebPage",
  "@id": "{{ url('/terms') }}/#webpage",
  "url": "{{ url('/terms') }}",
  "name": "Terms and Conditions — {{ $siteName }}",
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
        "name": "Terms & Conditions",
        "item": "{{ url('/terms') }}"
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
    .terms-text h2 {
        font-family: 'Space Grotesk', sans-serif;
        color: #ffffff;
        font-weight: 700;
        font-size: 1.5rem;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        border-left: 3px solid #06b6d4;
        padding-left: 12px;
    }
    .terms-text p {
        color: #94a3b8;
        margin-bottom: 1.25rem;
        font-size: 15px;
        line-height: 1.8;
    }
    .terms-text ul {
        list-disc: inside;
        color: #94a3b8;
        margin-bottom: 1.25rem;
        padding-left: 1.25rem;
        font-size: 15px;
        line-height: 1.8;
    }
    .terms-text li {
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
        <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3" data-aos="fade-down">Legal Agreement</span>
        <h1 class="font-grotesk font-bold text-4xl sm:text-5xl lg:text-6xl text-white mb-6" data-aos="fade-up">
            Terms & <span class="gradient-text">Conditions</span>
        </h1>
        <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Please read these Terms and Conditions carefully before contracting our software development services or buying our digital products.
        </p>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 md:px-8 py-16 relative z-10">
    <div class="grid lg:grid-cols-12 gap-12">
        
        {{-- ===== LEFT: SIDEBAR TOC (3 Columns) ===== --}}
        <aside class="lg:col-span-3 hidden lg:block">
            <div class="glass-card border border-white/5 p-6 sticky top-24">
                <h3 class="font-grotesk font-bold text-sm text-slate-400 uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Table of Contents</h3>
                <nav class="flex flex-col gap-3 text-sm">
                    <a href="#agreement" class="text-slate-400 hover:text-cyan-400 transition-colors">1. Agreement to Terms</a>
                    <a href="#ipr" class="text-slate-400 hover:text-cyan-400 transition-colors">2. Intellectual Property</a>
                    <a href="#contracts" class="text-slate-400 hover:text-cyan-400 transition-colors">3. Client Contracts</a>
                    <a href="#payments" class="text-slate-400 hover:text-cyan-400 transition-colors">4. Payments & Invoicing</a>
                    <a href="#liability" class="text-slate-400 hover:text-cyan-400 transition-colors">5. Liability & Warranty</a>
                    <a href="#termination" class="text-slate-400 hover:text-cyan-400 transition-colors">6. Termination</a>
                    <a href="#governing" class="text-slate-400 hover:text-cyan-400 transition-colors">7. Governing Law</a>
                </nav>
            </div>
        </aside>

        {{-- ===== RIGHT: TERMS CONTENT (9 Columns) ===== --}}
        <article class="lg:col-span-9 glass-card border border-white/5 p-8 md:p-12 terms-text" data-aos="fade-up">
            <div class="text-xs text-slate-500 mb-6">Last updated: {{ date('F d, Y') }}</div>
            
            <p class="text-slate-300 font-medium">
                Welcome to {{ $siteName }}. These Terms and Conditions constitute a legally binding agreement made between you, whether personally or on behalf of an entity ("Client", "User", or "you") and {{ $siteName }} ("Company", "we", "us", or "our"), concerning your access to and use of our website as well as any other media form, website channel, mobile website or mobile application related, linked, or otherwise connected thereto.
            </p>

            <h2 id="agreement">1. Agreement to Terms</h2>
            <p>
                By accessing this website or signing a project proposal with us, you confirm that you have read, understood, and agreed to be bound by all of these Terms and Conditions. If you do not agree with all of these terms, then you are expressly prohibited from using our services and you must discontinue use immediately.
            </p>

            <h2 id="ipr">2. Intellectual Property Rights</h2>
            <p>
                Unless otherwise indicated, all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics on the site (collectively, the "Content") and the trademarks, service marks, and logos contained therein are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws.
            </p>
            <p>
                For custom software development contracts, upon full and final payment of all outstanding invoices, ownership of the custom code and deliverables shall be transferred to the Client, except for core components, libraries, or pre-existing templates developed by us.
            </p>

            <h2 id="contracts">3. Client Contracts & Project Scopes</h2>
            <p>
                Each software project or security audit is governed by a separate, signed Project Proposal/Contract that outlines:
            </p>
            <ul>
                <li>Exact feature specifications and deliverables.</li>
                <li>Milestones, timeline, and delivery dates.</li>
                <li>Testing procedures and post-launch maintenance terms.</li>
            </ul>

            <h2 id="payments">4. Payments & Invoicing</h2>
            <p>
                Unless explicitly agreed in writing, all software development projects require a deposit before development commences.
            </p>
            <p>
                Invoices must be paid within 7 days of receipt. Late payments may result in the immediate suspension of development, deployment, or hosting operations.
            </p>

            <h2 id="liability">5. Limitation of Liability & Warranty</h2>
            <p>
                Our services are provided on an "as-is" and "as-available" basis. While we employ a security-first development approach, no software is entirely immune to zero-day vulnerabilities or server-level breaches. Under no circumstances shall {{ $siteName }} or its engineers be liable to you for consequential or incidental damages.
            </p>

            <h2 id="termination">6. Termination of Services</h2>
            <p>
                Either party may terminate a project contract if the other party breaches any material term and fails to cure such breach within 14 days of written notice.
            </p>

            <h2 id="governing">7. Governing Law & Dispute Resolution</h2>
            <p>
                These Terms and Conditions are governed by and construed in accordance with the laws of the State of Bihar, India. Any legal action or dispute arising under this agreement shall be brought exclusively in the courts located in Saharsa, Bihar, India.
            </p>

            <div class="mt-12 pt-6 border-t border-white/5 text-slate-500 text-sm">
                If you have any questions regarding these Terms, please reach out via our <a href="{{ route('contact') }}" class="text-cyan-400 hover:underline">Contact Page</a>.
            </div>

        </article>
    </div>
</main>

@include('partials.footer')

@endsection
