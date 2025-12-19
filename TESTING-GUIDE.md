# 🧪 Testing Guide - Storage Migration

## Quick Test Commands

### 1. Clear All Caches
```bash
php artisan view:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

### 2. Verify Upload Directories
```bash
# Check directories exist
ls -la public/uploads/

# Should show:
# drwxr-xr-x profiles/
# drwxr-xr-x projects/
# drwxr-xr-x blogs/
# drwxr-xr-x misc/
```

---

## Manual Testing Checklist

### Admin Panel Tests

#### 1. Profile Upload Test
- [ ] Login to admin panel (`/admin`)
- [ ] Go to Profile section
- [ ] Upload new profile image
- [ ] Click Save
- [ ] **Expected:** File saved to `public/uploads/profiles/`
- [ ] **Expected:** Image preview shows in admin
- [ ] **Expected:** Image displays on homepage

#### 2. Project Upload Test
- [ ] Go to Projects section
- [ ] Click "Add New Project"
- [ ] Fill in project details
- [ ] Upload thumbnail image
- [ ] Click Save
- [ ] **Expected:** File saved to `public/uploads/projects/`
- [ ] **Expected:** Thumbnail shows in projects list
- [ ] **Expected:** Thumbnail displays on homepage

#### 3. Blog Post Upload Test
- [ ] Go to Blog Posts section
- [ ] Click "Add New Post"
- [ ] Fill in post details
- [ ] Upload featured image
- [ ] Click Save
- [ ] **Expected:** File saved to `public/uploads/blogs/`
- [ ] **Expected:** Image shows in posts list
- [ ] **Expected:** Image displays on blog pages

#### 4. Settings Upload Test
- [ ] Go to Settings section
- [ ] Upload new favicon
- [ ] Upload new logo
- [ ] Click Save
- [ ] **Expected:** Files saved to `public/uploads/misc/`
- [ ] **Expected:** Favicon shows in browser tab
- [ ] **Expected:** Logo shows in navigation

---

### Frontend Tests

#### 1. Homepage Display
- [ ] Visit homepage (`/`)
- [ ] **Check:** Profile image displays
- [ ] **Check:** Project thumbnails display
- [ ] **Check:** Blog post images display (if blog section enabled)
- [ ] **Check:** Logo displays in navigation
- [ ] **Check:** No broken image icons
- [ ] **Check:** No 404 errors in browser console (F12)

#### 2. Blog Pages
- [ ] Visit blog index (`/blog`)
- [ ] **Check:** Featured images display for all posts
- [ ] **Check:** No broken images
- [ ] Click on a blog post
- [ ] **Check:** Featured image displays on post page
- [ ] **Check:** OG meta image tag present in HTML

#### 3. Navigation & Footer
- [ ] **Check:** Logo displays in navigation
- [ ] **Check:** Favicon shows in browser tab
- [ ] **Check:** All links work correctly

---

### Backward Compatibility Tests

#### 1. Old Files Test (If you have existing uploads)
- [ ] Check if old profile images still display
- [ ] Check if old project thumbnails still display
- [ ] Check if old blog images still display
- [ ] **Expected:** All old files accessible via `/storage/` path
- [ ] **Expected:** No 404 errors for old files

#### 2. Mixed Files Test
- [ ] Have both old and new uploads
- [ ] **Expected:** Old files load from `/storage/`
- [ ] **Expected:** New files load from `/uploads/`
- [ ] **Expected:** Both display correctly

---

### Security Tests

#### 1. Dangerous File Upload Test
- [ ] Try uploading `.php` file as profile image
- [ ] **Expected:** Upload rejected with error message
- [ ] Try uploading `.exe` file
- [ ] **Expected:** Upload rejected with error message
- [ ] Try uploading `.js` file
- [ ] **Expected:** Upload rejected with error message

#### 2. Valid File Upload Test
- [ ] Upload `.jpg` image
- [ ] **Expected:** Upload succeeds
- [ ] Upload `.png` image
- [ ] **Expected:** Upload succeeds
- [ ] Upload `.pdf` as resume
- [ ] **Expected:** Upload succeeds

#### 3. Filename Security Test
- [ ] Upload any valid image
- [ ] Check filename in `public/uploads/`
- [ ] **Expected:** Filename format: `{timestamp}_{random}.{ext}`
- [ ] **Expected:** Original filename not preserved
- [ ] Upload same file again
- [ ] **Expected:** Different filename generated (no collision)

---

### File System Tests

#### 1. Directory Permissions
```bash
# Check upload directory permissions
stat public/uploads/

# Expected: 755 (drwxr-xr-x)
```

#### 2. File Permissions
```bash
# Upload a file, then check its permissions
stat public/uploads/profiles/somefile.jpg

