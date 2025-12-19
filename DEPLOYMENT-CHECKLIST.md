# 🚀 Deployment Checklist - Storage Migration

## Pre-Deployment

### 1. Verify Local Setup
```bash
# Check upload directories exist
ls -la public/uploads/

# Should show:
# - profiles/
# - projects/
# - blogs/
# - misc/
```

### 2. Clear Caches
```bash
php artisan view:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

### 3. Test Locally
- [ ] Upload new profile image → Check it saves to `public/uploads/profiles/`
- [ ] Upload new project thumbnail → Check it saves to `public/uploads/projects/`
- [ ] Upload new blog image → Check it saves to `public/uploads/blogs/`
- [ ] Upload favicon/logo → Check it saves to `public/uploads/misc/`
- [ ] Verify old images still display correctly
- [ ] Check admin panel image previews work
- [ ] Check frontend displays all images

---

## Deployment Steps

### For New Deployments (Fresh Install)

1. **Upload Files**
   ```bash
   # Upload all project files via FTP/Git
   ```

2. **Create Upload Directories**
   ```bash
   mkdir -p public/uploads/{profiles,projects,blogs,misc}
   chmod 755 public/uploads
   chmod 755 public/uploads/*
   ```

3. **Install Dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan key:generate
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

5. **Clear Caches**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. **Test**
   - Visit homepage
   - Login to admin panel
   - Upload test image
   - Verify it appears in `public/uploads/`

---

### For Existing Deployments (Update)

1. **Backup Database & Files**
   ```bash
   # Backup database
   mysqldump -u username -p database_name > backup.sql
   
   # Backup old uploads (if any)
   tar -czf storage-backup.tar.gz storage/app/public/
   ```

2. **Upload New Code**
   ```bash
   # Via Git
   git pull origin main
   
   # Or via FTP - upload all files except:
   # - .env
   # - storage/
   # - vendor/
   # - node_modules/
   ```

3. **Create Upload Directories**
   ```bash
   mkdir -p public/uploads/{profiles,projects,blogs,misc}
   chmod 755 public/uploads
   chmod 755 public/uploads/*
   ```

4. **Update Dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

5. **Clear All Caches**
   ```bash
   php artisan view:clear
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   
   # Then cache for production
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. **Test Old Files**
   - [ ] Visit homepage - old images should still display
   - [ ] Check admin panel - old thumbnails should show
   - [ ] Verify no 404 errors in browser console

7. **Test New Uploads**
   - [ ] Upload new profile image
   - [ ] Upload new project
   - [ ] Upload new blog post
   - [ ] Verify files appear in `public/uploads/`
   - [ ] Verify images display on frontend

---

## Shared Hosting (cPanel/Hostinger)

### 1. File Manager Method

1. **Upload via File Manager**
   - Zip your project locally
   - Upload zip to server
   - Extract in public_html or domain folder

2. **Create Directories**
   - Navigate to `public/uploads/`
   - Create folders: `profiles`, `projects`, `blogs`, `misc`
   - Set permissions to 755

3. **Configure .env**
   - Copy `.env.example` to `.env`
   - Update database credentials
   - Set `APP_URL` to your domain

4. **Run Setup**
   - Use Terminal in cPanel or SSH
   ```bash
   cd public_html
   composer install --optimize-autoloader --no-dev
   php artisan key:generate
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### 2. Git Deployment Method

1. **Clone Repository**
   ```bash
   cd public_html
   git clone https://github.com/yourusername/yourproject.git .
   ```

2. **Setup**
   ```bash
   composer install --optimize-autoloader --no-dev
   cp .env.example .env
   php artisan key:generate
   ```

3. **Create Upload Directories**
   ```bash
   mkdir -p public/uploads/{profiles,projects,blogs,misc}
   chmod 755 public/uploads
   ```

4. **Configure & Migrate**
   - Edit `.env` with database credentials
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## Troubleshooting

### Images Not Displaying

**Problem:** New uploads not showing

**Solution:**
```bash
# Check directory exists
ls -la public/uploads/

# Check permissions
chmod 755 public/uploads
chmod 755 public/uploads/*

# Clear view cache
php artisan view:clear
```

---

### Old Images Not Showing

**Problem:** Existing images return 404

**Solution:**
```bash
# Verify storage symlink exists
ls -la public/storage

# If missing, create it
php artisan storage:link

# Or manually
ln -s ../storage/app/public public/storage
```

---

### Upload Fails with Permission Error

**Problem:** "Failed to move uploaded file"

**Solution:**
```bash
# Set correct permissions
chmod 755 public/uploads
chmod 755 public/uploads/*

# On shared hosting, may need 777 (less secure)
chmod 777 public/uploads
chmod 777 public/uploads/*
```

---

### 500 Error After Deployment

**Problem:** White screen or 500 error

**Solution:**
```bash
# Clear all caches
php artisan view:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Check logs
tail -f storage/logs/laravel.log

# Verify .env is configured
cat .env

# Regenerate key if needed
php artisan key:generate
```

---

## Post-Deployment Verification

### Frontend Checks
- [ ] Homepage loads without errors
- [ ] Profile image displays
- [ ] Project thumbnails display
- [ ] Blog featured images display
- [ ] Logo displays in navigation
- [ ] Favicon shows in browser tab
- [ ] No 404 errors in console

### Admin Panel Checks
- [ ] Can login successfully
- [ ] Dashboard loads
- [ ] Can upload new profile image
- [ ] Can upload new project thumbnail
- [ ] Can upload new blog featured image
- [ ] Can upload favicon/logo in settings
- [ ] Image previews show correctly
- [ ] Old images still display

### File System Checks
```bash
# Verify new uploads go to correct location
ls -la public/uploads/profiles/
ls -la public/uploads/projects/
ls -la public/uploads/blogs/
ls -la public/uploads/misc/

# Check file permissions
stat public/uploads/profiles/somefile.jpg
# Should show: 644 or 755
```

---

## Rollback Plan

If something goes wrong:

1. **Restore Database**
   ```bash
   mysql -u username -p database_name < backup.sql
   ```

2. **Restore Old Code**
   ```bash
   git checkout previous-commit-hash
   # Or restore from backup
   ```

3. **Clear Caches**
   ```bash
   php artisan view:clear
   php artisan config:clear
   php artisan cache:clear
   ```

---

## Security Notes

### File Upload Security
✅ Dangerous extensions blocked (php, exe, js, etc.)
✅ Mime type validation enabled
✅ Unique filenames prevent collisions
✅ Files stored outside application root (in public)

### Permissions
- **Directories:** 755 (rwxr-xr-x)
- **Files:** 644 (rw-r--r--)
- **Never use 777** unless absolutely necessary on shared hosting

### .gitignore
✅ Upload directory ignored in git
✅ Only .gitkeep tracked
✅ User uploads never committed

---

## Monitoring

### What to Monitor
- Disk space in `public/uploads/`
- File upload errors in logs
- 404 errors for images
- Permission issues

### Log Locations
```bash
# Laravel logs
storage/logs/laravel.log

# Web server logs (Apache)
/var/log/apache2/error.log

# Web server logs (Nginx)
/var/log/nginx/error.log
```

---

## Success Criteria

✅ All new uploads save to `public/uploads/`
✅ Old files in `storage/` still accessible
✅ No 404 or 403 errors
✅ Admin panel uploads work
✅ Frontend displays all images
✅ No permission issues
✅ Security validations active
✅ Backward compatibility maintained

---

**Status:** Ready for Production ✅
**Backward Compatible:** Yes ✅
**Shared Hosting:** Compatible ✅
**Security:** Enhanced ✅
