<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — AmanProjects</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

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
            filter: blur(80px);
            animation: pulse 5s ease-in-out infinite alternate;
        }
        .orb-1 { width: 400px; height: 400px; background: rgba(6,182,212,0.08); top: -100px; right: -80px; }
        .orb-2 { width: 300px; height: 300px; background: rgba(99,102,241,0.06); bottom: -60px; left: -60px; animation-delay: 2s; }
        @keyframes pulse {
            0% { opacity: 0.6; transform: scale(1); }
            100% { opacity: 1; transform: scale(1.12); }
        }

        .login-wrapper {
            position: relative; z-index: 10;
            width: 100%; max-width: 440px;
            padding: 20px;
        }

        .login-card {
            background: rgba(13, 21, 38, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(6,182,212,0.15);
            border-radius: 24px;
            padding: 44px 40px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.04);
        }

        .login-brand {
            text-align: center;
            margin-bottom: 36px;
        }
        .brand-logo {
            width: 60px; height: 60px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 16px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 24px; color: #fff;
            box-shadow: 0 8px 24px rgba(99,102,241,0.4);
            margin-bottom: 18px;
        }
        .brand-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 23px; font-weight: 700; color: #f1f5f9;
            margin-bottom: 8px;
        }
        .brand-subtitle {
            font-size: 13.5px; color: #64748b; line-height: 1.6;
        }

        .auth-alert-success {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 12px 16px;
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.25);
            border-radius: 12px;
            margin-bottom: 22px;
            font-size: 13.5px; color: #86efac;
        }
        .auth-alert-error {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 12px 16px;
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 12px;
            margin-bottom: 22px;
            font-size: 13.5px; color: #fca5a5;
        }

        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: #64748b; margin-bottom: 8px;
        }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: #334155; font-size: 14px; pointer-events: none;
            transition: color 0.2s;
        }
        .form-input {
            width: 100%; padding: 12px 14px 12px 42px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid rgba(6,182,212,0.12);
            border-radius: 12px;
            color: #e2e8f0; font-size: 14.5px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            outline: none;
        }
        .form-input::placeholder { color: #334155; }
        .form-input:focus {
            border-color: rgba(99,102,241,0.5);
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }
        .form-input:focus ~ .input-icon { color: #6366f1; }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border: none; border-radius: 12px;
            color: #fff; font-size: 15px; font-weight: 600;
            font-family: 'Space Grotesk', sans-serif;
            cursor: pointer; letter-spacing: 0.02em;
            box-shadow: 0 6px 20px rgba(99,102,241,0.35);
            transition: all 0.25s;
            display: flex; align-items: center; justify-content: center; gap: 9px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99,102,241,0.5);
        }
        .btn-submit:active { transform: translateY(0); }

        .back-to-site {
            text-align: center; margin-top: 24px;
        }
        .back-to-site a {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 13px; color: #475569;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-to-site a:hover { color: #6366f1; }

        @media (max-width: 480px) {
            .login-card { padding: 32px 24px; }
        }
    </style>
</head>
<body>

    <div class="bg-grid">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="login-brand">
                <div class="brand-logo">
                    <i class="fa-solid fa-key"></i>
                </div>
                <h1 class="brand-title">Forgot password?</h1>
                <p class="brand-subtitle">Enter your email and we'll send you a reset link</p>
            </div>

            @if(session('status'))
                <div class="auth-alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="auth-alert-error">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" name="email" id="email" required autofocus
                            class="form-input" placeholder="your@email.com"
                            value="{{ old('email') }}">
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-paper-plane"></i>
                    Send Reset Link
                </button>
            </form>

            <div class="back-to-site">
                <a href="{{ route('login') }}">
                    <i class="fa-solid fa-arrow-left" style="font-size:11px;"></i>
                    Back to login
                </a>
            </div>

        </div>
    </div>
</body>
</html>
