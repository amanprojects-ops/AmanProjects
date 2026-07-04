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
                'name' => 'Aman Gupta',
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

        // 5. Experiences
        $experiences = [
            [
                'company' => 'TechSolutions Pvt. Ltd.',
                'role' => 'Senior Full Stack Developer',
                'start_date' => '2024-06-01',
                'end_date' => null, // Current job
                'description' => 'Lead development of core web applications using Laravel and React. Managed database optimization, API integrations, and CI/CD deployment pipelines on AWS. Mentored junior developers.',
                'order' => 1,
            ],
            [
                'company' => 'Global Web Agency',
                'role' => 'Web Developer',
                'start_date' => '2022-03-01',
                'end_date' => '2024-05-31',
                'description' => 'Developed custom e-commerce stores, content management systems, and corporate portals. Worked closely with designers to build fully responsive frontend user interfaces using modern CSS frameworks.',
                'order' => 2,
            ],
            [
                'company' => 'Innovate Tech Startup',
                'role' => 'Junior Software Engineer',
                'start_date' => '2021-01-15',
                'end_date' => '2022-02-28',
                'description' => 'Assisted in building RESTful APIs using Node.js/Express and PHP. Maintained database schemas, resolved bugs, and participated in agile daily standups and code reviews.',
                'order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(
                ['company' => $exp['company'], 'role' => $exp['role']],
                $exp
            );
        }

        // 6. Educations
        $educations = [
            [
                'institute' => 'Delhi Technological University',
                'degree' => 'Master of Computer Applications (MCA)',
                'start_date' => '2019-07-01',
                'end_date' => '2021-06-30',
                'description' => 'Specialized in Software Engineering and Database Management Systems. Graduated with First Class Distinction.',
                'order' => 1,
            ],
            [
                'institute' => 'University of Delhi',
                'degree' => 'Bachelor of Science (B.Sc.) in Computer Science',
                'start_date' => '2016-07-01',
                'end_date' => '2019-06-30',
                'description' => 'Acquired strong foundation in algorithms, data structures, and object-oriented programming concepts.',
                'order' => 2,
            ],
        ];

        foreach ($educations as $edu) {
            Education::updateOrCreate(
                ['institute' => $edu['institute'], 'degree' => $edu['degree']],
                $edu
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
    }
}
