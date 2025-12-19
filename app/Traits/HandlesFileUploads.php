<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HandlesFileUploads
{
    /**
     * Upload file to public/uploads directory
     *
     * @param UploadedFile $file
     * @param string $directory (profiles, projects, blogs, misc)
     * @param string|null $oldPath Path to old file to delete
     * @return string Relative path to uploaded file
     */
    protected function uploadFile(UploadedFile $file, string $directory, ?string $oldPath = null): string
    {
        // Validate file
        $this->validateUploadedFile($file);

        // Generate unique filename
        $filename = $this->generateUniqueFilename($file);

        // Ensure directory exists
        $uploadPath = public_path("uploads/{$directory}");
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Move file to public/uploads
        $file->move($uploadPath, $filename);

        // Delete old file if exists (only from uploads directory)
        if ($oldPath && str_starts_with($oldPath, 'uploads/')) {
            $this->deleteFile($oldPath);
        }

        // Return relative path
        return "uploads/{$directory}/{$filename}";
    }

    /**
     * Delete file from public directory
     *
     * @param string $path Relative path from public root
     * @return bool
     */
    protected function deleteFile(string $path): bool
    {
        $fullPath = public_path($path);

        if (file_exists($fullPath) && is_file($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }

    /**
     * Validate uploaded file
     *
     * @param UploadedFile $file
     * @return void
     * @throws \Exception
     */
    protected function validateUploadedFile(UploadedFile $file): void
    {
        // Block dangerous extensions
        $dangerousExtensions = ['php', 'phtml', 'php3', 'php4', 'php5', 'phar', 'exe', 'sh', 'bat', 'cmd', 'com', 'js', 'jar'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (in_array($extension, $dangerousExtensions)) {
            throw new \Exception('File type not allowed for security reasons.');
        }

        // Validate mime type
        $allowedMimes = [
            'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
            'application/pdf',
            'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        if (!in_array($file->getMimeType(), $allowedMimes)) {
            throw new \Exception('File type not supported.');
        }
    }

    /**
     * Generate unique filename
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function generateUniqueFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $timestamp = time();
        $random = Str::random(10);

        return "{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Get asset URL for file path
     * Supports both old (storage/) and new (uploads/) paths
     *
     * @param string|null $path
     * @return string|null
     */
    protected function getFileUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        // New uploads path
        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }

        // Old storage path (backward compatibility)
        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        // Assume it's a storage path without prefix
        return asset('storage/' . $path);
    }
}

