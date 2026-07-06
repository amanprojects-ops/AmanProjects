<div align="center">
  <img src="https://via.placeholder.com/150x150.png?text=AmanProjects" alt="AmanProjects Logo" width="150" height="150" />
  <h1>AmanProjects CMS & Portfolio Platform</h1>
  <p><em>Built for Performance, Security, and SEO by <a href="https://amanprojects.com">Technical Aman</a></em></p>
  
  <p>
    <img alt="Laravel" src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
    <img alt="PHP" src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
    <img alt="TailwindCSS" src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
    <img alt="MySQL" src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white" />
  </p>
</div>

---

## 🚀 Overview

The **AmanProjects CMS** is a premium, comprehensive Personal Portfolio, SaaS Landing Page, and Blog Management System built on **Laravel 12**. 

Designed specifically to be lightning-fast and highly optimized for search engines (SEO, AEO, SXO, GEO), this application serves as the ultimate digital presence platform for developers, agencies, and businesses.

> **Watermark & Authorship:** This project is designed, architected, and maintained by **AmanProjects** / **Technical Aman**.

---

## ✨ Key Features

### ⚡ Performance First (Granular Caching Architecture)
- **Modular Cache System:** Unlike monolithic systems, AmanProjects uses a highly efficient, granular caching architecture. When you update a `Project`, only the project cache is flushed. Blog posts and other settings remain instantly served from the high-speed cache.
- **Zero-FOIT Fonts:** Fonts are preloaded and deferred correctly to prevent Flash of Invisible Text.
- **Lazy Loaded Assets:** CSS and JS (Tailwind, AOS, Alpine, Swiper) are loaded via CDN and deferred where appropriate.

### 🔍 Advanced SEO & AEO & GEO
- **Dynamic JSON-LD Injection:** Automatic `LocalBusiness`, `Organization`, and `WebPage` structured data injection based on your Admin Panel settings.
- **Comprehensive XML Sitemaps:** 
  - Sub-sitemaps for `/sitemap-projects.xml`, `/sitemap-blogs.xml`, `/sitemap-categories.xml`.
  - Image sitemaps included.
  - Dedicated `/sitemap-local.xml` optimized for regional and local SEO targeting.
- **Meta Tags & OpenGraph:** Fully dynamic meta titles, descriptions, X (Twitter) cards, and OpenGraph tags customized per page.

### 🛡️ Powerful Admin Panel (Control Center)
- **Complete Content Management:** Manage Projects, Blogs, Categories, Services, Pricing Plans, Testimonials, Team Members, and Process Steps.
- **Dynamic Frontend Controls:** Toggle entire homepage sections (like "Pricing", "Testimonials", "Blog") on or off directly from the admin dashboard.
- **One-Click Cache Flush:** Built-in manual cache override to forcefully reset application caching directly from the settings panel.

---

## 🛠 Tech Stack

- **Backend Framework**: [Laravel 12.x](https://laravel.com)
- **Language**: PHP ^8.2
- **Frontend Stack**: Blade Templates, Tailwind CSS (CDN), Alpine.js, Swiper JS, AOS (Animate On Scroll)
- **Database**: MySQL / SQLite (Configurable)
- **Testing**: [Pest PHP](https://pestphp.com)

---

## ⚙️ Installation & Setup

Follow these steps to set up the AmanProjects CMS locally or on your server.

### 1. Clone the repository
```bash
git clone https://github.com/amanprojects-ops/AmanProjects.git
cd AmanProjects
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
Copy the example environment file and configure your database and email settings:
```bash
cp .env.example .env
```
Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in the `.env` file.

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations & Seeders
Set up the database tables and insert initial admin credentials/settings:
```bash
php artisan migrate --seed
```

### 6. Start the Server
```bash
php artisan serve
```
Visit `http://localhost:8000` in your browser. Access the admin panel at `/admin`.

---

## 📂 Project Structure Highlights

- **`app/Http/Controllers/HomeController.php`**: Core frontend rendering engine utilizing granular caching for maximum TTFB performance.
- **`app/Providers/AppServiceProvider.php`**: Centralized model observers handling smart cache invalidation and global View Composers.
- **`resources/views/layouts/app.blade.php`**: The master frontend layout featuring comprehensive SEO tags, JSON-LD schemas, and Tailwind config.
- **`resources/views/layouts/admin.blade.php`**: The Control Center layout with dynamic sidebar branding.

---

## 🔒 Security Practices

- **Role-Based Access Control (RBAC)**: Certain actions (like critical site settings management) are restricted to `super-admin` roles.
- **CSRF & XSS Protection**: All forms are protected against CSRF, and Blade's `{{ }}` syntax escapes output to prevent XSS.
- **Honeypot Traps**: Contact forms are equipped with honeypot fields to trap and reject spam bots without CAPTCHA friction.

---

## 📄 License & Authorship

© {{ date('Y') }} **AmanProjects**. All rights reserved.

The core architecture, specific SEO implementations, and caching engines in this repository are proprietary to **AmanProjects / Technical Aman**. The underlying Laravel framework is open-sourced software licensed under the MIT license.

*Designed and Developed with ❤️ in Bihar, India.*  
🌐 [www.amanprojects.com](https://amanprojects.com)
