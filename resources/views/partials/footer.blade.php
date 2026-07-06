<!-- Footer -->
<footer role="contentinfo" style="position:relative;z-index:10;margin-top:0;">

    {{-- Divider line --}}
    <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(6,182,212,0.3),transparent);margin-bottom:0;"></div>

    {{-- Main Footer --}}
    <div style="background:rgba(10,15,30,0.85);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-top:1px solid rgba(6,182,212,0.08);padding:56px 24px 32px;">
        <div style="max-width:1200px;margin:0 auto;">

            {{-- Top Row --}}
            <div style="display:grid;grid-template-columns:1fr auto 1fr;align-items:start;gap:40px;margin-bottom:48px;">

                {{-- Left: Brand --}}
                <div>
                    <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;margin-bottom:16px;">
                        @if(!empty($settings['logo']))
                            <img src="@fileUrl($settings['logo'])" alt="{{ $settings['site_title'] ?? 'Logo' }}" style="height:2rem;width:auto;">
                        @else
                            <span style="width:38px;height:38px;background:linear-gradient(135deg,#8b5cf6,#06b6d4);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:800;color:#fff;flex-shrink:0;">
                                {{ strtoupper(substr($settings['site_title'] ?? 'AP', 0, 1)) }}
                            </span>
                            <span style="font-family:'Space Grotesk',sans-serif;font-size:1.1rem;font-weight:700;background:linear-gradient(135deg,#8b5cf6,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                                {{ $settings['site_title'] ?? 'Portfolio' }}
                            </span>
                        @endif
                    </a>
                    @if(!empty($user?->profile?->bio))
                        <p style="font-size:13.5px;color:#475569;line-height:1.7;max-width:260px;">
                            {{ Str::limit($user->profile->bio, 120) }}
                        </p>
                    @else
                        <p style="font-size:13.5px;color:#475569;line-height:1.7;max-width:260px;">
                            Building elegant solutions to complex problems.
                        </p>
                    @endif
                </div>

                {{-- Center: Quick Links --}}
                <div style="text-align:center;">
                    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#334155;margin-bottom:14px;">Quick Links</p>
                    <nav style="display:flex;flex-direction:column;gap:8px;" aria-label="Footer navigation">
                        <a href="{{ route('home') }}" style="font-size:13.5px;color:#64748b;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#06b6d4'" onmouseout="this.style.color='#64748b'">Home</a>
                        @if($settings['about_enabled'] ?? true)
                        <a href="{{ route('home') }}#about" style="font-size:13.5px;color:#64748b;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#06b6d4'" onmouseout="this.style.color='#64748b'">About</a>
                        @endif
                        @if($settings['projects_enabled'] ?? true)
                        <a href="{{ route('home') }}#projects" style="font-size:13.5px;color:#64748b;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#06b6d4'" onmouseout="this.style.color='#64748b'">Projects</a>
                        @endif
                        @if($settings['blog_enabled'] ?? true)
                        <a href="{{ route('blog') }}" style="font-size:13.5px;color:#64748b;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#06b6d4'" onmouseout="this.style.color='#64748b'">Blog</a>
                        @endif
                        @if($settings['contact_enabled'] ?? true)
                        <a href="{{ route('home') }}#contact" style="font-size:13.5px;color:#64748b;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#06b6d4'" onmouseout="this.style.color='#64748b'">Contact</a>
                        @endif
                    </nav>
                </div>

                {{-- Right: Social + Contact --}}
                <div style="text-align:right;">
                    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#334155;margin-bottom:14px;">Connect</p>

                    {{-- Social Links --}}
                    @if(!empty($socialLinks) && $socialLinks->count())
                        <div style="display:flex;gap:10px;justify-content:flex-end;flex-wrap:wrap;margin-bottom:16px;">
                            @foreach($socialLinks->where('is_active', true)->take(6) as $link)
                                <a href="{{ $link->url }}"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="{{ $link->name }}"
                                   title="{{ $link->name }}"
                                   style="width:38px;height:38px;background:rgba(6,182,212,0.07);border:1px solid rgba(6,182,212,0.15);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#64748b;font-size:15px;text-decoration:none;transition:all 0.2s;"
                                   onmouseover="this.style.background='rgba(6,182,212,0.15)';this.style.borderColor='rgba(6,182,212,0.4)';this.style.color='#06b6d4';this.style.transform='translateY(-2px)'"
                                   onmouseout="this.style.background='rgba(6,182,212,0.07)';this.style.borderColor='rgba(6,182,212,0.15)';this.style.color='#64748b';this.style.transform='translateY(0)'">
                                    @if($link->icon)
                                        <i class="{{ $link->icon }}"></i>
                                    @else
                                        <i class="fa-solid fa-link"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif

                    {{-- Email --}}
                    @if(!empty($user?->email))
                        <a href="mailto:{{ $user->email }}"
                           style="display:inline-flex;align-items:center;gap:7px;font-size:13px;color:#475569;text-decoration:none;transition:color 0.2s;"
                           onmouseover="this.style.color='#06b6d4'" onmouseout="this.style.color='#475569'">
                            <i class="fa-solid fa-envelope" style="font-size:11px;"></i>
                            {{ $user->email }}
                        </a>
                    @endif
                </div>

            </div>

            {{-- Bottom Bar --}}
            <div style="height:1px;background:rgba(255,255,255,0.05);margin-bottom:24px;"></div>
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                <p style="font-size:12.5px;color:#334155;margin:0;">
                    &copy; {{ date('Y') }}
                    <a href="{{ $user?->profile?->website ?? '#' }}" target="_blank" rel="noopener noreferrer"
                       style="color:#475569;text-decoration:none;font-weight:600;"
                       onmouseover="this.style.color='#06b6d4'" onmouseout="this.style.color='#475569'">
                        {{ $user?->name ?? $settings['site_title'] ?? 'Portfolio' }}
                    </a>. All rights reserved.
                </p>
                <div style="display:flex;align-items:center;gap:5px;font-size:12px;color:#1e293b;">
                    <span>Crafted with</span>
                    <i class="fa-solid fa-heart" style="color:#e11d48;font-size:10px;animation:heartbeat 1.4s ease-in-out infinite;"></i>
                    <span>&amp; Laravel</span>
                </div>
            </div>

        </div>
    </div>

</footer>

<style>
    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.25); }
        50% { transform: scale(1); }
        75% { transform: scale(1.15); }
    }
    @media (max-width: 768px) {
        .footer-grid { grid-template-columns: 1fr !important; text-align: center !important; }
    }
</style>
