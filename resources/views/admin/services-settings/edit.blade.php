@extends('layouts.admin')

@section('title', 'Services Section Settings')
@section('page_title', '<span>Services</span> Settings')

@section('content')

<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-server"></i></span>
        Services Section Settings
    </h1>
    <a href="{{ route('admin.services.index') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Back to Services List
    </a>
</div>

<form action="{{ route('admin.services-settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">

            {{-- Headline & Subtitle --}}
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-font" style="color:#6366f1;"></i> Section Header</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">
                    <div>
                        <label for="services_badge" class="form-label-custom">Section Badge</label>
                        <input type="text" name="services_badge" id="services_badge" value="{{ old('services_badge', $settings['services_badge']) }}"
                            class="form-control-custom" placeholder="e.g. What We Do">
                        @error('services_badge')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="services_title" class="form-label-custom">Section Title</label>
                        <input type="text" name="services_title" id="services_title" value="{{ old('services_title', $settings['services_title']) }}"
                            class="form-control-custom" placeholder="e.g. Our Services">
                        @error('services_title')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="services_subtitle" class="form-label-custom">Section Description</label>
                        <textarea name="services_subtitle" id="services_subtitle" rows="3"
                            class="form-control-custom" style="resize:vertical;" placeholder="Write a short section description…">{{ old('services_subtitle', $settings['services_subtitle']) }}</textarea>
                        @error('services_subtitle')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- CTA Card --}}
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-gift" style="color:#6366f1;"></i> Custom CTA Card</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">
                    <div>
                        <label for="services_cta_title" class="form-label-custom">CTA Card Title</label>
                        <input type="text" name="services_cta_title" id="services_cta_title" value="{{ old('services_cta_title', $settings['services_cta_title']) }}"
                            class="form-control-custom" placeholder="e.g. Need Something Custom?">
                        @error('services_cta_title')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="services_cta_desc" class="form-label-custom">CTA Card Description</label>
                        <textarea name="services_cta_desc" id="services_cta_desc" rows="3"
                            class="form-control-custom" style="resize:vertical;" placeholder="e.g. Every great product starts with a conversation. Let's discuss yours.">{{ old('services_cta_desc', $settings['services_cta_desc']) }}</textarea>
                        @error('services_cta_desc')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label for="services_cta_btn_text" class="form-label-custom">CTA Button Text</label>
                            <input type="text" name="services_cta_btn_text" id="services_cta_btn_text" value="{{ old('services_cta_btn_text', $settings['services_cta_btn_text']) }}"
                                class="form-control-custom" placeholder="e.g. Start a Project">
                            @error('services_cta_btn_text')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="services_cta_btn_link" class="form-label-custom">CTA Button Link</label>
                            <input type="text" name="services_cta_btn_link" id="services_cta_btn_link" value="{{ old('services_cta_btn_link', $settings['services_cta_btn_link']) }}"
                                class="form-control-custom" placeholder="e.g. #contact">
                            @error('services_cta_btn_link')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="display:flex;gap:12px;margin-top:16px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Save Settings
        </button>
        <a href="{{ route('admin.services.index') }}" class="btn-admin-secondary">
            Cancel
        </a>
    </div>

</form>

@endsection
