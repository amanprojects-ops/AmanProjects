<?php

namespace App\Helpers;

class HtmlPurifier
{
    /**
     * Purify HTML content to prevent XSS attacks
     * Allows safe HTML tags for blog content
     */
    public static function clean(string $html): string
    {
        // Allow safe HTML tags for blog content
        $allowedTags = '<p><br><strong><em><u><h1><h2><h3><h4><h5><h6><ul><ol><li><a><img><blockquote><code><pre>';

        // Strip dangerous tags
        $cleaned = strip_tags($html, $allowedTags);

        // Remove javascript: and data: protocols from links and images
        $cleaned = preg_replace('/(<a[^>]+href=[\"\']?)javascript:/i', '$1', $cleaned);
        $cleaned = preg_replace('/(<a[^>]+href=[\"\']?)data:/i', '$1', $cleaned);
        $cleaned = preg_replace('/(<img[^>]+src=[\"\']?)javascript:/i', '$1', $cleaned);
        $cleaned = preg_replace('/(<img[^>]+src=[\"\']?)data:/i', '$1', $cleaned);

        // Remove on* event handlers
        $cleaned = preg_replace('/ on\w+="[^"]*"/i', '', $cleaned);
        $cleaned = preg_replace("/ on\w+='[^']*'/i", '', $cleaned);

        return $cleaned;
    }
}
