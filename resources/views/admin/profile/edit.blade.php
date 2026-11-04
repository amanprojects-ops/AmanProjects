@extends('layouts.admin')

@section('title', 'Edit Profile')
@section('page_title', '<span>Edit</span> Profile')

@section('content')

<div class="page-header">
    <h1 class="page-title">
        <span class="title-icon"><i class="fa-solid fa-user"></i></span>
        Edit Profile
    </h1>
</div>

<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">

        {{-- LEFT: Personal Info --}}
        <div class="col-lg-8">

            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-id-card" style="color:#6366f1;"></i> Personal Information</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">

                    <div>
                        <label for="name" class="form-label-custom">Full Name <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required
                            class="form-control-custom" placeholder="Your full name">
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="title" class="form-label-custom">Professional Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $profile->title ?? '') }}"
                            class="form-control-custom" placeholder="e.g., Full Stack Developer">
                        @error('title')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="bio" class="form-label-custom">Bio</label>
                        <textarea name="bio" id="bio" rows="6"
                            class="form-control-custom" style="resize:vertical;" placeholder="Tell visitors about yourself…">{{ old('bio', $profile->bio ?? '') }}</textarea>
                        @error('bio')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div>
                            <label for="phone" class="form-label-custom">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone ?? '') }}"
                                class="form-control-custom" placeholder="+1 234 567 890">
                            @error('phone')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="location" class="form-label-custom">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $profile->location ?? '') }}"
                                class="form-control-custom" placeholder="City, Country">
                            @error('location')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="website" class="form-label-custom">Website</label>
                        <input type="url" name="website" id="website" value="{{ old('website', $profile->website ?? '') }}"
                            class="form-control-custom" placeholder="https://yourwebsite.com">
                        @error('website')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                </div>
            </div>

        </div>

        {{-- RIGHT: Avatar & Resume --}}
        <div class="col-lg-4">

            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-image" style="color:#6366f1;"></i> Profile Photo</h3>
                </div>
                <div class="form-section-body" style="text-align:center;">
                    @if($profile->profile_image ?? false)
                        <img src="@fileUrl($profile->profile_image)" alt="Profile"
                            style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #e2e8f0;margin:0 auto 16px;display:block;">
                    @else
                        <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-size:36px;font-weight:700;margin:0 auto 16px;">
                            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                        </div>
                    @endif
                    <div class="file-input-wrapper">
                        <input type="file" name="profile_image" id="profile_image" accept="image/*">
                        <div class="file-input-label" style="justify-content:center;">
                            <i class="fa-solid fa-camera"></i>
                            <span>Change Photo</span>
                        </div>
                    </div>
                    @error('profile_image')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-file-pdf" style="color:#6366f1;"></i> Resume</h3>
                </div>
                <div class="form-section-body">
                    @if($profile->resume ?? false)
                        <div style="margin-bottom:12px;padding:10px 14px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;display:flex;align-items:center;gap:10px;">
                            <i class="fa-solid fa-file-pdf" style="color:#22c55e;font-size:20px;"></i>
                            <div>
                                <p style="margin:0;font-size:13px;font-weight:600;color:#166534;">Resume uploaded</p>
                                <a href="@fileUrl($profile->resume)" target="_blank" style="font-size:12px;color:#16a34a;">View current resume →</a>
                            </div>
                        </div>
                    @endif
                    <div class="file-input-wrapper">
                        <input type="file" name="resume" id="resume" accept=".pdf">
                        <div class="file-input-label">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <div>
                                <p style="margin:0;font-weight:600;color:#334155;font-size:13px;">Upload PDF Resume</p>
                                <p style="margin:0;font-size:12px;color:#94a3b8;">PDF only, max 5MB</p>
                            </div>
                        </div>
                    </div>
                    @error('resume')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

        </div>
    </div>

    <div style="display:flex;gap:12px;margin-top:8px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
        </button>
    </div>

</form>

@endsection
