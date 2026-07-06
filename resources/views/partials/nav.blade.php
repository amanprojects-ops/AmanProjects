<!-- Navigation -->
<header>
    <nav class="glass-nav" role="navigation" aria-label="Main navigation" id="mainNav">
        <div class="nav-container">

            {{-- Logo / Brand --}}
            <a href="{{ route('home') }}" class="logo" aria-label="Home" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
                @if(!empty($settings['logo']))
                    <img src="@fileUrl($settings['logo'])" alt="{{ $settings['site_title'] ?? 'Logo' }}" style="height:2.2rem;width:auto;">
                @else
                    <span style="display:flex;align-items:center;gap:9px;">
                        <span style="width:36px;height:36px;background:linear-gradient(135deg,#8b5cf6,#06b6d4);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:800;color:#fff;flex-shrink:0;box-shadow:0 4px 14px rgba(6,182,212,0.3);">
                            {{ strtoupper(substr($settings['site_title'] ?? 'AP', 0, 1)) }}
                        </span>
                        <span class="logo-text" style="font-family:'Space Grotesk',sans-serif;font-size:1.1rem;font-weight:700;background:linear-gradient(135deg,#8b5cf6,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                            {{ $settings['site_title'] ?? 'Portfolio' }}
                        </span>
                    </span>
                @endif
            </a>

            {{-- Desktop Nav Links --}}
            <ul class="nav-links" style="display:flex;list-style:none;gap:0.25rem;align-items:center;margin:0;padding:0;">
                <li>
                    <a href="{{ route('home') }}"
                       aria-label="Navigate to home section"
                       style="display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;color:rgba(241,245,249,0.75);text-decoration:none;font-size:13.5px;font-weight:500;transition:all 0.2s;font-family:'Inter',sans-serif;"
                       onmouseover="this.style.background='rgba(6,182,212,0.08)';this.style.color='#06b6d4'"
                       onmouseout="this.style.background='transparent';this.style.color='rgba(241,245,249,0.75)'">
                        <i class="fa-solid fa-house" aria-hidden="true" style="font-size:11px;"></i>
                        Home
                    </a>
                </li>
                @if($settings['about_enabled'] ?? true)
                <li>
                    <a href="{{ route('home') }}#about"
                       aria-label="Navigate to about section"
                       style="display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;color:rgba(241,245,249,0.75);text-decoration:none;font-size:13.5px;font-weight:500;transition:all 0.2s;font-family:'Inter',sans-serif;"
                       onmouseover="this.style.background='rgba(6,182,212,0.08)';this.style.color='#06b6d4'"
                       onmouseout="this.style.background='transparent';this.style.color='rgba(241,245,249,0.75)'">
                        <i class="fa-solid fa-user" aria-hidden="true" style="font-size:11px;"></i>
                        About
                    </a>
                </li>
                @endif
                @if($settings['skills_enabled'] ?? true)
                <li>
                    <a href="{{ route('home') }}#skills"
                       aria-label="Navigate to skills section"
                       style="display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;color:rgba(241,245,249,0.75);text-decoration:none;font-size:13.5px;font-weight:500;transition:all 0.2s;font-family:'Inter',sans-serif;"
                       onmouseover="this.style.background='rgba(6,182,212,0.08)';this.style.color='#06b6d4'"
                       onmouseout="this.style.background='transparent';this.style.color='rgba(241,245,249,0.75)'">
                        <i class="fa-solid fa-code" aria-hidden="true" style="font-size:11px;"></i>
                        Skills
                    </a>
                </li>
                @endif
                @if($settings['projects_enabled'] ?? true)
                <li>
                    <a href="{{ route('home') }}#projects"
                       aria-label="Navigate to projects section"
                       style="display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;color:rgba(241,245,249,0.75);text-decoration:none;font-size:13.5px;font-weight:500;transition:all 0.2s;font-family:'Inter',sans-serif;"
                       onmouseover="this.style.background='rgba(6,182,212,0.08)';this.style.color='#06b6d4'"
                       onmouseout="this.style.background='transparent';this.style.color='rgba(241,245,249,0.75)'">
                        <i class="fa-solid fa-diagram-project" aria-hidden="true" style="font-size:11px;"></i>
                        Projects
                    </a>
                </li>
                @endif
                @if($settings['experience_enabled'] ?? true)
                <li>
                    <a href="{{ route('home') }}#experience"
                       aria-label="Navigate to experience section"
                       style="display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;color:rgba(241,245,249,0.75);text-decoration:none;font-size:13.5px;font-weight:500;transition:all 0.2s;font-family:'Inter',sans-serif;"
                       onmouseover="this.style.background='rgba(6,182,212,0.08)';this.style.color='#06b6d4'"
                       onmouseout="this.style.background='transparent';this.style.color='rgba(241,245,249,0.75)'">
                        <i class="fa-solid fa-briefcase" aria-hidden="true" style="font-size:11px;"></i>
                        Experience
                    </a>
                </li>
                @endif
                @if($settings['education_enabled'] ?? true)
                <li>
                    <a href="{{ route('home') }}#education"
                       aria-label="Navigate to education section"
                       style="display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;color:rgba(241,245,249,0.75);text-decoration:none;font-size:13.5px;font-weight:500;transition:all 0.2s;font-family:'Inter',sans-serif;"
                       onmouseover="this.style.background='rgba(6,182,212,0.08)';this.style.color='#06b6d4'"
                       onmouseout="this.style.background='transparent';this.style.color='rgba(241,245,249,0.75)'">
                        <i class="fa-solid fa-graduation-cap" aria-hidden="true" style="font-size:11px;"></i>
                        Education
                    </a>
                </li>
                @endif
                @if($settings['blog_enabled'] ?? true)
                <li>
                    <a href="{{ route('blog') }}"
                       aria-label="Navigate to blog"
                       style="display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;color:rgba(241,245,249,0.75);text-decoration:none;font-size:13.5px;font-weight:500;transition:all 0.2s;font-family:'Inter',sans-serif;"
                       onmouseover="this.style.background='rgba(6,182,212,0.08)';this.style.color='#06b6d4'"
                       onmouseout="this.style.background='transparent';this.style.color='rgba(241,245,249,0.75)'">
                        <i class="fa-solid fa-newspaper" aria-hidden="true" style="font-size:11px;"></i>
                        Blog
                    </a>
                </li>
                @endif
                @if($settings['contact_enabled'] ?? true)
                <li>
                    <a href="{{ route('home') }}#contact"
                       aria-label="Navigate to contact section"
                       style="display:inline-flex;align-items:center;gap:7px;padding:8px 18px;background:linear-gradient(135deg,rgba(6,182,212,0.15),rgba(14,165,233,0.08));border:1px solid rgba(6,182,212,0.25);border-radius:10px;color:#06b6d4;text-decoration:none;font-size:13.5px;font-weight:600;transition:all 0.2s;font-family:'Inter',sans-serif;"
                       onmouseover="this.style.background='linear-gradient(135deg,rgba(6,182,212,0.25),rgba(14,165,233,0.15))';this.style.borderColor='rgba(6,182,212,0.5)';this.style.boxShadow='0 4px 14px rgba(6,182,212,0.2)'"
                       onmouseout="this.style.background='linear-gradient(135deg,rgba(6,182,212,0.15),rgba(14,165,233,0.08))';this.style.borderColor='rgba(6,182,212,0.25)';this.style.boxShadow='none'">
                        <i class="fa-solid fa-envelope" aria-hidden="true" style="font-size:11px;"></i>
                        Contact
                    </a>
                </li>
                @endif
            </ul>

            {{-- Mobile hamburger --}}
            <button class="mobile-menu-toggle"
                    aria-label="Toggle mobile menu"
                    aria-expanded="false"
                    id="navToggle"
                    onclick="toggleMobileMenu()"
                    style="display:none;background:rgba(6,182,212,0.08);border:1px solid rgba(6,182,212,0.2);border-radius:10px;padding:8px 11px;cursor:pointer;flex-direction:column;gap:5px;align-items:center;justify-content:center;width:42px;height:42px;">
                <span id="hb1" style="display:block;width:20px;height:2px;background:rgba(241,245,249,0.8);border-radius:2px;transition:all 0.3s;"></span>
                <span id="hb2" style="display:block;width:20px;height:2px;background:rgba(241,245,249,0.8);border-radius:2px;transition:all 0.3s;"></span>
                <span id="hb3" style="display:block;width:14px;height:2px;background:rgba(241,245,249,0.8);border-radius:2px;transition:all 0.3s;align-self:flex-end;"></span>
            </button>

        </div>{{-- /.nav-container --}}

        {{-- Mobile dropdown menu --}}
        <div id="mobileMenu" style="display:none;padding:12px 20px 20px;border-top:1px solid rgba(6,182,212,0.1);">
            <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:4px;">
                <li><a href="{{ route('home') }}" style="display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:10px;color:rgba(241,245,249,0.8);text-decoration:none;font-size:14px;font-weight:500;transition:background 0.2s;" onmouseover="this.style.background='rgba(6,182,212,0.08)'" onmouseout="this.style.background='transparent'"><i class="fa-solid fa-house" style="font-size:12px;width:16px;color:#06b6d4;"></i> Home</a></li>
                @if($settings['about_enabled'] ?? true)
                <li><a href="{{ route('home') }}#about" style="display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:10px;color:rgba(241,245,249,0.8);text-decoration:none;font-size:14px;font-weight:500;transition:background 0.2s;" onmouseover="this.style.background='rgba(6,182,212,0.08)'" onmouseout="this.style.background='transparent'" onclick="closeMobileMenu()"><i class="fa-solid fa-user" style="font-size:12px;width:16px;color:#06b6d4;"></i> About</a></li>
                @endif
                @if($settings['skills_enabled'] ?? true)
                <li><a href="{{ route('home') }}#skills" style="display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:10px;color:rgba(241,245,249,0.8);text-decoration:none;font-size:14px;font-weight:500;transition:background 0.2s;" onmouseover="this.style.background='rgba(6,182,212,0.08)'" onmouseout="this.style.background='transparent'" onclick="closeMobileMenu()"><i class="fa-solid fa-code" style="font-size:12px;width:16px;color:#06b6d4;"></i> Skills</a></li>
                @endif
                @if($settings['projects_enabled'] ?? true)
                <li><a href="{{ route('home') }}#projects" style="display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:10px;color:rgba(241,245,249,0.8);text-decoration:none;font-size:14px;font-weight:500;transition:background 0.2s;" onmouseover="this.style.background='rgba(6,182,212,0.08)'" onmouseout="this.style.background='transparent'" onclick="closeMobileMenu()"><i class="fa-solid fa-diagram-project" style="font-size:12px;width:16px;color:#06b6d4;"></i> Projects</a></li>
                @endif
                @if($settings['experience_enabled'] ?? true)
                <li><a href="{{ route('home') }}#experience" style="display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:10px;color:rgba(241,245,249,0.8);text-decoration:none;font-size:14px;font-weight:500;transition:background 0.2s;" onmouseover="this.style.background='rgba(6,182,212,0.08)'" onmouseout="this.style.background='transparent'" onclick="closeMobileMenu()"><i class="fa-solid fa-briefcase" style="font-size:12px;width:16px;color:#06b6d4;"></i> Experience</a></li>
                @endif
                @if($settings['education_enabled'] ?? true)
                <li><a href="{{ route('home') }}#education" style="display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:10px;color:rgba(241,245,249,0.8);text-decoration:none;font-size:14px;font-weight:500;transition:background 0.2s;" onmouseover="this.style.background='rgba(6,182,212,0.08)'" onmouseout="this.style.background='transparent'" onclick="closeMobileMenu()"><i class="fa-solid fa-graduation-cap" style="font-size:12px;width:16px;color:#06b6d4;"></i> Education</a></li>
                @endif
                @if($settings['blog_enabled'] ?? true)
                <li><a href="{{ route('blog') }}" style="display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:10px;color:rgba(241,245,249,0.8);text-decoration:none;font-size:14px;font-weight:500;transition:background 0.2s;" onmouseover="this.style.background='rgba(6,182,212,0.08)'" onmouseout="this.style.background='transparent'" onclick="closeMobileMenu()"><i class="fa-solid fa-newspaper" style="font-size:12px;width:16px;color:#06b6d4;"></i> Blog</a></li>
                @endif
                @if($settings['contact_enabled'] ?? true)
                <li style="margin-top:8px;">
                    <a href="{{ route('home') }}#contact" style="display:flex;align-items:center;justify-content:center;gap:8px;padding:12px 14px;background:linear-gradient(135deg,rgba(6,182,212,0.15),rgba(14,165,233,0.08));border:1px solid rgba(6,182,212,0.25);border-radius:12px;color:#06b6d4;text-decoration:none;font-size:14px;font-weight:600;" onclick="closeMobileMenu()">
                        <i class="fa-solid fa-envelope" style="font-size:12px;"></i> Contact Me
                    </a>
                </li>
                @endif
            </ul>
        </div>

    </nav>
