@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section id="home" class="hero-section" aria-labelledby="hero-heading">
    <div class="container">
        <div class="hero-content glass-card">
            <h1 id="hero-heading" class="hero-title">
                Hi, I'm <span class="gradient-text">{{ $user?->name ?? 'Technical Aman' }}</span>
            </h1>
            <h2 class="hero-subtitle">{{ $profile?->title ?? 'Full Stack Developer' }}</h2>
            <p class="hero-description">
                {{ $profile?->bio ?? 'Crafting elegant solutions with modern technologies. Passionate about building scalable web applications and creating exceptional user experiences.' }}
            </p>
            <div class="hero-buttons">
                @if($settings['projects_enabled'] ?? true)
                    <a href="#projects" class="btn btn-primary glass-btn" aria-label="View my projects">
                        <i class="fa-solid fa-diagram-project" aria-hidden="true"></i> View Projects
                    </a>
                @endif
                @if($settings['contact_enabled'] ?? true)
                    <a href="#contact" class="btn btn-secondary glass-btn" aria-label="Contact me">
                        <i class="fa-solid fa-envelope" aria-hidden="true"></i> Get In Touch
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
@if($settings['about_enabled'] ?? true)
<section id="about" class="about-section" aria-labelledby="about-heading">
    <div class="container">
        <h2 id="about-heading" class="section-title">👋 About Me</h2>
        <article class="about-content glass-card">
            <div class="about-image">
                @if($profile?->profile_image)
                    <img src="@fileUrl($profile->profile_image)" alt="{{ $user?->name ?? 'Profile' }} - Full Stack Developer portrait" loading="lazy" width="300" height="300">
                @else
                    <img src="{{ asset('assets/profile.jpg') }}" alt="Profile" loading="lazy" width="300" height="300">
                @endif
            </div>
            <div class="about-text">
                <h3>Passionate Developer & Problem Solver</h3>
                @if($profile?->bio)
                    {!! nl2br(e($profile->bio)) !!}
                @else
                    <p>
                        With over 5 years of experience in full-stack development, I specialize in building
                        robust and scalable web applications. My journey in tech has been driven by curiosity
                        and a constant desire to learn and adapt to new technologies.
                    </p>
                    <p>
                        I believe in writing clean, maintainable code and creating intuitive user interfaces
                        that provide exceptional user experiences. When I'm not coding, you'll find me
                        exploring new technologies, contributing to open-source projects, or sharing knowledge
                        with the developer community.
                    </p>
                @endif
                <div class="about-stats">
                    <div class="stat-item glass-card">
                        <span class="stat-number">5+</span>
                        <span class="stat-label">Years Experience</span>
                    </div>
                    <div class="stat-item glass-card">
                        <span class="stat-number">{{ isset($projects) ? $projects->count() : '50' }}+</span>
                        <span class="stat-label">Projects Completed</span>
                    </div>
                    <div class="stat-item glass-card">
                        <span class="stat-number">30+</span>
                        <span class="stat-label">Happy Clients</span>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
@endif

