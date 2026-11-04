<?php

namespace App\Helpers;

class FileUrlHelper
{
    /**
     * Resolve correct full asset URL for any image path across XAMPP, CLI, or Production.
     *
     * @param string|null $path
     * @return string
     */
    public static function get(?string $path): string
    {
        if (!$path) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $cleanPath = ltrim($path, '/');

        if (!str_starts_with($cleanPath, 'uploads/') &&
            !str_starts_with($cleanPath, 'images/') &&
            !str_starts_with($cleanPath, 'assets/') &&
            !str_starts_with($cleanPath, 'storage/')) {
            $cleanPath = 'storage/' . $cleanPath;
        }

        if (app()->runningInConsole() && !app()->runningUnitTests()) {
            return asset($cleanPath);
        }

        $request = request();
        $base = rtrim($request->getBaseUrl(), '/');
        return $request->getSchemeAndHttpHost() . $base . '/' . $cleanPath;
    }
}

if (!function_exists('fileUrl')) {
    function fileUrl(?string $path): string
    {
        return \App\Helpers\FileUrlHelper::get($path);
    }
}