</header>

{{-- Nav scroll + mobile toggle script --}}
<script>
    // Scroll: make nav slightly more opaque when scrolled
    (function() {
        var nav = document.getElementById('mainNav');
        if (!nav) return;
        window.addEventListener('scroll', function() {
            if (window.scrollY > 20) {
                nav.style.background = 'rgba(10, 15, 30, 0.92)';
                nav.style.boxShadow = '0 8px 32px rgba(0,0,0,0.4), 0 2px 0 rgba(6,182,212,0.1)';
            } else {
                nav.style.background = 'rgba(15, 23, 42, 0.7)';
                nav.style.boxShadow = '';
            }
        }, { passive: true });

        // Show hamburger on mobile
        function checkMobile() {
            var toggle = document.getElementById('navToggle');
            var links = document.querySelector('.nav-links');
            if (!toggle || !links) return;
            if (window.innerWidth <= 768) {
                toggle.style.display = 'flex';
                links.style.display = 'none';
            } else {
                toggle.style.display = 'none';
                links.style.display = 'flex';
                document.getElementById('mobileMenu').style.display = 'none';
            }
        }
        checkMobile();
        window.addEventListener('resize', checkMobile);
    })();

    var _menuOpen = false;

    function toggleMobileMenu() {
        _menuOpen = !_menuOpen;
        var menu = document.getElementById('mobileMenu');
        var btn = document.getElementById('navToggle');
        menu.style.display = _menuOpen ? 'block' : 'none';
        btn.setAttribute('aria-expanded', _menuOpen ? 'true' : 'false');
        // Animate hamburger → X
        var h1 = document.getElementById('hb1');
        var h2 = document.getElementById('hb2');
        var h3 = document.getElementById('hb3');
        if (_menuOpen) {
            h1.style.transform = 'rotate(45deg) translate(5px, 5px)';
            h2.style.opacity = '0';
            h3.style.transform = 'rotate(-45deg) translate(3px, -3px)';
            h3.style.width = '20px';
            h3.style.alignSelf = 'unset';
        } else {
            h1.style.transform = '';
            h2.style.opacity = '1';
            h3.style.transform = '';
            h3.style.width = '14px';
            h3.style.alignSelf = 'flex-end';
        }
    }

    function closeMobileMenu() {
        if (_menuOpen) toggleMobileMenu();
    }
</script>