<!-- Skills Section -->
@if(($settings['skills_enabled'] ?? true) && isset($skills) && $skills->count())
<section id="skills" class="skills-section" aria-labelledby="skills-heading">
    <div class="container">
        <h2 id="skills-heading" class="section-title">🧠 Skills & Technologies</h2>
        <div class="skills-grid" id="skills-container">
            @foreach($skills as $skill)
                <div class="skill-card glass-card fade-in">
                    <div class="skill-icon">
                        @php
                            $skillName = strtolower($skill->name);
                            $category = strtolower($skill->category ?? '');

                            // Skill-specific Font Awesome icons
                            $icon = match(true) {
                                // Frontend Frameworks
                                str_contains($skillName, 'react') => 'fa-brands fa-react',
                                str_contains($skillName, 'vue') => 'fa-brands fa-vuejs',
                                str_contains($skillName, 'angular') => 'fa-brands fa-angular',
                                str_contains($skillName, 'next') => 'fa-solid fa-n',
                                str_contains($skillName, 'nuxt') => 'fa-brands fa-vuejs',
                                str_contains($skillName, 'svelte') => 'fa-solid fa-fire',
                                str_contains($skillName, 'html') => 'fa-brands fa-html5',

                                // Backend Frameworks
                                str_contains($skillName, 'node') => 'fa-brands fa-node-js',
                                str_contains($skillName, 'express') => 'fa-brands fa-node',
                                str_contains($skillName, 'laravel') => 'fa-brands fa-laravel',
                                str_contains($skillName, 'django') => 'fa-solid fa-server',
                                str_contains($skillName, 'flask') => 'fa-solid fa-flask',
                                str_contains($skillName, 'spring') => 'fa-solid fa-leaf',
                                str_contains($skillName, 'rails') => 'fa-solid fa-gem',
                                str_contains($skillName, 'php') => 'fa-brands fa-php',

                                // Languages
                                str_contains($skillName, 'javascript') || str_contains($skillName, 'js') => 'fa-brands fa-js',
                                str_contains($skillName, 'typescript') || str_contains($skillName, 'ts') => 'fa-solid fa-code',
                                str_contains($skillName, 'python') => 'fa-brands fa-python',
                                str_contains($skillName, 'java') => 'fa-brands fa-java',
                                str_contains($skillName, 'c++') || str_contains($skillName, 'cpp') => 'fa-solid fa-c',
                                str_contains($skillName, 'c#') || str_contains($skillName, 'csharp') => 'fa-solid fa-hashtag',
                                str_contains($skillName, 'go') || str_contains($skillName, 'golang') => 'fa-brands fa-golang',
                                str_contains($skillName, 'rust') => 'fa-brands fa-rust',
                                str_contains($skillName, 'ruby') => 'fa-solid fa-gem',
                                str_contains($skillName, 'swift') => 'fa-brands fa-swift',
                                str_contains($skillName, 'kotlin') => 'fa-solid fa-k',

                                // Databases
                                str_contains($skillName, 'mongodb') || str_contains($skillName, 'mongo') => 'fa-solid fa-database',
                                str_contains($skillName, 'postgresql') || str_contains($skillName, 'postgres') => 'fa-solid fa-database',
                                str_contains($skillName, 'mysql') => 'fa-solid fa-database',
                                str_contains($skillName, 'redis') => 'fa-solid fa-database',
                                str_contains($skillName, 'firebase') => 'fa-solid fa-fire',
                                str_contains($skillName, 'oracle') => 'fa-solid fa-database',
                                str_contains($skillName, 'sqlite') => 'fa-solid fa-database',
                                str_contains($skillName, 'mariadb') => 'fa-solid fa-database',

                                // DevOps & Tools
                                str_contains($skillName, 'docker') => 'fa-brands fa-docker',
                                str_contains($skillName, 'kubernetes') || str_contains($skillName, 'k8s') => 'fa-solid fa-dharmachakra',
                                str_contains($skillName, 'jenkins') => 'fa-brands fa-jenkins',
                                str_contains($skillName, 'git') => 'fa-brands fa-git-alt',
                                str_contains($skillName, 'github') => 'fa-brands fa-github',
                                str_contains($skillName, 'gitlab') => 'fa-brands fa-gitlab',
                                str_contains($skillName, 'nginx') => 'fa-solid fa-server',
                                str_contains($skillName, 'apache') => 'fa-solid fa-server',

                                // Cloud Platforms
                                str_contains($skillName, 'aws') => 'fa-brands fa-aws',
                                str_contains($skillName, 'azure') => 'fa-brands fa-microsoft',
                                str_contains($skillName, 'gcp') || str_contains($skillName, 'google cloud') => 'fa-brands fa-google',
                                str_contains($skillName, 'heroku') => 'fa-solid fa-cloud',
                                str_contains($skillName, 'vercel') => 'fa-solid fa-v',
                                str_contains($skillName, 'netlify') => 'fa-solid fa-globe',
                                str_contains($skillName, 'digitalocean') => 'fa-brands fa-digital-ocean',

                                // CSS & Styling
                                str_contains($skillName, 'css') => 'fa-brands fa-css3-alt',
                                str_contains($skillName, 'sass') || str_contains($skillName, 'scss') => 'fa-brands fa-sass',
                                str_contains($skillName, 'tailwind') => 'fa-solid fa-wind',
                                str_contains($skillName, 'bootstrap') => 'fa-brands fa-bootstrap',
                                str_contains($skillName, 'material') => 'fa-solid fa-palette',

                                // Testing
                                str_contains($skillName, 'jest') => 'fa-solid fa-vial',
                                str_contains($skillName, 'cypress') => 'fa-solid fa-vial-circle-check',
                                str_contains($skillName, 'selenium') => 'fa-solid fa-microscope',
                                str_contains($skillName, 'phpunit') => 'fa-solid fa-flask-vial',
                                str_contains($skillName, 'pytest') => 'fa-solid fa-flask-vial',

                                // Mobile
                                str_contains($skillName, 'react native') => 'fa-brands fa-react',
                                str_contains($skillName, 'flutter') => 'fa-solid fa-mobile-screen',
                                str_contains($skillName, 'android') => 'fa-brands fa-android',
                                str_contains($skillName, 'ios') => 'fa-brands fa-apple',

                                // WordPress & CMS
                                str_contains($skillName, 'wordpress') => 'fa-brands fa-wordpress',
                                str_contains($skillName, 'drupal') => 'fa-brands fa-drupal',
                                str_contains($skillName, 'joomla') => 'fa-brands fa-joomla',

                                // Design Tools
                                str_contains($skillName, 'figma') => 'fa-brands fa-figma',
                                str_contains($skillName, 'sketch') => 'fa-brands fa-sketch',
                                str_contains($skillName, 'adobe') => 'fa-solid fa-palette',
                                str_contains($skillName, 'photoshop') => 'fa-solid fa-image',

                                // Category-based fallback
                                str_contains($category, 'frontend') => 'fa-solid fa-code',
                                str_contains($category, 'backend') => 'fa-solid fa-server',
                                str_contains($category, 'database') => 'fa-solid fa-database',
                                str_contains($category, 'devops') => 'fa-solid fa-gears',
                                str_contains($category, 'cloud') => 'fa-solid fa-cloud',
                                str_contains($category, 'tools') => 'fa-solid fa-wrench',
                                str_contains($category, 'mobile') => 'fa-solid fa-mobile-screen-button',
                                str_contains($category, 'design') => 'fa-solid fa-palette',
                                str_contains($category, 'testing') => 'fa-solid fa-vial',

                                // Default
                                default => 'fa-solid fa-code'
                            };
                        @endphp
                        <i class="{{ $icon }}"></i>
                    </div>
                    <h3 class="skill-name">{{ $skill->name }}</h3>
                    <p class="skill-level">{{ $skill->level }}%</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Projects Section -->
