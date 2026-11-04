<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class ServiceDataSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'id' => 1,
                'title' => 'Web Development',
                'slug' => 'website-developer-in-saharsa',
                'tagline' => 'High-Performance, Custom Websites & Web Applications Built with Laravel, React & Next.js',
                'badge' => 'Most Requested in Saharsa',
                'desc' => 'Pixel-perfect, ultra-fast custom websites and web applications built for businesses in Saharsa and Bihar. Designed to rank #1 on Google and turn local visitors into paying customers.',
                'color' => 'from-blue-500 to-cyan-500',
                'bg' => 'blue-500',
                'icon_path' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                'sort_order' => 1,
                'is_active' => true,
                'meta_title' => 'Website Developer in Saharsa | Best Web Design Agency Bihar — AmanProjects',
                'meta_description' => 'Looking for a top website developer in Saharsa, Bihar? AmanProjects builds high-speed, SEO-optimized custom websites, eCommerce portals, and Laravel web apps. Get a free quote today!',
                'meta_keywords' => 'website developer in saharsa, web development company in saharsa, web designer saharsa, website design bihar, laravel developer bihar, react developer saharsa, best software company saharsa',
                'features' => [
                    'Custom Hand-Coded Architecture (Zero Bloated WordPress Themes)',
                    'Sub-Second Page Load Speed with Tailwind CSS & Clean PHP/Laravel',
                    'Mobile-First Responsive Design for 100% Smartphone Compatibility',
                    'Built-in Local SEO & Schema.org Markup for Saharsa & Bihar Rankings',
                    'Secure Admin Panel to Manage Banners, Content, Blogs & Enquiries',
                    'Direct WhatsApp, Click-to-Call, and Google Maps Local Integration'
                ],
                'pricing_tiers' => [
                    [
                        'name' => 'Starter Business Website',
                        'price' => '₹7,999',
                        'period' => 'one-time',
                        'desc' => 'Perfect for local clinics, coaching institutes, shops, and service providers in Saharsa wanting a strong digital presence.',
                        'features' => [
                            'Up to 5 High-Converting Responsive Pages',
                            'Mobile-Friendly & Lightning-Fast Loading',
                            'WhatsApp Chat & Click-to-Call Buttons',
                            'Google Maps Location & Contact Form',
                            'Basic Local SEO Setup & Google Indexing',
                            '1 Year Free Domain & High-Speed Hosting Guidance'
                        ],
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Professional Growth Portal',
                        'price' => '₹18,999',
                        'period' => 'one-time',
                        'desc' => 'Best for expanding companies, schools, real estate firms, and e-commerce stores requiring dynamic features.',
                        'features' => [
                            'Up to 15 Dynamic Pages + Content Admin Dashboard',
                            'Full Product Catalog or Service Listing Engine',
                            'Lead Capture System with Instant Email & SMS Alerts',
                            'Advanced Schema Markup & On-Page Local SEO',
                            'Payment Gateway Integration (Razorpay / UPI)',
                            '3 Months Free Maintenance & Priority Support'
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Custom Web App / Enterprise',
                        'price' => 'Custom Quote',
                        'period' => 'milestone-based',
                        'desc' => 'For complex portals, multi-branch institutions, custom SaaS, and high-traffic enterprise platforms.',
                        'features' => [
                            'Full-Stack Custom Engineering (Laravel + React/Next.js)',
                            'Custom Database Architecture & Secure REST APIs',
                            'Role-Based Staff Access & Activity Logging',
                            'Cloud Server Deployment (AWS / DigitalOcean)',
                            'Automated Backups & Bank-Grade Security Hardening',
                            'Dedicated Developer Support & SLA Guarantee'
                        ],
                        'is_featured' => false,
                    ],
                ],
                'process_steps' => [
                    [
                        'step' => '01',
                        'title' => 'Discovery & Local Strategy',
                        'desc' => 'We analyze your business model, target audience in Saharsa and across Bihar, and study top local competitors to formulate an effective digital roadmap.'
                    ],
                    [
                        'step' => '02',
                        'title' => 'UI/UX Wireframing & Design',
                        'desc' => 'We create sleek, modern prototypes focusing on seamless user journeys, high readability, and effortless conversion triggers.'
                    ],
                    [
                        'step' => '03',
                        'title' => 'Clean Modular Development',
                        'desc' => 'We write robust, secure, and clean code using modern technologies like Laravel and Tailwind CSS — ensuring lightning-fast load times with zero bloat.'
                    ],
                    [
                        'step' => '04',
                        'title' => 'Rigorous Testing & Local SEO',
                        'desc' => 'We perform multi-device responsiveness testing, speed audits on Google PageSpeed Insights, and implement complete LocalBusiness Schema markup.'
                    ],
                    [
                        'step' => '05',
                        'title' => 'Deployment & Ongoing Support',
                        'desc' => 'We launch your website on high-performance cloud servers, submit your sitemap to Google Search Console, and provide complete administrative training.'
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Why should I hire a local website developer in Saharsa instead of a distant agency?',
                        'answer' => 'Working with a local developer like AmanProjects in Saharsa gives you direct, transparent communication without agency middlemen. We understand the local market demographics of Saharsa, Supaul, and Madhepura, and can meet face-to-face to discuss project requirements, deliver faster iterations, and provide reliable on-demand support.'
                    ],
                    [
                        'question' => 'How much does a custom website cost in Saharsa, Bihar?',
                        'answer' => 'Our custom website development packages start from ₹7,999 for basic professional business websites and scale up to ₹18,999+ for dynamic commercial portals and eCommerce applications. We provide clear upfront milestone pricing with zero hidden charges.'
                    ],
                    [
                        'question' => 'How long does it take to design and launch my website?',
                        'answer' => 'Standard business websites are typically ready for launch in 5 to 10 business days. Custom dynamic portals and e-commerce websites usually take 2 to 3 weeks, depending on the complexity of features and integrations required.'
                    ],
                    [
                        'question' => 'Will my website rank on Google for local searches in Saharsa?',
                        'answer' => 'Yes! Every website we develop includes foundational on-page SEO, geo-targeted meta tags, Google Search Console integration, XML sitemap generation, and Schema.org structured data to help your business rank at the top for local search queries like "best coaching in Saharsa" or "doctor in Saharsa".'
                    ],
                    [
                        'question' => 'Can I easily update photos, blogs, and content myself after the website is launched?',
                        'answer' => 'Absolutely. We provide an intuitive, easy-to-use admin dashboard that lets you edit text, upload new photos, post blog articles, and review customer inquiries without needing any programming knowledge.'
                    ],
                ],
                'content' => '<h2>Why Your Business in Saharsa Needs a High-Performance Custom Website</h2>
<p>In today\'s digital-first economy, customer discovery has fundamentally shifted. Whether a customer is looking for a specialized coaching institute in Saharsa, a healthcare clinic, a retail showroom, or legal and commercial consulting, their first action is to search on Google. Having a slow, generic, or outdated website — or worse, relying solely on social media pages — costs you credibility, trust, and daily customer inquiries.</p>
<p>At <strong>AmanProjects</strong>, we are Saharsa’s premier custom web development partner. Led by experienced full-stack engineers, we build digital platforms that do not just look stunning — they are engineered from the ground up for lightning speed, bank-grade security, and superior local SEO rankings across Saharsa, Supaul, Madhepura, and the entire Kosi region of Bihar.</p>

<h3>The Problem with Cheap WordPress Templates & Slow Page Builders</h3>
<p>Many local business owners fall into the trap of buying cheap ₹2,000 WordPress sites from freelancers who install pirated themes and dozens of unneeded plugins. The result? A website that takes 8 to 12 seconds to load on mobile networks, breaks frequently on software updates, gets hacked easily, and never appears on Google\'s first page. Google\'s Core Web Vitals algorithms penalize slow websites heavily.</p>
<p>We do things differently. Every website built by AmanProjects is custom-coded using modern, clean frameworks like <strong>Laravel, React, Tailwind CSS, and Alpine.js</strong>. By eliminating bloated dependencies and optimizing every database query, our websites load in under 1 second even on 4G networks in rural Bihar, giving your visitors an instantaneous, app-like browsing experience.</p>

<h3>Comprehensive Web Development Solutions We Offer in Saharsa</h3>
<ul>
  <li><strong>Corporate & Business Websites:</strong> Showcase your company\'s services, portfolio, client testimonials, and credentials with premium glassmorphism aesthetics and custom typography.</li>
  <li><strong>E-Commerce & Online Stores:</strong> Complete shopping portals with product catalogs, shopping carts, instant UPI & Razorpay payments, automated invoice generation, and WhatsApp order alerts.</li>
  <li><strong>Educational & Coaching Portals:</strong> Online admission forms, student fee payment collection, batch schedules, syllabus downloads, and notice boards for Saharsa\'s growing educational sector.</li>
  <li><strong>Healthcare & Hospital Websites:</strong> Doctor profiles, online OPD appointment booking, departmental listings, and emergency hotline click-to-call integration.</li>
  <li><strong>Custom Web Portals & CRM:</strong> Internal staff portals, quotation generators, client management dashboards, and inventory trackers built specifically for your day-to-day workflow.</li>
</ul>

<h3>Our Competitive Edge: Authentic Local Knowledge & Zero Middlemen</h3>
<p>When you partner with AmanProjects, you talk directly to the engineers building your code. There are no smooth-talking sales agents or outsourced third parties. We take the time to understand your real business objectives, tailor every screen to your audience\'s preferences, and support you long after the website is live. If you want a website that generates real telephone calls, store walk-ins, and online orders in Saharsa, reach out to us today for a free strategic consultation.</p>'
            ],
            [
                'id' => 2,
                'title' => 'Mobile App Development',
                'slug' => 'app-developer-in-saharsa',
                'tagline' => 'Native & Cross-Platform Android and iOS Apps Engineered with Flutter & React Native',
                'badge' => 'Trending in Bihar',
                'desc' => 'High-speed, beautiful mobile applications for Android & iOS. Engineered with Flutter and React Native, complete with Play Store publishing, payment gateways, and real-time backend.',
                'color' => 'from-indigo-500 to-purple-500',
                'bg' => 'indigo-500',
                'icon_path' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                'sort_order' => 2,
                'is_active' => true,
                'meta_title' => 'App Developer in Saharsa | Android & iOS Mobile App Company Bihar — AmanProjects',
                'meta_description' => 'Top-rated mobile app developer in Saharsa, Bihar. We develop high-speed Flutter & React Native Android and iOS apps with custom APIs, offline sync, and Play Store publishing. Consult now!',
                'meta_keywords' => 'app developer in saharsa, mobile app development saharsa, android app developer bihar, ios app development saharsa, flutter developer saharsa, mobile application company bihar',
                'features' => [
                    'Cross-Platform Single Codebase for Both Android & iOS',
                    'Built with Google Flutter & React Native for 60fps Native Performance',
                    'Seamless Online & Offline Sync with SQLite / Realm Local Storage',
                    'Push Notifications, Firebase Cloud Messaging & In-App Alerts',
                    'Secure Biometric (Fingerprint & FaceID) Authentication',
                    'Full Google Play Store & Apple App Store Publishing Support'
                ],
                'pricing_tiers' => [
                    [
                        'name' => 'MVP / Starter Mobile App',
                        'price' => '₹24,999',
                        'period' => 'one-time',
                        'desc' => 'Ideal for launching a startup concept, community tool, or simple business app to validate your market idea.',
                        'features' => [
                            'Android App Build with Flutter',
                            'User Authentication (OTP / Google Sign-in)',
                            'Up to 8 Core Screens & Interactive Menus',
                            'Firebase Realtime Backend & Cloud Storage',
                            'Push Notification Broadcasts',
                            'Google Play Store Publishing Assistance'
                        ],
                        'is_featured' => false,
                    ],
                    [
                        'name' => 'Commercial Business App',
                        'price' => '₹44,999',
                        'period' => 'one-time',
                        'desc' => 'Comprehensive mobile app for eCommerce, food delivery, service booking, or coaching institutes.',
                        'features' => [
                            'Both Android & iOS Ready Apps',
                            'Integrated Payment Gateway (UPI, Cards, NetBanking)',
                            'Real-Time Order Tracking & Status Updates',
                            'In-App Chat or WhatsApp Direct Support',
                            'Dedicated Web Admin Panel to Control App Content',
                            '3 Months Free Bug Fixing & Version Updates'
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Enterprise Custom App',
                        'price' => 'Custom Quote',
                        'period' => 'milestone-based',
                        'desc' => 'High-concurrency on-demand platforms, multi-vendor marketplaces, and field staff tracking systems.',
                        'features' => [
                            'Customer App + Driver/Vendor App + Admin Dashboard',
                            'Live GPS Tracking, Geofencing & Route Optimization',
                            'High-Throughput Microservice REST API Backend',
                            'Custom Video/Audio Streaming or Live Calling',
                            'Strict OWASP Mobile Security Compliance',
                            'Dedicated SLA & Continuous Feature Development'
                        ],
                        'is_featured' => false,
                    ],
                ],
                'process_steps' => [
                    [
                        'step' => '01',
                        'title' => 'Concept & User Flow Mapping',
                        'desc' => 'We define the end-to-end user journey, feature sets, technical architecture, and database requirements for your mobile app.'
                    ],
                    [
                        'step' => '02',
                        'title' => 'Figma UI/UX Prototyping',
                        'desc' => 'We design sleek, human-centric mobile screens following Google Material 3 and Apple Human Interface Guidelines.'
                    ],
                    [
                        'step' => '03',
                        'title' => 'Frontend & Backend Engineering',
                        'desc' => 'We develop the application using Flutter or React Native, connected to high-speed secure REST APIs developed in Laravel.'
                    ],
                    [
                        'step' => '04',
                        'title' => 'Device Testing & QA',
                        'desc' => 'We test the app across dozens of real Android & iOS devices for battery efficiency, memory usage, and varying network speeds.'
                    ],
                    [
                        'step' => '05',
                        'title' => 'Store Submission & Launch',
                        'desc' => 'We handle the entire submission process on Google Play Console and Apple App Store, ensuring 100% compliance with store policies.'
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Can you build an app that runs on both Android and iPhone from one codebase?',
                        'answer' => 'Yes! We specialize in cross-platform development using Google Flutter and React Native. This allows you to launch on both Google Play Store and Apple App Store with a single codebase, cutting your development costs and launch timeline in half without sacrificing native performance.'
                    ],
                    [
                        'question' => 'How much does it cost to build a mobile app in Saharsa?',
                        'answer' => 'Basic mobile apps start from ₹24,999. Commercial business applications with payment processing, push notifications, and administrative dashboards typically range from ₹44,999 to ₹85,000+. We offer transparent milestone payments tied to actual deliverables.'
                    ],
                    [
                        'question' => 'Will you publish my app on the Google Play Store?',
                        'answer' => 'Yes. We handle the entire release lifecycle — including app bundle generation, icon and banner preparation, privacy policy documentation, Play Store content rating compliance, and submission review.'
                    ],
                    [
                        'question' => 'Will I own the complete source code of my mobile app?',
                        'answer' => '100% yes. Upon project completion and final settlement, we transfer the full intellectual property rights, source code repository, and backend access credentials directly to you.'
                    ],
                    [
                        'question' => 'Can my app work offline when there is poor internet connectivity?',
                        'answer' => 'Yes, we can architect local caching and SQLite databases that allow users to browse products, view saved data, or draft forms even without internet, automatically syncing data once the connection is restored.'
                    ],
                ],
                'content' => '<h2>Turn Your Smartphone App Idea into Reality with Saharsa\'s Premier App Developers</h2>
<p>India is mobile-first, and nowhere is this more evident than in Bihar. Today, over 88% of all online interactions, digital payments, and service bookings occur on smartphones. If you are operating a business in Saharsa, Supaul, Madhepura, or across Bihar, relying solely on a physical shopfront or website is no longer enough to build enduring customer loyalty. A dedicated mobile application places your brand directly inside your customer\'s pocket, with zero friction and instant push accessibility.</p>
<p>At <strong>AmanProjects</strong>, we are Saharsa\'s leading mobile application development agency. We engineer cross-platform Android and iOS applications that deliver fluid 60-frames-per-second performance, intuitive user interfaces, and robust cloud backends that never crash under load.</p>

<h3>Why Choose Flutter & Modern Cross-Platform Architecture?</h3>
<p>Historically, building a mobile application required hiring two separate engineering teams — one for Android (using Java or Kotlin) and another for iOS (using Swift). This doubled the cost and created frustrating maintenance headaches.</p>
<p>We leverage <strong>Google Flutter and React Native</strong>, the industry-standard cross-platform frameworks. With Flutter, we write one beautifully architected codebase that compiles directly to native ARM machine code for both Android smartphones and Apple iPhones. You get identical native animations, camera and GPS hardware access, and top-tier security at half the development cost and half the delivery timeline.</p>

<h3>Mobile App Solutions We Build for Bihar Businesses</h3>
<ul>
  <li><strong>E-Commerce & Quick Commerce Apps:</strong> Deliver groceries, clothing, hardware, or electronics across Saharsa with instant cart checkout, live Google Maps rider tracking, and automated UPI payment integration.</li>
  <li><strong>Coaching & Online Education Apps:</strong> Empower students in the Kosi region with recorded video lectures, live classes, PDF notes sharing, MCQ quizzes, and automated online test series.</li>
  <li><strong>Doctor & Clinic Appointment Apps:</strong> Enable patients to view doctor schedules, book OPD tokens, receive digital prescriptions, and avoid crowded waiting rooms.</li>
  <li><strong>Field Force & Sales Tracking Apps:</strong> Monitor sales representatives, track daily customer visits with GPS timestamps, collect digital orders, and manage inventory on the fly.</li>
  <li><strong>Logistics, Transport & Booking Apps:</strong> On-demand vehicle booking, parcel tracking, and driver management systems tailored to local transport logistics.</li>
</ul>

<h3>End-to-End Delivery: From First Sketch to Google Play Store</h3>
<p>Building an app is not just about writing code; it is about navigating strict Google and Apple submission policies, privacy compliance, and device fragmentation across thousands of Android models. At AmanProjects, we take full responsibility for your application\'s success. We design the UI in Figma, develop the app with clean reactive architecture, set up the cloud databases, and handle the entire Play Store approval process until your app is live and ready for download.</p>'
            ],
            [
                'id' => 3,
                'title' => 'SaaS Development',
                'slug' => 'saas-development-in-saharsa',
                'tagline' => 'Turn Your Software Idea into Scalable Recurring Revenue with Multi-Tenant Cloud Architecture',
                'badge' => 'Cloud Architecture',
                'desc' => 'Scalable multi-tenant SaaS platforms featuring automated subscription billing, granular role permissions, and cloud-ready infrastructure built to handle millions of requests.',
                'color' => 'from-purple-500 to-pink-500',
                'bg' => 'purple-500',
                'icon_path' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
                'sort_order' => 3,
                'is_active' => true,
                'meta_title' => 'SaaS Development Company in Saharsa | Multi-Tenant Cloud Software Bihar',
                'meta_description' => 'Build and launch your SaaS product with AmanProjects in Saharsa, Bihar. Multi-tenancy, Stripe/Razorpay billing, RBAC security, and scalable cloud architecture engineered for scale.',
                'meta_keywords' => 'saas development company saharsa, cloud software developer bihar, build saas product india, multi tenant application laravel, b2b saas development',
                'features' => [
                    'Multi-Tenant Database Architecture (Row-Level or Schema Separation)',
                    'Automated Recurring Billing (Stripe Subscriptions, Razorpay Plans)',
                    'Granular Role-Based Access Control (SuperAdmin, OrgAdmin, Staff, Client)',
                    'High-Speed Caching & Message Queues with Redis & RabbitMQ',
                    'Interactive Developer API with Automated Swagger Documentation',
                    'Cloud Autoscaling on AWS, DigitalOcean, or Docker Swarm'
                ],
                'pricing_tiers' => [
                    [
                        'name' => 'SaaS MVP Sprint',
                        'price' => '₹49,999',
                        'period' => 'starting from',
                        'desc' => 'Turn your software idea into a functional, revenue-ready MVP in 4 to 6 weeks to onboard initial paying users.',
                        'features' => [
                            'Core Business Logic & User Workflows',
                            'Multi-Tenant Authentication & Organization Switching',
                            'Stripe / Razorpay Subscription Checkout',
                            'SuperAdmin Dashboard for Metrics & User Management',
                            'Cloud Server Deployment & Domain Configuration',
                            'Complete Documentation & Source Code Transfer'
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Growth Stage SaaS Platform',
                        'price' => 'Custom Quote',
                        'period' => 'sprint-based',
                        'desc' => 'For platforms with scaling user bases requiring microservices, webhooks, and enterprise integrations.',
                        'features' => [
                            'Advanced Analytics Dashboards with Chart.js / ApexCharts',
                            'External Webhooks & Zapier Integration Endpoints',
                            'Audit Logs & Enterprise Security Compliance',
                            'Automated Multi-Region Database Backups',
                            'CI/CD Deployment Pipelines with Zero Downtime',
                            'Dedicated Senior Engineering Support'
                        ],
                        'is_featured' => false,
                    ],
                ],
                'process_steps' => [
                    [
                        'step' => '01',
                        'title' => 'Architecture & Data Modeling',
                        'desc' => 'We design tenant isolation strategies, database relationships, and caching layers to guarantee zero data bleeding across tenants.'
                    ],
                    [
                        'step' => '02',
                        'title' => 'Subscription Billing Engine',
                        'desc' => 'We build automated billing cycles, tiered plans, trial periods, metered usage calculations, and automated tax invoicing.'
                    ],
                    [
                        'step' => '03',
                        'title' => 'Frontend Dashboard & UX',
                        'desc' => 'We create intuitive, high-performance web dashboards using React, Vue, or Blade with reactive live data.'
                    ],
                    [
                        'step' => '04',
                        'title' => 'Security Audit & Load Testing',
                        'desc' => 'We simulate thousands of concurrent tenant requests to ensure database indexing and cache efficiency under heavy load.'
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'What is multi-tenancy in SaaS and why does it matter?',
                        'answer' => 'Multi-tenancy allows a single instance of your software to serve multiple customer organizations (tenants), while strictly keeping their data isolated and secure. This dramatically reduces your server hosting bills and simplifies software updates.'
                    ],
                    [
                        'question' => 'Can you integrate recurring subscription payments for Indian customers?',
                        'answer' => 'Yes. We integrate Razorpay Subscriptions (supporting UPI Autopay and e-Mandate) as well as Stripe Billing for international credit cards, ensuring automated renewal collections without manual follow-up.'
                    ],
                ],
                'content' => '<h2>Architect and Launch High-Growth Cloud Software from Bihar</h2>
<p>Software-as-a-Service (SaaS) is the most lucrative business model of the 21st century. Instead of selling one-off software licenses, a SaaS platform generates predictable, recurring monthly and annual subscription revenue that scales exponentially with minimal marginal cost.</p>
<p>Building a successful SaaS application requires far more than generic website development. It demands specialized architectural expertise in <strong>multi-tenant database modeling, recurring subscription logic, granular permission matrices, and cloud horizontal scaling</strong>. At <strong>AmanProjects</strong>, we partner with founders and enterprises across India to transform domain expertise into enterprise-grade SaaS products.</p>

<h3>Key Architectural Pillars of Our SaaS Engineering</h3>
<ul>
  <li><strong>Tenant Data Isolation:</strong> Whether using schema separation or row-level tenant keys, we guarantee that no organization can ever view or leak another organization\'s private records.</li>
  <li><strong>Frictionless Monetization:</strong> Integrated billing flows with free trials, tiered subscription upgrades, prorated billing, automated invoice emails, and dunning management for failed payments.</li>
  <li><strong>Granular Role-Based Access Control (RBAC):</strong> Empowers customer admins to invite team members and assign specific read, write, or manage permissions across every module.</li>
  <li><strong>Lightning Fast API Backends:</strong> Built with PHP 8.3 and Laravel, fortified with Redis caching and asynchronous background queues for sub-50ms query responses.</li>
</ul>'
            ],
            [
                'id' => 4,
                'title' => 'Ethical Hacking & Security',
                'slug' => 'cybersecurity-services-in-saharsa',
                'tagline' => 'Protect Your Web Applications, APIs & Servers from Cyber Attacks, Ransomware and Data Leaks',
                'badge' => 'Certified Security',
                'desc' => 'Professional penetration testing, OWASP vulnerability assessments, source code security audits, and server hardening to protect your digital reputation.',
                'color' => 'from-red-500 to-orange-500',
                'bg' => 'red-500',
                'icon_path' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                'sort_order' => 4,
                'is_active' => true,
                'meta_title' => 'Cybersecurity Services in Saharsa | Ethical Hacker & Security Audits Bihar',
                'meta_description' => 'Certified cybersecurity and penetration testing services in Saharsa, Bihar. We audit web apps, APIs, and servers to eliminate vulnerabilities before hackers exploit them.',
                'meta_keywords' => 'cybersecurity services saharsa, ethical hacker bihar, website security audit saharsa, penetration testing bihar, owasp top 10 audit, web application security',
                'features' => [
                    'OWASP Top 10 Web Application Penetration Testing (WAPT)',
                    'Automated & Manual Exploitation Analysis for SQLi, XSS & CSRF',
                    'Authentication Bypass & Privilege Escalation Testing',
                    'Server Port Scanning & Network Security Hardening',
                    'Source Code Static & Dynamic Analysis (SAST / DAST)',
                    'Executive Summary & Developer-Friendly Remediation Reports'
                ],
                'pricing_tiers' => [
                    [
                        'name' => 'Standard Web Security Audit',
                        'price' => '₹14,999',
                        'period' => 'per audit',
                        'desc' => 'Comprehensive vulnerability assessment for corporate websites, e-commerce stores, and public portals.',
                        'features' => [
                            'Complete Vulnerability Scan & Manual Verification',
                            'OWASP Top 10 Security Assessment',
                            'SSL / TLS Configuration & Security Headers Audit',
                            'Detailed Vulnerability Assessment Report (PDF)',
                            'Developer Guidance for Patching Vulnerabilities',
                            'One Free Post-Fix Re-Test'
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Full Application Penetration Test',
                        'price' => '₹34,999',
                        'period' => 'per application',
                        'desc' => 'Deep grey-box / black-box penetration testing for SaaS portals, fintech apps, and healthcare databases.',
                        'features' => [
                            'Logic Flaw & Business Logic Vulnerability Exploitation',
                            'API Security Testing (Broken Object Level Authorization - BOLA)',
                            'Database Injection & Remote Code Execution Vectors',
                            'Executive Risk Summary for Management & Investors',
                            'Proof-of-Concept (PoC) Exploitation Demos',
                            'Official Security Audit Certificate upon Remediation'
                        ],
                        'is_featured' => false,
                    ],
                ],
                'process_steps' => [
                    [
                        'step' => '01',
                        'title' => 'Scoping & Non-Disclosure Agreement',
                        'desc' => 'We define the testing boundaries, agree on rules of engagement, and sign strict NDAs to safeguard your proprietary data.'
                    ],
                    [
                        'step' => '02',
                        'title' => 'Reconnaissance & Threat Mapping',
                        'desc' => 'We map application attack surfaces, exposed endpoints, software libraries, and server configurations.'
                    ],
                    [
                        'step' => '03',
                        'title' => 'Vulnerability Exploitation',
                        'desc' => 'We simulate real-world attacks to identify security weaknesses before malicious black-hat hackers can discover them.'
                    ],
                    [
                        'step' => '04',
                        'title' => 'Remediation & Certification',
                        'desc' => 'We deliver actionable code fixes, assist your team in patching, and verify all vulnerabilities have been closed.'
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Will penetration testing cause any downtime to our live website?',
                        'answer' => 'No. We conduct tests with controlled payloads and rate limits to avoid denial of service, or we can test against your staging environment to guarantee zero disruption to your daily operations.'
                    ],
                    [
                        'question' => 'Why do small businesses in Bihar need cybersecurity?',
                        'answer' => 'Hackers use automated bots that scan IP ranges regardless of company size. An unpatched SQL injection or exposed admin panel can wipe your customer database, leak confidential orders, or lock your files behind ransomware.'
                    ],
                ],
                'content' => '<h2>Safeguard Your Digital Assets and Business Reputation in an Era of Cyber Threats</h2>
<p>Every single day, thousands of Indian websites and servers are compromised. From ransomware locking business data to hackers silently stealing customer databases and payment credentials, cyber attacks are no longer reserved for large multinational banks. Small and medium enterprises across Bihar, government contracting portals, educational institutes, and retail platforms are targeted daily due to weak default configurations and outdated code.</p>
<p>At <strong>AmanProjects</strong>, we provide certified, white-hat ethical hacking and cybersecurity auditing services. We think like hackers to discover and eliminate vulnerabilities in your systems before cybercriminals can exploit them.</p>

<h3>Comprehensive Vulnerability Assessment & Penetration Testing (VAPT)</h3>
<p>We perform rigorous manual and automated security evaluations following the internationally recognized <strong>OWASP Top 10 and SANS 25</strong> security standards:</p>
<ul>
  <li><strong>SQL Injection & Database Security:</strong> Ensuring malicious inputs cannot read, alter, or drop your backend databases.</li>
  <li><strong>Cross-Site Scripting (XSS) & Session Hijacking:</strong> Protecting your customers from malicious scripts and stolen session cookies.</li>
  <li><strong>Broken Authentication & Access Control:</strong> Verifying that unauthorized users cannot bypass logins or view sensitive administrative dashboards.</li>
  <li><strong>API Security Testing:</strong> Inspecting REST and GraphQL endpoints for data leakage, insecure direct object references, and missing rate limits.</li>
  <li><strong>Server & Cloud Hardening:</strong> Closing unused ports, disabling dangerous PHP functions, enforcing HTTPS, and configuring Web Application Firewalls (WAF).</li>
</ul>'
            ],
            [
                'id' => 5,
                'title' => 'API Development & Integration',
                'slug' => 'api-development-in-saharsa',
                'tagline' => 'Connect Your Apps, Payment Gateways & Third-Party Platforms with High-Throughput APIs',
                'badge' => 'Sub-50ms Latency',
                'desc' => 'RESTful and GraphQL APIs, third-party integrations (Razorpay, WhatsApp Business API, SMS, Zoho, Shiprocket), and microservices architecture engineered for high speed.',
                'color' => 'from-emerald-500 to-teal-500',
                'bg' => 'emerald-500',
                'icon_path' => 'M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                'sort_order' => 5,
                'is_active' => true,
                'meta_title' => 'API Development & Integration Services in Saharsa | REST & GraphQL Bihar',
                'meta_description' => 'Custom API development and payment gateway integration services in Saharsa, Bihar. Connect WhatsApp Cloud API, payment gateways, and CRMs with zero downtime and sub-50ms latency.',
                'meta_keywords' => 'api development services in saharsa, payment gateway integration bihar, whatsapp business api saharsa, rest api developer bihar, graphql api development',
                'features' => [
                    'RESTful & GraphQL API Architecture Built for Mobile & Web',
                    'Payment Gateway Integration (Razorpay, Cashfree, PhonePe, Stripe)',
                    'WhatsApp Business Cloud API & Transactional SMS Gateways',
                    'Logistics & Courier Integration (Shiprocket, Delhivery APIs)',
                    'JWT, OAuth2 & API Key Header Authentication Security',
                    'Interactive Swagger / OpenAPI Documentation with Sandbox Testing'
                ],
                'pricing_tiers' => [
                    [
                        'name' => 'Third-Party Integration Sprint',
                        'price' => '₹9,999',
                        'period' => 'per integration',
                        'desc' => 'Seamlessly hook payment gateways, WhatsApp messaging, or SMS verification into your existing software.',
                        'features' => [
                            'Payment Gateway Integration with Webhook Verification',
                            'WhatsApp Notification Alerts for Orders & Bookings',
                            'SMS OTP Integration for Fast User Login',
                            'Error Handling & Automatic Retry Fallback',
                            'End-to-End Sandbox & Production Testing'
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Custom REST API Suite',
                        'price' => '₹24,999',
                        'period' => 'starting from',
                        'desc' => 'Complete backend API infrastructure to power mobile apps, frontend clients, and partner integrations.',
                        'features' => [
                            'Full CRUD API Endpoints with Clean JSON Responses',
                            'Role & Token-Based Authentication (Sanctum / Passport)',
                            'Strict Request Validation & Rate Limiting (Throttle)',
                            'Redis In-Memory Caching for Sub-50ms Responses',
                            'Interactive Swagger Documentation for External Teams'
                        ],
                        'is_featured' => false,
                    ],
                ],
                'process_steps' => [
                    [
                        'step' => '01',
                        'title' => 'API Contract & Schema Design',
                        'desc' => 'We define request and response JSON payloads, HTTP status codes, and security authentication protocols.'
                    ],
                    [
                        'step' => '02',
                        'title' => 'Core Development & Validation',
                        'desc' => 'We write optimized endpoints with sanitization, robust validation, and database eager loading to eliminate N+1 queries.'
                    ],
                    [
                        'step' => '03',
                        'title' => 'Webhook & Asynchronous Queue Handling',
                        'desc' => 'We implement idempotent webhook listeners and queue workers to process external events reliably without dropped data.'
                    ],
                    [
                        'step' => '04',
                        'title' => 'Postman Testing & Documentation',
                        'desc' => 'We generate interactive Postman collections and OpenAPI documentation for immediate developer onboarding.'
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Can you integrate WhatsApp notifications into our billing or ecommerce system?',
                        'answer' => 'Yes! We integrate the official Meta WhatsApp Business Cloud API to automatically send order confirmations, PDF invoices, OTPs, and delivery updates directly to your customer\'s WhatsApp.'
                    ],
                    [
                        'question' => 'Which payment gateways can you integrate?',
                        'answer' => 'We integrate all leading Indian and global payment gateways, including Razorpay, PhonePe, Cashfree, PayU, Paytm, and Stripe, supporting instant UPI QR codes, debit/credit cards, and net banking.'
                    ],
                ],
                'content' => '<h2>High-Throughput APIs and Seamless Software Integrations</h2>
<p>Modern software applications do not live in silos. Your mobile application must communicate instantaneously with your web dashboard; your e-commerce store must verify customer UPI payments via webhooks within milliseconds; and your billing system should automatically dispatch WhatsApp alerts and shipping labels to courier networks.</p>
<p>At <strong>AmanProjects</strong>, we build high-speed, secure, and resilient Application Programming Interfaces (APIs). Whether you need custom RESTful microservices for a new mobile product or need to connect your existing website to third-party tools, our engineering ensures sub-50ms response times and 99.99% uptime.</p>'
            ],
            [
                'id' => 6,
                'title' => 'Custom Software Solutions',
                'slug' => 'software-developer-in-saharsa',
                'tagline' => 'Bespoke ERP, Billing, Inventory & Business Automation Engineered for Your Exact Workflow',
                'badge' => '100% Tailored',
                'desc' => 'Custom business software, billing systems, school/hospital ERPs, and workflow automation built specifically for Bihar enterprises with lifetime ownership and zero recurring user licenses.',
                'color' => 'from-amber-500 to-yellow-500',
                'bg' => 'amber-500',
                'icon_path' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z',
                'sort_order' => 6,
                'is_active' => true,
                'meta_title' => 'Custom Software Developer in Saharsa | Business ERP & Billing Software Bihar',
                'meta_description' => 'Best custom software development company in Saharsa, Bihar. We develop tailor-made ERP, billing, inventory, and management systems for local businesses with lifetime ownership.',
                'meta_keywords' => 'software developer in saharsa, custom software development bihar, billing software saharsa, erp development saharsa, business automation software bihar',
                'features' => [
                    'Tailored to Your Exact Business Workflow (Zero Unnecessary Features)',
                    'Offline-Ready or Cloud-Based Deployment with Multi-Branch Support',
                    'GST-Compliant Billing, Barcode Scanning & Thermal Invoice Printing',
                    'Real-Time Inventory Stock Alerts & Low-Stock WhatsApp Notifications',
                    'Lifetime Software Ownership with Zero Per-User Monthly Rental Fees',
                    'On-Site & Virtual Staff Training in Saharsa with Lifetime Local Support'
                ],
                'pricing_tiers' => [
                    [
                        'name' => 'Single-Branch Business Software',
                        'price' => '₹19,999',
                        'period' => 'one-time investment',
                        'desc' => 'Ideal for retail shops, distributors, private clinics, and local coaching centers in Saharsa.',
                        'features' => [
                            'Custom GST Billing & Inventory Management',
                            'Customer & Supplier Ledger (Udhaar Khata)',
                            'Barcode Scanner & Thermal Printer Compatibility',
                            'Daily Profit, Loss & Stock Reports',
                            'Automated Local Data Backup System',
                            'Complete Staff Training & 1 Year Free Support'
                        ],
                        'is_featured' => true,
                    ],
                    [
                        'name' => 'Multi-Branch Enterprise ERP',
                        'price' => 'Custom Quote',
                        'period' => 'milestone-based',
                        'desc' => 'For large institutions, hospitals, manufacturing units, and multi-location retail chains across Bihar.',
                        'features' => [
                            'Multi-Branch Centralized Cloud Database',
                            'Role-Based Employee Permissions & Audit Trail',
                            'Automated WhatsApp Invoices & SMS Reminders',
                            'Custom Analytics, Balance Sheet & Tax Reports',
                            'Dedicated Dedicated Server Setup & SLA Guarantee'
                        ],
                        'is_featured' => false,
                    ],
                ],
                'process_steps' => [
                    [
                        'step' => '01',
                        'title' => 'Operational Workflow Audit',
                        'desc' => 'We visit your facility or consult in detail to understand how your team handles billing, purchasing, stock, and customer accounts.'
                    ],
                    [
                        'step' => '02',
                        'title' => 'Custom Prototype & Review',
                        'desc' => 'We design intuitive data entry screens and report layouts tailored to your operators, ensuring zero learning curve.'
                    ],
                    [
                        'step' => '03',
                        'title' => 'Development & Testing',
                        'desc' => 'We build the software using robust databases, stress-testing rapid keyboard-only billing and hardware integrations.'
                    ],
                    [
                        'step' => '04',
                        'title' => 'Installation & Staff Onboarding',
                        'desc' => 'We install the software on your systems, import existing legacy records, and train your staff until they are 100% confident.'
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Why should I choose custom software instead of ready-made software like Tally or Marg?',
                        'answer' => 'Ready-made software is built for everyone, meaning it is cluttered with hundreds of features you will never use while missing the exact custom reports you need. Custom software built by AmanProjects is 100% tailored to your operations, loads faster, requires zero training, and gives you one-time ownership without expensive yearly renewal fees.'
                    ],
                    [
                        'question' => 'Can the software work if our internet connection goes down?',
                        'answer' => 'Yes! We build hybrid desktop and local web applications that operate entirely offline on your local network, ensuring billing never halts during broadband outages.'
                    ],
                ],
                'content' => '<h2>Custom Business Software Engineered for Enterprises in Saharsa & Bihar</h2>
<p>Every growing business has a unique operational rhythm. How you manage inventory, how your staff processes bills, how you track credit (udhar) with local retailers, and how you calculate profit margins cannot be forced into rigid, one-size-fits-all commercial software. Off-the-shelf software packages often charge expensive per-user monthly rentals, slow down over time, and leave you helpless when you require a custom modification.</p>
<p>At <strong>AmanProjects</strong>, we build tailor-made enterprise software and automation systems that adapt to your business, not the other way around. Based directly in Saharsa, Bihar, we work side-by-side with local business owners to digitize paperwork, eliminate human accounting errors, and unlock true operational efficiency.</p>

<h3>Custom Software Systems We Specialize In</h3>
<ul>
  <li><strong>Retail & Wholesale Billing / Inventory:</strong> Ultra-fast barcode scanning, GST and non-GST billing, stock expiry tracking, low-inventory alerts, and integrated thermal printing for Saharsa shops.</li>
  <li><strong>School & Coaching Management ERP:</strong> Student registration, biometric attendance, automatic fee collection with instant SMS receipts to parents, and exam mark-sheet generation.</li>
  <li><strong>Hospital & Clinic Management (HMS):</strong> Patient registration, OPD / IPD token management, pathology test reporting, doctor duty rosters, and digital prescription archives.</li>
  <li><strong>Real Estate & Construction ERP:</strong> Project progress monitoring, plot booking management, customer installment schedules, material purchase orders, and contractor labour accounting.</li>
</ul>'
            ],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(['id' => $svc['id']], $svc);
        }

        Cache::forget('ap_services');
    }
}