# Expected: 644 (-rw-r--r--)
```

#### 3. Old File Deletion Test
- [ ] Upload profile image
- [ ] Note the filename
- [ ] Upload different profile image
- [ ] Check `public/uploads/profiles/`
- [ ] **Expected:** Old file deleted
- [ ] **Expected:** Only new file exists

---

### Browser Console Tests

#### 1. Check for Errors
- [ ] Open browser console (F12)
- [ ] Visit homepage
- [ ] **Expected:** No 404 errors
- [ ] **Expected:** No 403 errors
- [ ] **Expected:** All images load successfully

#### 2. Network Tab Check
- [ ] Open Network tab in browser console
- [ ] Reload homepage
- [ ] Filter by "Img"
- [ ] **Expected:** All image requests return 200 status
- [ ] **Expected:** No failed requests

---

### Database Tests

#### 1. Path Storage Test
- [ ] Upload new profile image
- [ ] Check database:
```sql
SELECT profile_image FROM profiles WHERE user_id = 1;
```
- [ ] **Expected:** Path starts with `uploads/profiles/`

#### 2. Old Path Compatibility Test
- [ ] If you have old data with `storage/` paths
- [ ] **Expected:** Old paths still work
- [ ] **Expected:** Images still display

---

## Automated Testing (Optional)

### Create Test Script
```php
// tests/Feature/FileUploadTest.php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadTest extends TestCase
{
    public function test_profile_image_uploads_to_correct_directory()
    {
        $this->actingAs($user = User::factory()->create());
        
        $file = UploadedFile::fake()->image('profile.jpg');
        
        $response = $this->post('/admin/profile', [
            'name' => 'Test User',
            'title' => 'Developer',
            'bio' => 'Test bio',
            'profile_image' => $file,
        ]);
        
        $this->assertTrue(
            count(glob(public_path('uploads/profiles/*.jpg'))) > 0
        );
    }
    
    public function test_dangerous_file_upload_is_rejected()
    {
        $this->actingAs($user = User::factory()->create());
        
        $file = UploadedFile::fake()->create('malicious.php', 100);
        
        $response = $this->post('/admin/profile', [
            'name' => 'Test User',
            'title' => 'Developer',
            'bio' => 'Test bio',
            'profile_image' => $file,
        ]);
        
        $response->assertSessionHasErrors('profile_image');
    }
}
```

### Run Tests
```bash
php artisan test --filter FileUploadTest
```

---

## Performance Tests

### 1. Image Load Time
- [ ] Open browser DevTools
- [ ] Go to Network tab
- [ ] Reload homepage
- [ ] Check image load times
- [ ] **Expected:** Images load in < 1 second
- [ ] **Expected:** No significant delay

### 2. Upload Speed
- [ ] Upload 5MB image
- [ ] **Expected:** Upload completes in reasonable time
- [ ] **Expected:** No timeout errors

---

## Troubleshooting Common Issues

### Issue: Images Not Displaying

**Symptoms:**
- Broken image icons
- 404 errors in console

**Solutions:**
```bash
# 1. Clear view cache
php artisan view:clear

# 2. Check directory exists
ls -la public/uploads/

# 3. Check permissions
chmod 755 public/uploads
chmod 755 public/uploads/*

# 4. Check file exists
ls -la public/uploads/profiles/
```

---

### Issue: Upload Fails

**Symptoms:**
- "Failed to move uploaded file"
- Permission denied errors

**Solutions:**
```bash
# 1. Check directory permissions
chmod 755 public/uploads
chmod 755 public/uploads/*

# 2. Check PHP upload settings
php -i | grep upload

# 3. Check disk space
df -h

# 4. Check error logs
tail -f storage/logs/laravel.log
```

---

### Issue: Old Images Not Showing

**Symptoms:**
- Old uploads return 404
- Only new uploads work

**Solutions:**
```bash
# 1. Check storage symlink exists
ls -la public/storage

# 2. Create symlink if missing
php artisan storage:link

# 3. Verify old files exist
ls -la storage/app/public/
```

---

## Success Criteria

### All Tests Pass ✅
- [ ] Profile image uploads work
- [ ] Project thumbnails upload work
- [ ] Blog images upload work
- [ ] Settings uploads work
- [ ] Old files still display
- [ ] New files display correctly
- [ ] No 404/403 errors
- [ ] Security validations work
- [ ] Dangerous files blocked
- [ ] Unique filenames generated
- [ ] Old files deleted on update
- [ ] Browser console clean
- [ ] All images load < 1s

### Ready for Production ✅
- [ ] All manual tests passed
- [ ] No errors in logs
- [ ] Performance acceptable
- [ ] Security validations active
- [ ] Backward compatibility confirmed

---

## Test Report Template

```
# Storage Migration Test Report

**Date:** [Date]
**Tester:** [Name]
**Environment:** [Local/Staging/Production]

## Test Results

### Admin Panel Tests
- Profile Upload: ✅ / ❌
- Project Upload: ✅ / ❌
- Blog Upload: ✅ / ❌
- Settings Upload: ✅ / ❌

### Frontend Tests
- Homepage Display: ✅ / ❌
- Blog Pages: ✅ / ❌
- Navigation: ✅ / ❌

### Security Tests
- Dangerous Files Blocked: ✅ / ❌
- Valid Files Accepted: ✅ / ❌
- Unique Filenames: ✅ / ❌

### Backward Compatibility
- Old Files Display: ✅ / ❌
- Mixed Files Work: ✅ / ❌

## Issues Found
[List any issues]

## Notes
[Additional observations]

## Conclusion
✅ Ready for Production
❌ Needs Fixes
```

---

**Testing Status:** Ready to Test ✅
**Estimated Time:** 30-45 minutes
**Priority:** High
