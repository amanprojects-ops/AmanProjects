@extends('layouts.admin')

@section('title', 'Hero Section Settings')
@section('page_title', '<span>Hero</span> Settings')

@section('content')

<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-heading"></i></span>
        Hero Section Settings
    </h1>
    <a href="{{ route('admin.frontend-manage') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Back to Frontend Manage
    </a>
</div>

<form action="{{ route('admin.hero-settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">

            {{-- Headline & Subtitle --}}
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-font" style="color:#6366f1;"></i> Hero Headline & Intro</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">
                    <div>
                        <label for="hero_badge" class="form-label-custom">Hero Badge Text</label>
                        <input type="text" name="hero_badge" id="hero_badge" value="{{ old('hero_badge', $settings['hero_badge']) }}"
                            class="form-control-custom" placeholder="e.g. Trusted Software Partner from Bihar, India">
                        @error('hero_badge')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
                        <div>
                            <label for="hero_title_line1" class="form-label-custom">Title Line 1</label>
                            <input type="text" name="hero_title_line1" id="hero_title_line1" value="{{ old('hero_title_line1', $settings['hero_title_line1']) }}"
                                class="form-control-custom" placeholder="e.g. We Build.">
                            @error('hero_title_line1')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="hero_title_line2" class="form-label-custom">Title Line 2</label>
                            <input type="text" name="hero_title_line2" id="hero_title_line2" value="{{ old('hero_title_line2', $settings['hero_title_line2']) }}"
                                class="form-control-custom" placeholder="e.g. We Scale.">
                            @error('hero_title_line2')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="hero_title_line3" class="form-label-custom">Title Line 3</label>
                            <input type="text" name="hero_title_line3" id="hero_title_line3" value="{{ old('hero_title_line3', $settings['hero_title_line3']) }}"
                                class="form-control-custom" placeholder="e.g. We Secure.">
                            @error('hero_title_line3')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="hero_subtitle" class="form-label-custom">Hero Subtitle</label>
                        <textarea name="hero_subtitle" id="hero_subtitle" rows="4"
                            class="form-control-custom" style="resize:vertical;" placeholder="Write a short introductory paragraph…">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
                        @error('hero_subtitle')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Call To Action Buttons --}}
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-arrow-pointer" style="color:#6366f1;"></i> Call To Action Buttons</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label for="hero_cta1_text" class="form-label-custom">CTA Button 1 Text</label>
                            <input type="text" name="hero_cta1_text" id="hero_cta1_text" value="{{ old('hero_cta1_text', $settings['hero_cta1_text']) }}"
                                class="form-control-custom" placeholder="e.g. View Demo">
                            @error('hero_cta1_text')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="hero_cta1_link" class="form-label-custom">CTA Button 1 Link</label>
                            <input type="text" name="hero_cta1_link" id="hero_cta1_link" value="{{ old('hero_cta1_link', $settings['hero_cta1_link']) }}"
                                class="form-control-custom" placeholder="e.g. #products">
                            @error('hero_cta1_link')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label for="hero_cta2_text" class="form-label-custom">CTA Button 2 Text</label>
                            <input type="text" name="hero_cta2_text" id="hero_cta2_text" value="{{ old('hero_cta2_text', $settings['hero_cta2_text']) }}"
                                class="form-control-custom" placeholder="e.g. View Products">
                            @error('hero_cta2_text')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="hero_cta2_link" class="form-label-custom">CTA Button 2 Link</label>
                            <input type="text" name="hero_cta2_link" id="hero_cta2_link" value="{{ old('hero_cta2_link', $settings['hero_cta2_link']) }}"
                                class="form-control-custom" placeholder="e.g. #products">
                            @error('hero_cta2_link')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            {{-- Trust Badges --}}
            <div class="form-section">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-shield-halved" style="color:#6366f1;"></i> Trust Indicators</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">
                    <div>
                        <label for="hero_trust1" class="form-label-custom">Indicator 1</label>
                        <input type="text" name="hero_trust1" id="hero_trust1" value="{{ old('hero_trust1', $settings['hero_trust1']) }}"
                            class="form-control-custom" placeholder="e.g. 20+ Projects Delivered">
                        @error('hero_trust1')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="hero_trust2" class="form-label-custom">Indicator 2</label>
                        <input type="text" name="hero_trust2" id="hero_trust2" value="{{ old('hero_trust2', $settings['hero_trust2']) }}"
                            class="form-control-custom" placeholder="e.g. Security-First Approach">
                        @error('hero_trust2')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="hero_trust3" class="form-label-custom">Indicator 3</label>
                        <input type="text" name="hero_trust3" id="hero_trust3" value="{{ old('hero_trust3', $settings['hero_trust3']) }}"
                            class="form-control-custom" placeholder="e.g. Made in India 🇮🇳">
                        @error('hero_trust3')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="display:flex;gap:12px;margin-top:16px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Save Hero Settings
        </button>
        <a href="{{ route('admin.frontend-manage') }}" class="btn-admin-secondary">
            Cancel
        </a>
    </div>

</form>

@endsection
