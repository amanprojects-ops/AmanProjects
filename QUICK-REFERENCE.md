# 🚀 Quick Reference - Storage Migration

## 📋 What Changed?

**Old System:**
- Files saved to `storage/app/public/`
- Required symlink: `php artisan storage:link`
- URLs: `asset('storage/' . $path)`

**New System:**
- Files saved to `public/uploads/`
- No symlink needed
- URLs: `@fileUrl($path)` (auto-detects old/new)

---

## 🎯 Quick Commands

### Clear Caches
```bash
php artisan view:clear && php artisan config:clear && php artisan cache:clear
```

### Check Upload Directories
```bash
ls -la public/uploads/
```

### Set Permissions (if needed)
```bash
chmod 755 public/uploads && chmod 755 public/uploads/*
```

---

## 📁 File Locations

### New Uploads Go To:
```
public/uploads/profiles/    → Profile images, resumes
public/uploads/projects/    → Project thumbnails
public/uploads/blogs/       → Blog featured images
public/uploads/misc/        → Favicon, logo, other files
```

### Old Files Stay At:
```
storage/app/public/         → Old uploads (still work)
```

---

## 🔧 How to Use in Code

### In Controllers
```php
use App\Traits\HandlesFileUploads;

class YourController extends Controller
{
    use HandlesFileUploads;
    
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $this->uploadFile(
                $request->file('image'),
                'directory_name',  // profiles, projects, blogs, misc
                $oldPath           // optional: old file to delete
            );
            
            // Save $path to database
            // Example: uploads/profiles/123_abc.jpg
        }
    }
}
```

### In Blade Views
```blade
<!-- Use @fileUrl directive (works for both old and new paths) -->
<img src="@fileUrl($model->image_path)" alt="Image">

<!-- Examples -->
<img src="@fileUrl($profile->profile_image)">
<img src="@fileUrl($project->thumbnail_image)">
<img src="@fileUrl($post->featured_image)">
```

---

## 🔐 Security Features

### Blocked Extensions
```
php, phtml, php3, php4, php5, phar, exe, sh, bat, cmd, com, js, jar
```

### Allowed File Types
```
Images: jpg, jpeg, png, gif, webp, svg
Documents: pdf, doc, docx
```

### Filename Format
```
{timestamp}_{random}.{extension}
Example: 1734567890_aBcDeFgHiJ.jpg
```

---

## ✅ Testing Checklist

Quick tests to verify everything works:

- [ ] Upload profile image → Check `public/uploads/profiles/`
- [ ] Upload project thumbnail → Check `public/uploads/projects/`
- [ ] Upload blog image → Check `public/uploads/blogs/`
- [ ] Visit homepage → All images display
- [ ] Check browser console → No 404 errors
- [ ] Try uploading `.php` file → Should be rejected

---

## 🚨 Troubleshooting

### Images Not Showing?
```bash
php artisan view:clear
chmod 755 public/uploads
```

### Upload Fails?
```bash
chmod 755 public/uploads/*
tail -f storage/logs/laravel.log
```

### Old Images Not Showing?
```bash
php artisan storage:link
ls -la public/storage
```

---

## 📚 Documentation

- **Technical Details:** `STORAGE-MIGRATION-COMPLETE.md`
- **Deployment Guide:** `DEPLOYMENT-CHECKLIST.md`
- **Testing Guide:** `TESTING-GUIDE.md`
- **Summary:** `MIGRATION-SUMMARY.md`

---

## 🎉 Status

✅ **Complete** - Ready for testing
✅ **Backward Compatible** - Old files still work
✅ **Production Safe** - No breaking changes
✅ **Shared Hosting Ready** - No symlink needed

---

**Need Help?** Check the documentation files above or review Laravel logs.