@if(($settings['projects_enabled'] ?? true) && isset($projects) && $projects->count())
<section id="projects" class="projects-section" aria-labelledby="projects-heading">
    <div class="container">
        <h2 id="projects-heading" class="section-title">🚀 Featured Projects</h2>
        <div class="projects-grid" id="projects-container">
            @foreach($projects as $project)
                <article class="project-card glass-card fade-in">
                    @if($project->thumbnail_image)
                        <img src="@fileUrl($project->thumbnail_image)"
                             alt="{{ $project->title }} project screenshot"
                             class="project-image"
                             loading="lazy"
                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22%3E%3Crect fill=%22%238b5cf6%22 width=%22400%22 height=%22200%22/%3E%3Ctext fill=%22%23ffffff%22 font-family=%22Arial%22 font-size=%2220%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3E{{ $project->title }}%3C/text%3E%3C/svg%3E'">
                    @else
                        <img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22%3E%3Crect fill=%22%238b5cf6%22 width=%22400%22 height=%22200%22/%3E%3Ctext fill=%22%23ffffff%22 font-family=%22Arial%22 font-size=%2220%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3E{{ $project->title }}%3C/text%3E%3C/svg%3E"
                             alt="{{ $project->title }} project"
                             class="project-image"
                             loading="lazy">
                    @endif
                    <div class="project-content">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <p class="project-description">{{ Str::limit($project->description ?? '', 150) }}</p>
                        @if($project->tech_stack_tags)
                            <div class="project-tags">
                                @foreach(explode(',', $project->tech_stack_tags) as $tag)
                                    <span class="tag">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="project-links">
                            @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="project-link" aria-label="View {{ $project->title }} on GitHub">
                                    <i class="fa-brands fa-github" aria-hidden="true"></i>
                                    Code
                                </a>
                            @endif
                            @if($project->live_demo_link)
                                <a href="{{ $project->live_demo_link }}" target="_blank" rel="noopener noreferrer" class="project-link" aria-label="View live demo of {{ $project->title }}">
                                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                    Live Demo
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Experience Section -->
@if(($settings['experience_enabled'] ?? true) && isset($experiences) && $experiences->count())
<section id="experience" class="about-section" aria-labelledby="experience-heading">
    <div class="container" style="max-width: 1000px;">
        <h2 id="experience-heading" class="section-title">💼 Work Experience</h2>
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            @foreach($experiences as $experience)
                <article class="glass-card">
                    <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--text-light); margin-bottom: 0.5rem;">
                                {{ $experience->role }}
                            </h3>
                            <p style="font-size: 1.1rem; color: var(--secondary-cyan); font-weight: 500;">
                                {{ $experience->company }}
                            </p>
                        </div>
                        <span style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-muted); font-size: 0.95rem; white-space: nowrap;">
                            <i class="fa-solid fa-calendar" aria-hidden="true"></i>
                            {{ $experience->start_date->format('M Y') }} - {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                        </span>
                    </div>
                    @if($experience->description)
                        <p style="color: var(--text-muted); line-height: 1.7;">
                            {{ $experience->description }}
                        </p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Education Section -->
@if(($settings['education_enabled'] ?? true) && isset($educations) && $educations->count())
<section id="education" class="skills-section" aria-labelledby="education-heading">
    <div class="container" style="max-width: 1000px;">
        <h2 id="education-heading" class="section-title">🎓 Education</h2>
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            @foreach($educations as $education)
                <article class="glass-card">
                    <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <h3 style="font-size: 1.5rem; font-weight: 600; color: var(--text-light); margin-bottom: 0.5rem;">
                                {{ $education->degree }}
                            </h3>
                            <p style="font-size: 1.1rem; color: var(--secondary-cyan); font-weight: 500;">
                                {{ $education->institute }}
                            </p>
                        </div>
                        <span style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-muted); font-size: 0.95rem; white-space: nowrap;">
                            <i class="fa-solid fa-calendar" aria-hidden="true"></i>
                            {{ $education->start_date->format('M Y') }} - {{ $education->end_date ? $education->end_date->format('M Y') : 'Present' }}
                        </span>
                    </div>
                    @if($education->description)
                        <p style="color: var(--text-muted); line-height: 1.7;">
                            {{ $education->description }}
                        </p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Blog Section -->
