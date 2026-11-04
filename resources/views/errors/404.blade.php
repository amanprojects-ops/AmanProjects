<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Page Not Found</title>

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
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; position: relative;
        }

        /* Grid background */
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
            filter: blur(100px);
        }
        .orb-1 { width: 500px; height: 500px; background: rgba(6,182,212,0.06); top: -150px; left: -100px; animation: drift1 8s ease-in-out infinite alternate; }
        .orb-2 { width: 400px; height: 400px; background: rgba(14,165,233,0.05); bottom: -100px; right: -80px; animation: drift1 10s ease-in-out infinite alternate-reverse; }
        .orb-3 { width: 300px; height: 300px; background: rgba(99,102,241,0.04); top: 50%; left: 50%; transform: translate(-50%,-50%); animation: drift2 12s ease-in-out infinite; }

        @keyframes drift1 {
            from { transform: translate(0, 0); }
            to { transform: translate(30px, 20px); }
        }
        @keyframes drift2 {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.8; }
        }

        /* Main content */
        .error-wrapper {
            position: relative; z-index: 10;
            text-align: center; padding: 20px;
            max-width: 600px;
        }

        /* Glowing number */
        .error-code {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(100px, 20vw, 160px);
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, rgba(6,182,212,0.15), rgba(14,165,233,0.08));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            margin-bottom: 8px;
            letter-spacing: -4px;
            filter: drop-shadow(0 0 30px rgba(6,182,212,0.25));
        }
        .error-code::after {
            content: '404';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, #06b6d4, #0ea5e9, #38bdf8);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: 0.15;
            filter: blur(20px);
        }

        /* Icon */
        .error-icon-wrap {
            width: 80px; height: 80px;
            background: rgba(6,182,212,0.08);
            border: 1px solid rgba(6,182,212,0.2);
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            margin: 0 auto 28px;
            font-size: 32px; color: #06b6d4;
        }

        .error-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(24px, 4vw, 34px);
            font-weight: 700; color: #f1f5f9;
            margin-bottom: 14px;
        }
        .error-desc {
            font-size: 16px; color: #64748b;
            line-height: 1.7; margin-bottom: 40px;
            max-width: 420px; margin-left: auto; margin-right: auto;
        }

        .error-actions {
            display: flex; align-items: center; justify-content: center;
            flex-wrap: wrap; gap: 14px;
        }
        .btn-home {
            display: inline-flex; align-items: center; gap: 9px;
            padding: 13px 30px;
            background: linear-gradient(135deg, #06b6d4, #0ea5e9);
            border-radius: 12px; color: #fff;
            font-size: 15px; font-weight: 600;
            font-family: 'Space Grotesk', sans-serif;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(6,182,212,0.35);
            transition: all 0.25s;
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(6,182,212,0.5);
        }
        .btn-back {
            display: inline-flex; align-items: center; gap: 9px;
            padding: 13px 28px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; color: #94a3b8;
            font-size: 15px; font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(6,182,212,0.25);
            color: #06b6d4;
        }

        /* Floating dots decoration */
        .dots {
            position: absolute; pointer-events: none;
            width: 100%; height: 100%;
            inset: 0; z-index: 1;
            overflow: hidden;
        }
        .dot {
            position: absolute; border-radius: 50%;
            background: rgba(6,182,212,0.5);
            animation: floatDot linear infinite;
        }

        @keyframes floatDot {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
        }
    </style>
</head>
<body>

    <div class="bg-grid">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Floating dots -->
    <div class="dots" id="dots"></div>

    <div class="error-wrapper">
        <div class="error-code">404</div>
        <div class="error-icon-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-desc">
            Oops! The page you're looking for doesn't exist, has been moved, or the URL might be incorrect.
        </p>
        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn-home">
                <i class="fa-solid fa-house"></i> Go Home
            </a>
            <a href="javascript:history.back()" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Go Back
            </a>
        </div>
    </div>

    <script>
        // Floating particle dots
        const container = document.getElementById('dots');
        for (let i = 0; i < 12; i++) {
            const dot = document.createElement('div');
            dot.className = 'dot';
            const size = Math.random() * 4 + 2;
            dot.style.cssText = `
                width: ${size}px; height: ${size}px;
                left: ${Math.random() * 100}%;
                animation-duration: ${Math.random() * 12 + 8}s;
                animation-delay: ${Math.random() * 8}s;
                opacity: ${Math.random() * 0.5 + 0.2};
            `;
            container.appendChild(dot);
        }
    </script>
</body>
</html>
