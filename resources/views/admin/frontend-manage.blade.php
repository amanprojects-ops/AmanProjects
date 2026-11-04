@extends('layouts.admin')

@section('title', 'Manage Frontend')

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-laptop-code"></i></span>
        Manage Frontend
    </h1>
    <span style="font-size:12px;color:#94a3b8;">
        <i class="fa-solid fa-sliders"></i>
        Customize User Interface & Content
    </span>
</div>

<p style="color:#64748b; font-size:14px; margin-top:-15px; margin-bottom:30px;">
    Quickly access and update content blocks, stats, testimonials, services, and other frontend elements of your website.
</p>

{{-- Frontend Management Cards Grid --}}
<div class="row g-4">
    <!-- Card for Section & Feature Toggles -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.settings.edit') }}#modules" class="frontend-card" style="border: 2px solid #6366f1;">
            <div class="frontend-card-icon" style="background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
                <i class="fa-solid fa-toggle-on"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Enable / Disable Features</h3>
                <p>Toggle visibility of site sections and navbar features.</p>
                <div class="frontend-card-badge" style="color: #4338ca;">
                    <span>Site Controls</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Hero Section -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.hero-settings.edit') }}" class="frontend-card">
            <div class="frontend-card-icon hero-theme">
                <i class="fa-solid fa-heading"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Hero Section</h3>
                <p>Header banner titles, description, CTAs & badges.</p>
                <div class="frontend-card-badge">
                    <span>1 Banner</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Stats -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.stats.index') }}" class="frontend-card">
            <div class="frontend-card-icon stats-theme">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Statistics</h3>
                <p>Key metrics and performance counter figures.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['stats'] }} {{ Str::plural('Item', $stats['stats']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Services -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.services.index') }}" class="frontend-card">
            <div class="frontend-card-icon services-theme">
                <i class="fa-solid fa-server"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Services</h3>
                <p>Features, offerings, and development services.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['services'] }} {{ Str::plural('Service', $stats['services']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Services Settings -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.services-settings.edit') }}" class="frontend-card">
            <div class="frontend-card-icon services-theme" style="background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);">
                <i class="fa-solid fa-sliders"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Services Header & CTA</h3>
                <p>Services badge, title, subtitle & CTA buttons.</p>
                <div class="frontend-card-badge">
                    <span>Section Config</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Pricing Plans -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.plans.index') }}" class="frontend-card">
            <div class="frontend-card-icon plans-theme">
                <i class="fa-solid fa-money-bill"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Pricing Plans</h3>
                <p>Subscription and service pricing structures.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['plans'] }} {{ Str::plural('Plan', $stats['plans']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Testimonials -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.testimonials.index') }}" class="frontend-card">
            <div class="frontend-card-icon testimonials-theme">
                <i class="fa-solid fa-comment-dots"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Testimonials</h3>
                <p>Client reviews, feedback, and success stories.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['testimonials'] }} {{ Str::plural('Review', $stats['testimonials']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Why Choose Us -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.why-choose-uses.index') }}" class="frontend-card">
            <div class="frontend-card-icon why-theme">
                <i class="fa-solid fa-question-circle"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Why Choose Us</h3>
                <p>Selling points, benefits, and differentiators.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['whyChooseUs'] }} {{ Str::plural('Point', $stats['whyChooseUs']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Process Steps -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.process-steps.index') }}" class="frontend-card">
            <div class="frontend-card-icon process-theme">
                <i class="fa-solid fa-list-ol"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Process Steps</h3>
                <p>Workflow steps and project journey phases.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['processSteps'] }} {{ Str::plural('Step', $stats['processSteps']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Skills -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.skills.index') }}" class="frontend-card">
            <div class="frontend-card-icon skills-theme">
                <i class="fa-solid fa-code"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Skills</h3>
                <p>Technologies, expertise, and proficiency metrics.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['skills'] }} {{ Str::plural('Skill', $stats['skills']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Albums -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.albums.index') }}" class="frontend-card">
            <div class="frontend-card-icon albums-theme">
                <i class="fa-solid fa-images"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Albums</h3>
                <p>Gallery photos, media collections, and assets.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['albums'] }} {{ Str::plural('Album', $stats['albums']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card for Social Links -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
        <a href="{{ route('admin.social-links.index') }}" class="frontend-card">
            <div class="frontend-card-icon social-theme">
                <i class="fa-solid fa-share-nodes"></i>
            </div>
            <div class="frontend-card-content">
                <h3>Social Links</h3>
                <p>Social media profile URLs and icons.</p>
                <div class="frontend-card-badge">
                    <span>{{ $stats['socialLinks'] }} {{ Str::plural('Link', $stats['socialLinks']) }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Styling cards for premium frontend management look */
    .frontend-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        text-decoration: none !important;
        color: inherit;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .frontend-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        border-color: #cbd5e1;
    }

    .frontend-card-icon {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .frontend-card-icon::before {
        content: '';
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        top: -40px;
        right: -40px;
    }

    /* Beautiful Theme Gradients */
    .hero-theme { background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%); }
    .stats-theme { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
    .services-theme { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); }
    .plans-theme { background: linear-gradient(135deg, #10b981 0%, #047857 100%); }
    .testimonials-theme { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .why-theme { background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); }
    .process-theme { background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); }
    .skills-theme { background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); }
    .albums-theme { background: linear-gradient(135deg, #14b8a6 0%, #0f766e 100%); }
    .social-theme { background: linear-gradient(135deg, #64748b 0%, #475569 100%); }

    .frontend-card-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .frontend-card-content h3 {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin-top: 0;
        margin-bottom: 8px;
        transition: color 0.2s;
    }

    .frontend-card:hover .frontend-card-content h3 {
        color: #4f46e5;
    }

    .frontend-card-content p {
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
        margin-top: 0;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .frontend-card-badge {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
        font-size: 12.5px;
        font-weight: 600;
        color: #6366f1;
    }

    .frontend-card-badge span {
        background: #f0f3ff;
        padding: 4px 10px;
        border-radius: 12px;
    }

    .frontend-card-badge i {
        transition: transform 0.2s;
    }

    .frontend-card:hover .frontend-card-badge i {
        transform: translateX(4px);
    }
</style>
@endpush