@if(($settings['blog_enabled'] ?? true) && isset($posts) && $posts->count())
<section id="blog" class="projects-section" aria-labelledby="blog-heading">
    <div class="container">
        <h2 id="blog-heading" class="section-title">✍️ Latest Blog Posts</h2>
        <div class="projects-grid" id="blog-container">
            @foreach($posts as $post)
                <article class="project-card glass-card fade-in">
                    @if($post->featured_image)
                        <img src="@fileUrl($post->featured_image)"
                             alt="{{ $post->title }}"
                             class="project-image"
                             loading="lazy"
                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22%3E%3Crect fill=%22%238b5cf6%22 width=%22400%22 height=%22200%22/%3E%3Ctext fill=%22%23ffffff%22 font-family=%22Arial%22 font-size=%2220%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3E{{ $post->title }}%3C/text%3E%3C/svg%3E'">
                    @else
                        <img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22%3E%3Crect fill=%22%238b5cf6%22 width=%22400%22 height=%22200%22/%3E%3Ctext fill=%22%23ffffff%22 font-family=%22Arial%22 font-size=%2220%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3E{{ $post->title }}%3C/text%3E%3C/svg%3E"
                             alt="{{ $post->title }}"
                             class="project-image"
                             loading="lazy">
                    @endif
                    <div class="project-content">
                        <h3 class="project-title">{{ $post->title }}</h3>
                        <p class="project-description">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                        @if($post->category)
                            <div class="project-tags">
                                <span class="tag">{{ $post->category->name }}</span>
                            </div>
                        @endif
                        <div class="project-links">
                            <a href="{{ route('blog.show', $post->slug) }}" class="project-link" aria-label="Read {{ $post->title }}">
                                <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                                Read More
                            </a>
                            @if($post->published_at)
                                <span class="project-link" style="cursor: default; opacity: 0.7;">
                                    <i class="fa-solid fa-calendar" aria-hidden="true"></i>
                                    {{ $post->published_at->format('M d, Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('blog') }}" class="btn btn-primary glass-btn" aria-label="View all blog posts">
                <i class="fa-solid fa-newspaper" aria-hidden="true"></i> View All Posts
            </a>
        </div>
    </div>
</section>
@endif

<!-- Contact Section -->
@if($settings['contact_enabled'] ?? true)
<section id="contact" class="contact-section" aria-labelledby="contact-heading">
    <div class="container">
        <h2 id="contact-heading" class="section-title">📩 Get In Touch</h2>
        <div class="contact-content">
            <article class="contact-info glass-card">
                <h3>Let's Work Together</h3>
                <p>
                    I'm always interested in hearing about new projects and opportunities.
                    Whether you have a question or just want to say hi, feel free to reach out!
                </p>
                <div class="contact-details">
                    @if($user?->email)
                        <div class="contact-item">
                            <i class="fa-solid fa-envelope icon" aria-hidden="true"></i>
                            <a href="mailto:{{ $user->email }}" aria-label="Email {{ $user->email }}">{{ $user->email }}</a>
                        </div>
                    @endif
                    @if($profile?->phone)
                        <div class="contact-item">
                            <i class="fa-solid fa-phone icon" aria-hidden="true"></i>
                            <a href="tel:{{ $profile->phone }}" aria-label="Call {{ $profile->phone }}">{{ $profile->phone }}</a>
                        </div>
                    @endif
                    @if($profile?->location)
                        <div class="contact-item">
                            <i class="fa-solid fa-location-dot icon" aria-hidden="true"></i>
                            <span>{{ $profile->location }}</span>
                        </div>
                    @endif
                </div>
                @if(isset($socialLinks) && $socialLinks->count())
                    <div class="social-links">
                        @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="social-link glass-btn" aria-label="Visit {{ $link->name }} profile">
                                @php
                                    $linkName = strtolower($link->name);

                                    // Comprehensive social media icon mapping
                                    $iconClass = match(true) {
                                        // Popular Social Networks
                                        str_contains($linkName, 'github') => 'fa-brands fa-github',
                                        str_contains($linkName, 'linkedin') => 'fa-brands fa-linkedin',
                                        str_contains($linkName, 'twitter') || str_contains($linkName, 'x.com') => 'fa-brands fa-x-twitter',
                                        str_contains($linkName, 'facebook') => 'fa-brands fa-facebook',
                                        str_contains($linkName, 'instagram') => 'fa-brands fa-instagram',
                                        str_contains($linkName, 'youtube') => 'fa-brands fa-youtube',
                                        str_contains($linkName, 'tiktok') => 'fa-brands fa-tiktok',
                                        str_contains($linkName, 'snapchat') => 'fa-brands fa-snapchat',
                                        str_contains($linkName, 'pinterest') => 'fa-brands fa-pinterest',
                                        str_contains($linkName, 'reddit') => 'fa-brands fa-reddit',
                                        str_contains($linkName, 'tumblr') => 'fa-brands fa-tumblr',

                                        // Professional Networks
                                        str_contains($linkName, 'behance') => 'fa-brands fa-behance',
                                        str_contains($linkName, 'dribbble') => 'fa-brands fa-dribbble',
                                        str_contains($linkName, 'medium') => 'fa-brands fa-medium',
                                        str_contains($linkName, 'dev.to') || str_contains($linkName, 'dev') => 'fa-brands fa-dev',
                                        str_contains($linkName, 'stackoverflow') || str_contains($linkName, 'stack overflow') => 'fa-brands fa-stack-overflow',
                                        str_contains($linkName, 'codepen') => 'fa-brands fa-codepen',

                                        // Messaging Apps
                                        str_contains($linkName, 'whatsapp') => 'fa-brands fa-whatsapp',
                                        str_contains($linkName, 'telegram') => 'fa-brands fa-telegram',
                                        str_contains($linkName, 'discord') => 'fa-brands fa-discord',
                                        str_contains($linkName, 'slack') => 'fa-brands fa-slack',
                                        str_contains($linkName, 'skype') => 'fa-brands fa-skype',

                                        // Content Platforms
                                        str_contains($linkName, 'twitch') => 'fa-brands fa-twitch',
                                        str_contains($linkName, 'spotify') => 'fa-brands fa-spotify',
                                        str_contains($linkName, 'soundcloud') => 'fa-brands fa-soundcloud',
                                        str_contains($linkName, 'vimeo') => 'fa-brands fa-vimeo',

                                        // Other Platforms
                                        str_contains($linkName, 'gitlab') => 'fa-brands fa-gitlab',
                                        str_contains($linkName, 'bitbucket') => 'fa-brands fa-bitbucket',
                                        str_contains($linkName, 'npm') => 'fa-brands fa-npm',
                                        str_contains($linkName, 'docker') => 'fa-brands fa-docker',
                                        str_contains($linkName, 'wordpress') => 'fa-brands fa-wordpress',

                                        // Generic
                                        str_contains($linkName, 'website') || str_contains($linkName, 'portfolio') => 'fa-solid fa-globe',
                                        str_contains($linkName, 'email') || str_contains($linkName, 'mail') => 'fa-solid fa-envelope',
                                        str_contains($linkName, 'phone') || str_contains($linkName, 'call') => 'fa-solid fa-phone',

                                        // Default
                                        default => 'fa-solid fa-link'
                                    };
                                @endphp
                                <i class="{{ $iconClass }}" aria-hidden="true"></i>
                            </a>
                        @endforeach
                    </div>
                @endif
            </article>

            <form class="contact-form glass-card" id="contact-form" action="{{ route('contact.store') }}" method="POST" aria-label="Contact form">
                @csrf
                <input type="hidden" name="honeypot" class="hidden" tabindex="-1" autocomplete="off">

                @if(session('success'))
                    <div style="background: linear-gradient(135deg, #06b6d4, #8b5cf6); color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required aria-required="true" placeholder="Your name" value="{{ old('name') }}">
                    @error('name')<p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required aria-required="true" placeholder="your.email@example.com" value="{{ old('email') }}">
                    @error('email')<p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required aria-required="true" placeholder="What's this about?" value="{{ old('subject') }}">
                    @error('subject')<p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required aria-required="true" placeholder="Your message...">{{ old('message') }}</textarea>
                    @error('message')<p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn btn-primary glass-btn"><i class="fa-solid fa-paper-plane" aria-hidden="true"></i> Send Message</button>
            </form>
        </div>
    </div>
</section>
@endif
@endsection
