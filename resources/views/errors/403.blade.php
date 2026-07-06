<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Access Denied</title>

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

        .bg-grid {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
        }
        .bg-grid::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(239,68,68,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(239,68,68,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(100px);
        }
        .orb-1 { width: 500px; height: 500px; background: rgba(239,68,68,0.05); top: -150px; left: -100px; animation: drift 8s ease-in-out infinite alternate; }
        .orb-2 { width: 400px; height: 400px; background: rgba(245,158,11,0.04); bottom: -100px; right: -80px; animation: drift 10s ease-in-out infinite alternate-reverse; }
        .orb-3 { width: 300px; height: 300px; background: rgba(239,68,68,0.03); top: 50%; left: 50%; transform: translate(-50%,-50%); animation: glow 6s ease-in-out infinite; }

        @keyframes drift {
            from { transform: translate(0, 0); }
            to { transform: translate(25px, 15px); }
        }
        @keyframes glow {
            0%, 100% { opacity: 0.5; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 0.8; transform: translate(-50%, -50%) scale(1.15); }
        }

        /* Shield animation */
        .shield-wrapper {
            position: relative; display: inline-block; margin-bottom: 28px;
        }
        .shield-bg {
            width: 100px; height: 100px;
            background: rgba(239,68,68,0.08);
            border: 1.5px solid rgba(239,68,68,0.2);
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 38px; color: #f87171;
            animation: pulse-shield 3s ease-in-out infinite;
        }
        @keyframes pulse-shield {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.2); }
            50% { box-shadow: 0 0 0 16px rgba(239,68,68,0); }
        }

        .error-wrapper {
            position: relative; z-index: 10;
            text-align: center; padding: 20px;
            max-width: 580px;
        }

        .error-code {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(100px, 20vw, 160px);
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, rgba(239,68,68,0.2), rgba(245,158,11,0.1));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: -4px;
            filter: drop-shadow(0 0 30px rgba(239,68,68,0.2));
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

        /* Warning box */
        .warning-box {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 10px 20px;
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.18);
            border-radius: 99px;
            font-size: 13px; color: #f87171;
            margin-bottom: 32px;
        }

        .error-actions {
            display: flex; align-items: center; justify-content: center;
            flex-wrap: wrap; gap: 14px;
        }
        .btn-home {
            display: inline-flex; align-items: center; gap: 9px;
            padding: 13px 30px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 12px; color: #fff;
            font-size: 15px; font-weight: 600;
            font-family: 'Space Grotesk', sans-serif;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(239,68,68,0.3);
            transition: all 0.25s;
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(239,68,68,0.45);
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
            border-color: rgba(239,68,68,0.25);
            color: #f87171;
        }
    </style>
</head>
<body>

    <div class="bg-grid">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <div class="error-wrapper">
        <div class="error-code">403</div>

        <div class="shield-wrapper">
            <div class="shield-bg">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
        </div>

        <h1 class="error-title">Access Denied</h1>

        <div class="warning-box">
            <i class="fa-solid fa-triangle-exclamation"></i>
            You don't have permission to view this page
        </div>

        <p class="error-desc">
            This area is restricted. If you believe this is an error, please contact the administrator or sign in with an authorized account.
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

</body>
</html>
