<!-- Navigation -->
<header>
    <nav class="glass-nav" role="navigation" aria-label="Main navigation">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo" aria-label="Home">
                @if(!empty($settings['logo']))
                    <img src="@fileUrl($settings['logo'])" alt="Logo" style="height: 2rem;">
                @else
                    <span class="logo-text">{{ Str::limit($settings['site_title'] ?? 'TA', 2, '') }}</span>
                @endif
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" aria-label="Navigate to home section"><i class="fa-solid fa-house" aria-hidden="true"></i> Home</a></li>
                @if($settings['about_enabled'] ?? true)
                    <li><a href="{{ route('home') }}#about" aria-label="Navigate to about section"><i class="fa-solid fa-user" aria-hidden="true"></i> About</a></li>
                @endif
                @if($settings['skills_enabled'] ?? true)
                    <li><a href="{{ route('home') }}#skills" aria-label="Navigate to skills section"><i class="fa-solid fa-code" aria-hidden="true"></i> Skills</a></li>
                @endif
                @if($settings['projects_enabled'] ?? true)
                    <li><a href="{{ route('home') }}#projects" aria-label="Navigate to projects section"><i class="fa-solid fa-diagram-project" aria-hidden="true"></i> Projects</a></li>
                @endif
                @if($settings['experience_enabled'] ?? true)
                    <li><a href="{{ route('home') }}#experience" aria-label="Navigate to experience section"><i class="fa-solid fa-briefcase" aria-hidden="true"></i> Experience</a></li>
                @endif
                @if($settings['education_enabled'] ?? true)
                    <li><a href="{{ route('home') }}#education" aria-label="Navigate to education section"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i> Education</a></li>
                @endif
                @if($settings['blog_enabled'] ?? true)
                    <li><a href="{{ route('home') }}#blog" aria-label="Navigate to blog section"><i class="fa-solid fa-newspaper" aria-hidden="true"></i> Blog</a></li>
                @endif
                @if($settings['contact_enabled'] ?? true)
                    <li><a href="{{ route('home') }}#contact" aria-label="Navigate to contact section"><i class="fa-solid fa-envelope" aria-hidden="true"></i> Contact</a></li>
                @endif
            </ul>
            <button class="mobile-menu-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
                <span class="hamburger"></span>
            </button>
        </div>
    </nav>
</header>
