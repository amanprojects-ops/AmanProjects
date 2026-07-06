<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Under Maintenance — {{ $settings['site_title'] ?? 'Portfolio' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0f1e;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background */
        .bg-grid {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
        }
        .bg-grid::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(6,182,212,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(6,182,212,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(90px);
        }
        .orb-1 { width: 550px; height: 550px; background: rgba(139,92,246,0.07); top: -200px; left: -150px; animation: drift 10s ease-in-out infinite alternate; }
        .orb-2 { width: 450px; height: 450px; background: rgba(6,182,212,0.06); bottom: -150px; right: -100px; animation: drift 12s ease-in-out infinite alternate-reverse; }
        .orb-3 { width: 350px; height: 350px; background: rgba(236,72,153,0.04); top: 50%; left: 50%; transform: translate(-50%,-50%); animation: pulse 6s ease-in-out infinite; }

        @keyframes drift {
            from { transform: translate(0, 0); }
            to { transform: translate(40px, 30px); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 0.4; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 0.7; transform: translate(-50%, -50%) scale(1.15); }
        }

        /* Gear animation */
        @keyframes spin-slow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes spin-reverse { from { transform: rotate(0deg); } to { transform: rotate(-360deg); } }

        /* Main card */
        .maintenance-wrapper {
            position: relative; z-index: 10;
            width: 100%; max-width: 580px;
            padding: 20px;
            text-align: center;
        }

        .maintenance-card {
            background: rgba(13, 21, 38, 0.7);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(6,182,212,0.12);
            border-radius: 28px;
            padding: 52px 44px;
            box-shadow: 0 30px 70px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.04);
        }

        /* Gears visual */
        .gears-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 120px; height: 120px;
            margin: 0 auto 36px;
        }
        .gear-big {
            font-size: 64px;
            color: rgba(6,182,212,0.5);
            animation: spin-slow 8s linear infinite;
            filter: drop-shadow(0 0 16px rgba(6,182,212,0.25));
        }
        .gear-small {
            position: absolute;
            bottom: 4px; right: 4px;
            font-size: 30px;
            color: rgba(139,92,246,0.6);
            animation: spin-reverse 5s linear infinite;
            filter: drop-shadow(0 0 10px rgba(139,92,246,0.3));
        }

        .maintenance-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 6px 16px;
            background: rgba(245,158,11,0.1);
            border: 1px solid rgba(245,158,11,0.2);
            border-radius: 99px;
            font-size: 11.5px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: #fbbf24;
            margin-bottom: 24px;
        }

        .maintenance-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            font-weight: 800; color: #f1f5f9;
            line-height: 1.2; margin-bottom: 16px;
        }
        .maintenance-title span {
            background: linear-gradient(135deg, #06b6d4, #8b5cf6);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .maintenance-desc {
            font-size: 15.5px; color: #64748b;
            line-height: 1.75; margin-bottom: 36px;
            max-width: 420px; margin-left: auto; margin-right: auto;
        }

        /* Progress bar */
        .progress-wrapper {
            margin-bottom: 36px;
        }
        .progress-label {
            display: flex; justify-content: space-between;
            font-size: 12px; color: #475569;
            margin-bottom: 8px;
        }
        .progress-bar {
            width: 100%; height: 5px;
            background: rgba(255,255,255,0.05);
            border-radius: 99px; overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #8b5cf6, #06b6d4, #8b5cf6);
            background-size: 200% 100%;
            border-radius: 99px;
            animation: shimmer 2.5s linear infinite;
        }
        @keyframes shimmer {
            0% { background-position: 200% 0; width: 65%; }
            50% { background-position: 0% 0; width: 80%; }
            100% { background-position: 200% 0; width: 65%; }
        }

        /* Feature pills */
        .feature-pills {
            display: flex; flex-wrap: wrap; gap: 10px;
            justify-content: center; margin-bottom: 40px;
        }
        .feature-pill {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 7px 15px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 99px;
            font-size: 13px; color: #64748b;
        }
        .feature-pill i { color: #06b6d4; font-size: 11px; }

        /* Countdown / eta */
        .eta-box {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 12px 20px;
            background: rgba(6,182,212,0.06);
            border: 1px solid rgba(6,182,212,0.14);
            border-radius: 14px;
            margin-bottom: 32px;
            font-size: 13.5px; color: #94a3b8;
        }
        .eta-box i { color: #06b6d4; }

        /* Admin link */
        .admin-link {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 13px; color: #1e293b;
            text-decoration: none;
            transition: color 0.2s;
            padding: 8px 16px;
            border-radius: 99px;
            border: 1px solid rgba(255,255,255,0.06);
        }
        .admin-link:hover { color: #06b6d4; border-color: rgba(6,182,212,0.25); }

        @media (max-width: 480px) {
            .maintenance-card { padding: 36px 24px; }
            .feature-pills { gap: 8px; }
        }
    </style>
</head>
<body>

    <div class="bg-grid">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <div class="maintenance-wrapper">
        <div class="maintenance-card">

            {{-- Animated Gears --}}
            <div class="gears-wrapper">
                <i class="fa-solid fa-gear gear-big"></i>
                <i class="fa-solid fa-gear gear-small"></i>
            </div>

            {{-- Badge --}}
            <div class="maintenance-badge">
                <i class="fa-solid fa-triangle-exclamation" style="font-size:10px;"></i>
                Scheduled Maintenance
            </div>

            {{-- Title --}}
            <h1 class="maintenance-title">
                We're <span>upgrading</span><br>the experience
            </h1>

            {{-- Desc --}}
            <p class="maintenance-desc">
                Our team is performing scheduled maintenance and improvements.
                We'll be back online shortly with an even better experience.
            </p>

            {{-- Progress --}}
            <div class="progress-wrapper">
                <div class="progress-label">
                    <span>Progress</span>
                    <span style="color:#06b6d4;font-weight:600;">Almost done…</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>

            {{-- ETA --}}
            <div class="eta-box">
                <i class="fa-regular fa-clock"></i>
                <span>Expected to be back very soon — thanks for your patience!</span>
            </div>

            {{-- What's coming --}}
            <div class="feature-pills">
                <span class="feature-pill"><i class="fa-solid fa-bolt"></i> Faster performance</span>
                <span class="feature-pill"><i class="fa-solid fa-shield-halved"></i> Security updates</span>
                <span class="feature-pill"><i class="fa-solid fa-star"></i> New features</span>
            </div>

            {{-- Admin login --}}
            <a href="{{ route('login') }}" class="admin-link">
                <i class="fa-solid fa-lock" style="font-size:11px;"></i>
                Admin Login
            </a>

        </div>
    </div>

</body>
</html>
