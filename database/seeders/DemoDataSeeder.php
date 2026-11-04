<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\SocialLink;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Category;
use App\Models\Post;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Get or Create Super Admin / Demo User
        $user = User::firstOrCreate(
            ['email' => 'admin@amanprojects.com'],
            [
                'name' => 'Aman Yadav',
                'password' => Hash::make('Admin@1234'),
                'email_verified_at' => now(),
            ]
        );

        // Ensure user is attached to super-admin role if it exists
        $superAdminRole = \App\Models\Role::where('name', 'super-admin')->first();
        if ($superAdminRole && !$user->roles()->where('role_id', $superAdminRole->id)->exists()) {
            $user->roles()->attach($superAdminRole);
        }

        // 2. Profile
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'title' => 'Full Stack Web Developer & Software Engineer',
                'bio' => 'I am a highly motivated and detail-oriented Full Stack Developer with 4+ years of professional experience building modern, responsive, and robust web applications. Specialize in PHP/Laravel, JavaScript/React, and Cloud Deployments.',
                'phone' => '+1 (555) 019-2834',
                'location' => 'New Delhi, India',
                'website' => 'https://amanprojects.com',
                'profile_image' => 'images/demo-profile.jpg',
                'resume' => 'documents/demo-resume.pdf',
            ]
        );

        // 3. Social Links
        $socialLinks = [
            [
                'name' => 'GitHub',
                'url' => 'https://github.com/aman-projects',
                'icon' => 'fab fa-github',
                'is_active' => true,
            ],
            [
                'name' => 'LinkedIn',
                'url' => 'https://linkedin.com/in/aman-projects',
                'icon' => 'fab fa-linkedin',
                'is_active' => true,
            ],
            [
                'name' => 'Twitter',
                'url' => 'https://twitter.com/aman_projects',
                'icon' => 'fab fa-twitter',
                'is_active' => true,
            ],
            [
                'name' => 'Portfolio',
                'url' => 'https://amanprojects.com',
                'icon' => 'fas fa-globe',
                'is_active' => true,
            ],
        ];

        foreach ($socialLinks as $link) {
            SocialLink::updateOrCreate(
                ['user_id' => $user->id, 'name' => $link['name']],
                $link
            );
        }

        // 4. Skills
        $skills = [
            // Backend
            ['name' => 'PHP', 'category' => 'Backend Development', 'level' => 95, 'show' => true],
            ['name' => 'Laravel', 'category' => 'Backend Development', 'level' => 90, 'show' => true],
            ['name' => 'Node.js', 'category' => 'Backend Development', 'level' => 75, 'show' => true],
            ['name' => 'Express.js', 'category' => 'Backend Development', 'level' => 70, 'show' => true],
            
            // Frontend
            ['name' => 'HTML5 / CSS3', 'category' => 'Frontend Development', 'level' => 95, 'show' => true],
            ['name' => 'JavaScript (ES6+)', 'category' => 'Frontend Development', 'level' => 90, 'show' => true],
            ['name' => 'React.js', 'category' => 'Frontend Development', 'level' => 85, 'show' => true],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend Development', 'level' => 90, 'show' => true],
            
            // Database
            ['name' => 'MySQL / MariaDB', 'category' => 'Database', 'level' => 85, 'show' => true],
            ['name' => 'PostgreSQL', 'category' => 'Database', 'level' => 80, 'show' => true],
            ['name' => 'MongoDB', 'category' => 'Database', 'level' => 70, 'show' => true],
            
            // DevOps & Tools
            ['name' => 'Git & GitHub', 'category' => 'Tools & DevOps', 'level' => 90, 'show' => true],
            ['name' => 'Docker', 'category' => 'Tools & DevOps', 'level' => 75, 'show' => true],
            ['name' => 'AWS (S3, EC2)', 'category' => 'Tools & DevOps', 'level' => 70, 'show' => true],
            ['name' => 'CI/CD Pipelines', 'category' => 'Tools & DevOps', 'level' => 75, 'show' => true],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                $skill
            );
        }

        // 7. Projects
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'description' => 'A comprehensive, high-performance online storefront featuring robust product catalogs, advanced searching/filtering, secure Stripe payments, and a fully functional admin dashboard for inventory management.',
                'tech_stack_tags' => 'Laravel, MySQL, Stripe API, Bootstrap 5, Alpine.js',
                'github_link' => 'https://github.com/aman-projects/laravel-ecommerce',
                'live_demo_link' => 'https://ecommerce-demo.amanprojects.com',
                'thumbnail_image' => 'images/projects/ecommerce.jpg',
                'featured' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Collaborative Task Manager',
                'description' => 'A real-time project management tool similar to Trello. Features drag-and-drop Kanban boards, team workspaces, activity logs, file attachments, and instant notifications via WebSockets.',
                'tech_stack_tags' => 'React.js, Node.js, Express, MongoDB, Socket.io, Tailwind CSS',
                'github_link' => 'https://github.com/aman-projects/collaborative-task-manager',
                'live_demo_link' => 'https://taskmanager.amanprojects.com',
                'thumbnail_image' => 'images/projects/taskmanager.jpg',
                'featured' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Portfolio & CMS Solution',
                'description' => 'This exact site! A highly customizable, dynamic portfolio builder allowing developers to showcase their work, write blog posts, configure settings, and receive client inquiries securely.',
                'tech_stack_tags' => 'Laravel 11, SQLite, Vanilla CSS, JS',
                'github_link' => 'https://github.com/aman-projects/portfolio-cms',
                'live_demo_link' => 'https://amanprojects.com',
                'thumbnail_image' => 'images/projects/portfolio.jpg',
                'featured' => false,
                'status' => 'published',
            ],
            [
                'title' => 'AI Code Companion',
                'description' => 'A developer tool that integrates OpenAI\'s GPT API to generate code snippets, refactor code, and provide detailed security analysis of target source files directly from the browser.',
                'tech_stack_tags' => 'Python, Flask, React, OpenAI API, Tailwind CSS',
                'github_link' => 'https://github.com/aman-projects/ai-code-companion',
                'live_demo_link' => 'https://ai-helper.amanprojects.com',
                'thumbnail_image' => 'images/projects/ai-companion.jpg',
                'featured' => false,
                'status' => 'draft',
            ],
        ];

        foreach ($projects as $proj) {
            if (!isset($proj['slug'])) {
                $proj['slug'] = Str::slug($proj['title']);
            }
            Project::updateOrCreate(
                ['title' => $proj['title']],
                $proj
            );
        }

        // 8. Categories
        $categoriesData = [
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Laravel & PHP', 'slug' => 'laravel-php'],
            ['name' => 'React & Frontend', 'slug' => 'react-frontend'],
            ['name' => 'DevOps & Deployment', 'slug' => 'devops-deployment'],
            ['name' => 'Industry News & Tips', 'slug' => 'industry-tips'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[] = Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }

        // 9. Posts
        $postsData = [
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started-with-laravel-11',
                'content' => 'Laravel 11 introduces a more streamlined application structure, minimal configuration files, a new model casts design, and native support for PHP 8.2+ features. In this guide, we walk through installing a new project, setting up basic database configurations, and understanding the simplified file structure layout. You will see how clean and modern your Laravel app feels!',
                'meta_title' => 'Master Laravel 11: Installation & Architecture Guide',
                'meta_description' => 'Learn how to get started with Laravel 11, exploring the new directory layout, minimal settings, and modern features.',
                'featured_image' => 'images/blog/laravel11.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'category_indices' => [0, 1], // Web Development, Laravel & PHP
            ],
            [
                'title' => 'Mastering React State Management in 2026',
                'slug' => 'mastering-react-state-management-2026',
                'content' => 'State management in React has evolved significantly over the years. With modern React Server Components, Context API improvements, and lightweight libraries like Zustand and Jotai, developers have excellent tools at their disposal. In this post, we discuss when to use simple useState, when to rely on Context, and when to reach for dedicated external state managers to keep your code clean and scalable.',
                'meta_title' => 'React State Management Guide: Zustand, Context, RSC',
                'meta_description' => 'A guide to choosing the best state management approach in React, comparing Context API, Zustand, and RSC.',
                'featured_image' => 'images/blog/react-state.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'category_indices' => [0, 2], // Web Development, React & Frontend
            ],
            [
                'title' => 'How to Deploy a Laravel App with Docker and Nginx',
                'slug' => 'deploy-laravel-docker-nginx',
                'content' => 'Containerizing your applications ensures consistent behavior across development, staging, and production environments. This tutorial provides a step-by-step guide on creating a Dockerfile for Laravel, configuring an Nginx proxy container, and using Docker Compose to orchestrate PHP-FPM, Nginx, and MySQL services for a high-availability production stack.',
                'meta_title' => 'Deploy Laravel App using Docker and Nginx - Tutorial',
                'meta_description' => 'Step by step guide to containerize and deploy Laravel applications using Docker, Nginx, and Compose.',
                'featured_image' => 'images/blog/docker-laravel.jpg',
                'status' => 'published',
                'published_at' => now()->subDay(),
                'category_indices' => [0, 3], // Web Development, DevOps & Deployment
            ],
            [
                'title' => 'Future of Artificial Intelligence in Web Development',
                'slug' => 'future-of-ai-in-web-dev',
                'content' => 'Artificial intelligence is reshaping the web development landscape. From AI-assisted coding tools to intelligent user experiences, we are entering an era of smart applications. In this article, we look at current tools, predict future developments, and discuss how web developers can stay competitive by learning to integrate AI APIs into their daily workflows.',
                'meta_title' => 'AI and the Future of Web Development',
                'meta_description' => 'Explore how AI and LLMs are transforming web engineering and how developers can utilize these tools.',
                'featured_image' => 'images/blog/ai-webdev.jpg',
                'status' => 'draft',
                'published_at' => null,
                'category_indices' => [0, 4], // Web Development, Industry News & Tips
            ],
        ];

        foreach ($postsData as $postItem) {
            $catIndices = $postItem['category_indices'];
            unset($postItem['category_indices']);

            $post = Post::updateOrCreate(
                ['slug' => $postItem['slug']],
                array_merge($postItem, ['user_id' => $user->id])
            );

            // Sync categories
            $catIds = [];
            foreach ($catIndices as $idx) {
                if (isset($categories[$idx])) {
                    $catIds[] = $categories[$idx]->id;
                }
            }
            $post->categories()->sync($catIds);
        }

        // 10. Contacts
        $contacts = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'subject' => 'Inquiry about E-commerce Website Development',
                'message' => 'Hello Aman, I saw your portfolio and was really impressed with your E-Commerce Platform project. I am looking to build a custom online store for my fashion brand. Are you currently available for freelance work? Let me know your rates. Thanks!',
                'read' => false,
                'replied_at' => null,
            ],
            [
                'name' => 'Sarah Connor',
                'email' => 'sarah.c@techinc.com',
                'subject' => 'Job Opportunity: Senior Software Engineer',
                'message' => 'Dear Aman, I am a technical recruiter at TechInc. We are currently searching for a Senior Full Stack Engineer with strong experience in Laravel and React to join our remote team. Your background aligns perfectly with what we are looking for. I would love to connect and share more details about the role.',
                'read' => true,
                'replied_at' => now()->subHours(5),
            ],
            [
                'name' => 'Michael Scott',
                'email' => 'mscott@dundermifflin.com',
                'subject' => 'Website Redesign',
                'message' => 'Hey, we need a brand new website for our paper company. Needs to be super fast and cool. Can you build it? Send me a quote ASAP.',
                'read' => false,
                'replied_at' => null,
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::updateOrCreate(
                ['email' => $contact['email'], 'subject' => $contact['subject']],
                $contact
            );
        }

        // 11. Stats
        $stats = [
            ['value' => 20, 'suffix' => '+', 'label' => 'Projects Delivered', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
            ['value' => 10, 'suffix' => '+', 'label' => 'Happy Clients', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ['value' => 3, 'suffix' => '+', 'label' => 'Years Experience', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['value' => 10, 'suffix' => '+', 'label' => 'Technologies', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
        ];
        foreach ($stats as $stat) {
            \App\Models\Stat::updateOrCreate(['label' => $stat['label']], $stat);
        }

        // 12. Services
        $services = [
            [
                'title' => 'Web Development',
                'desc' => 'Pixel-perfect, performant web apps built with Laravel, React, and modern stacks. From landing pages to full enterprise portals.',
                'color' => 'from-blue-500 to-cyan-500',
                'bg' => 'blue-500',
                'icon_path' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
            ],
            [
                'title' => 'SaaS Development',
                'desc' => 'Multi-tenant SaaS platforms with subscription billing, user management, and cloud-ready infrastructure.',
                'color' => 'from-purple-500 to-pink-500',
                'bg' => 'purple-500',
                'icon_path' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
            ],
            [
                'title' => 'Ethical Hacking & Security',
                'desc' => 'Professional penetration testing, security audits, and vulnerability assessments to protect your digital assets.',
                'color' => 'from-red-500 to-orange-500',
                'bg' => 'red-500',
                'icon_path' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            ],
            [
                'title' => 'API Development & Integration',
                'desc' => 'RESTful & GraphQL APIs, third-party integrations (payment gateways, SMS, CRMs), and microservices architecture.',
                'color' => 'from-emerald-500 to-teal-500',
                'bg' => 'emerald-500',
                'icon_path' => 'M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
            ],
            [
                'title' => 'Custom Software Solutions',
                'desc' => 'Bespoke ERP, CRM, and business automation tools engineered specifically for your operational workflow.',
                'color' => 'from-amber-500 to-yellow-500',
                'bg' => 'amber-500',
                'icon_path' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z',
            ],
        ];
        foreach ($services as $service) {
            \App\Models\Service::updateOrCreate(['title' => $service['title']], $service);
        }

        // 13. Plans
        $plans = [
            [
                'name' => 'Basic',
                'price' => '₹4,999',
                'period' => '/month',
                'desc' => 'Perfect for startups and small businesses getting started.',
                'color' => 'border-white/10',
                'btn_style' => 'border border-cyan-500/30 text-cyan-400 hover:bg-cyan-500/10',
                'featured' => false,
                'features' => [
                    '1 Web Application', 'Up to 5 Pages', 'Basic SEO Setup', 'Mobile Responsive', 'SSL Certificate', '1 Month Support', '❌ Custom Integrations', '❌ Priority Support'
                ],
            ],
            [
                'name' => 'Standard',
                'price' => '₹9,999',
                'period' => '/month',
                'desc' => 'The most popular choice for growing businesses.',
                'color' => 'border-cyan-500/50',
                'btn_style' => 'bg-gradient-to-r from-cyan-500 to-electric-500 text-white btn-glow',
                'featured' => true,
                'features' => [
                    'Up to 3 Web Applications', 'Unlimited Pages', 'Advanced SEO + Analytics', 'Custom API Integrations', 'Payment Gateway Setup', '3 Months Priority Support', 'Admin Dashboard', 'Monthly Maintenance'
                ],
            ],
            [
                'name' => 'Pro',
                'price' => '₹24,999',
                'period' => '/month',
                'desc' => 'Enterprise-grade solutions for established companies.',
                'color' => 'border-white/10',
                'btn_style' => 'border border-cyan-500/30 text-cyan-400 hover:bg-cyan-500/10',
                'featured' => false,
                'features' => [
                    'Full SaaS Platform', 'Multi-tenant Architecture', 'Custom Mobile App', 'Security Audit Included', 'Dedicated Developer', '12 Months Support', 'DevOps & CI/CD Setup', '24/7 Priority Support'
                ],
            ],
        ];
        foreach ($plans as $plan) {
            \App\Models\Plan::updateOrCreate(['name' => $plan['name']], $plan);
        }

        // 14. Testimonials
        $testimonials = [
            [
                'name' => 'Rajesh Kumar Sharma',
                'designation' => 'Director, Sunrise Coaching Centre, Patna',
                'avatar' => 'RK',
                'color' => 'from-blue-500 to-cyan-500',
                'rating' => 5,
                'text' => 'AP Coaching SaaS transformed how we manage our institute. The fee collection and attendance modules alone saved us 3 hours daily. Aman\'s team was responsive and delivered exactly what we asked for — and more.',
            ],
            [
                'name' => 'Priya Mishra',
                'designation' => 'Founder, StudyHub Library, Muzaffarpur',
                'avatar' => 'PM',
                'color' => 'from-purple-500 to-indigo-500',
                'rating' => 5,
                'text' => 'The AP Library system is fantastic. Our members love the online seat booking feature. No more queues, no more confusion. The QR check-in is super smooth. Highly recommend AmanProjects!',
            ],
            [
                'name' => 'Amit Sinha',
                'designation' => 'CEO, TechRetail Solutions, Delhi',
                'avatar' => 'AS',
                'color' => 'from-emerald-500 to-teal-500',
                'rating' => 5,
                'text' => 'We hired AmanProjects for a complete ERP integration project. The code quality was exceptional — well-documented, scalable, and secure. The security audit they performed caught 3 critical vulnerabilities. Worth every rupee!',
            ],
            [
                'name' => 'Neha Gupta',
                'designation' => 'Product Manager, FinTech Startup, Bangalore',
                'avatar' => 'NG',
                'color' => 'from-rose-500 to-pink-500',
                'rating' => 5,
                'text' => 'From API design to deployment on AWS — the team handled everything flawlessly. Our API handles 50,000+ daily requests with zero downtime. The post-launch support has been excellent. A trusted partner.',
            ],
        ];
        foreach ($testimonials as $testimonial) {
            \App\Models\Testimonial::updateOrCreate(['name' => $testimonial['name']], $testimonial);
        }

        // 15. Why Choose Us
        $whys = [
            [
                'icon'  => 'M13 10V3L4 14h7v7l9-11h-7z',
                'title' => 'Fast Delivery',
                'desc'  => 'Agile sprints and efficient workflows ensure your project ships on time — always.',
                'color' => 'from-yellow-500 to-amber-500',
            ],
            [
                'icon'  => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                'title' => 'Clean & Scalable Code',
                'desc'  => 'SOLID principles, proper documentation, and future-proof architecture as standard.',
                'color' => 'from-green-500 to-emerald-500',
            ],
            [
                'icon'  => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                'title' => 'Security-First',
                'desc'  => 'Every product is built with security at its core — OWASP compliance, input validation, and encryption.',
                'color' => 'from-red-500 to-rose-500',
            ],
            [
                'icon'  => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
                'title' => 'Ongoing Support',
                'desc'  => "We don't disappear after launch. Dedicated support, bug fixes, and updates — always.",
                'color' => 'from-purple-500 to-indigo-500',
            ],
        ];
        foreach ($whys as $why) {
            \App\Models\WhyChooseUs::updateOrCreate(['title' => $why['title']], $why);
        }

        // 16. Process Steps
        $steps = [
            ['num' => '01', 'title' => 'Requirement Analysis', 'desc' => 'We deep-dive into your goals, audience, and technical requirements to create a precise project blueprint.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
            ['num' => '02', 'title' => 'UI/UX Design', 'desc' => 'Our designers craft stunning, user-centric interfaces with wireframes and interactive prototypes for your approval.', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'],
            ['num' => '03', 'title' => 'Development', 'desc' => 'Clean, documented, and scalable code built with best practices. Regular progress updates and milestone reviews.', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
            ['num' => '04', 'title' => 'Testing & QA', 'desc' => 'Rigorous testing — unit, integration, security audits, and cross-browser compatibility — before any deployment.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['num' => '05', 'title' => 'Deployment & Support', 'desc' => 'Smooth server deployment, monitoring setup, and dedicated post-launch support to keep your product running perfectly.', 'icon' => 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01'],
        ];
        foreach ($steps as $step) {
            \App\Models\ProcessStep::updateOrCreate(['title' => $step['title']], $step);
        }
    }
}
