# Personal Portfolio & Blog CMS

A comprehensive Personal Portfolio and Blog Management System built with **Laravel 12**. This application provides a dynamic platform to showcase professional skills, projects, experiences, and education, alongside a fully functional blog and contact system. It includes a robust Admin Dashboard for managing all content.

## 🚀 Features

### Public Interface
- **Home Page**: Dynamic landing page displaying portfolio highlights.
- **Blog**: A clean blog section with individual post views (`/blog`, `/blog/{slug}`).
- **Contact Form**: Functional contact form for visitors to get in touch.
- **Authentication**: Secure login system for administrators.

### Admin Dashboard
Access a powerful backend to manage your portfolio content:
- **Dashboard**: Overview of site statistics.
- **Profile Management**: Update personal details and bio.
- **Skills**: Manage technical skills with proficiency levels.
- **Projects**: Showcase portfolio projects with descriptions and links.
- **Experience**: Manage professional work history.
- **Education**: Manage educational background.
- **Blog Posts**: Create, edit, and delete blog posts.
- **Categories**: Organize blog posts into categories.
- **Social Links**: Manage social media profiles and links.
- **Contacts**: View and manage incoming contact form messages.
- **Settings**: Global site configuration (Restricted to Super Admin/Admin roles).

## 🛠 Tech Stack

- **Framework**: [Laravel 12.x](https://laravel.com)
- **Language**: PHP ^8.2
- **Frontend**: Blade Templates, JavaScript, CSS
- **Database**: MySQL / SQLite (Configurable)
- **Testing**: [Pest PHP](https://pestphp.com)

## ⚙️ Installation

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/amanprojects-ops/amanbhai_portfolio.git
   cd amanbhai_portfolio
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**
   Copy the example environment file and configure your database settings:
   ```bash
   cp .env.example .env
   ```
   Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in the `.env` file.

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**
   Set up the database tables:
   ```bash
   php artisan migrate
   ```
   *(Optional) Seed the database if seeders are available:*
   ```bash
   php artisan db:seed
   ```

6. **Build Frontend Assets**
   ```bash
   npm run build
   ```
   *For development with hot-reloading:*
   ```bash
   npm run dev
   ```

7. **Start the Development Server**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## 📂 Project Structure

- **Routes**
  - `routes/web.php`: Public routes (Home, Blog, Auth).
  - `routes/admin.php`: Admin dashboard routes (Protected by auth middleware).
  
- **Database**
  - `database/migrations`: Schema definitions for all content types (Skills, Projects, Posts, etc.).

- **Views**
  - `resources/views/admin`: Admin panel templates.
  - `resources/views/blog`: Public blog templates.
  - `resources/views/layouts`: Master layout files.

## 🧪 Running Tests

This project uses **Pest** for testing. Run the test suite with:

```bash
php artisan test
```

## 🔒 Security

- **Role-Based Access Control (RBAC)**: Certain actions (like Settings management) are restricted to specific roles (e.g., `super-admin`, `admin`).
- **CSRF Protection**: All forms are protected against Cross-Site Request Forgery.
- **Authentication**: Built-in Laravel authentication system.

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
Created by Technical Aman — [www.amanprojects.com](https://amanprojects.com)
