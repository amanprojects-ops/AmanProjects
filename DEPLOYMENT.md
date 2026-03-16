# Portfolio Website - Deployment Guide

## System Requirements
- PHP 8.1+
- MySQL 5.7+ / MariaDB 10.3+
- Composer
- Node.js & NPM (for asset compilation)

## Installation Steps

### 1. Clone & Setup
```bash
git clone <repository-url>
cd amanbhai
composer install --optimize-autoloader --no-dev
```

### 2. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file:
```env
APP_NAME="Your Portfolio"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

### 3. Database Setup
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 4. Storage Link
```bash
php artisan storage:link
```

### 5. Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Set Permissions (Linux/cPanel)
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Default Admin Credentials
- **Email:** admin@example.com
- **Password:** password

**⚠️ IMPORTANT:** Change these credentials immediately after first login!

## Post-Deployment Checklist
- [ ] Change admin password
- [ ] Update site settings (Admin → Settings)
- [ ] Upload profile image and resume
- [ ] Add social links
- [ ] Configure email settings
- [ ] Test contact form
- [ ] Enable/disable sections as needed
- [ ] Set maintenance mode if needed

## Shared Hosting (cPanel) Notes

### File Structure
```
public_html/
├── (Laravel public folder contents)
├── index.php
├── .htaccess
└── storage -> ../storage/app/public

application/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
└── vendor/
```

### .htaccess Configuration
The `.htaccess` file in `public/` should contain:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

## Security Checklist
✅ APP_DEBUG=false in production
✅ Strong database password
✅ HTTPS enabled
✅ File upload validation active
✅ CSRF protection enabled
✅ XSS protection via HTML purifier
✅ SQL injection prevention via Eloquent
✅ Role-based access control active

## Maintenance Mode
```bash
# Enable maintenance mode
php artisan down

# Disable maintenance mode
php artisan up
```

Or use Admin Panel → Settings → Maintenance Mode toggle

## Backup Recommendations
- Database: Daily automated backups
- Files: Weekly backups of `storage/app/public`
- Code: Version control (Git)

## Troubleshooting

### 500 Error
```bash
php artisan optimize:clear
chmod -R 755 storage bootstrap/cache
```

### Missing Images
```bash
php artisan storage:link
```

### Database Connection Error
- Verify `.env` database credentials
- Check database server is running
- Ensure database exists

### Permission Denied
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Support
For issues, check Laravel logs: `storage/logs/laravel.log`
