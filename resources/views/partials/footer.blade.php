<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="footer-content glass-card">
            <p>&copy; {{ date('Y') }} {{ $user?->name ?? $settings['site_title'] ?? 'Portfolio' }}. All rights reserved.</p>
            <p>Designed by <a href="{{ $user?->profile?->website ?? '#' }}" target="_blank" rel="noopener noreferrer" style="color: #fff;">{{ $user?->name ?? 'Portfolio Owner' }}</a></p>
        </div>
    </div>
</footer>
