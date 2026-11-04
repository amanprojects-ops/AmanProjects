<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — AmanProjects</title>

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

        /* Animated grid background */
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
        .orb-1 { width: 400px; height: 400px; background: rgba(6,182,212,0.08); top: -100px; left: -100px; }
        .orb-2 { width: 350px; height: 350px; background: rgba(14,165,233,0.06); bottom: -80px; right: -80px; animation-delay: 2s; }
        .orb-3 { width: 250px; height: 250px; background: rgba(139,92,246,0.05); top: 50%; left: 50%; transform: translate(-50%, -50%); animation-delay: 1s; }

        @keyframes pulse {
            0% { opacity: 0.6; transform: scale(1); }
            100% { opacity: 1; transform: scale(1.1); }
        }

        /* Login card */
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

        /* Brand */
        .login-brand {
            text-align: center;
            margin-bottom: 36px;
        }
        .brand-logo {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #06b6d4, #0ea5e9);
            border-radius: 14px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 22px; color: #fff;
            box-shadow: 0 8px 24px rgba(6,182,212,0.35);
            margin-bottom: 18px;
        }
        .brand-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 24px; font-weight: 700; color: #f1f5f9;
            margin-bottom: 6px;
        }
        .brand-subtitle {
            font-size: 13.5px; color: #64748b;
        }

        /* Alert */
        .auth-alert {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 12px 16px;
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 12px;
            margin-bottom: 22px;
            font-size: 13.5px; color: #fca5a5;
        }
        .auth-alert i { font-size: 14px; margin-top: 1px; flex-shrink: 0; }

        /* Form */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: #64748b; margin-bottom: 8px;
        }
        .input-wrapper {
            position: relative;
        }
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
            border-color: rgba(6,182,212,0.5);
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 0 0 3px rgba(6,182,212,0.1);
        }
        .form-input:focus + .input-icon-right,
        .input-wrapper:focus-within .input-icon {
            color: #06b6d4;
        }

        /* Password toggle */
        .toggle-password {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: #475569; font-size: 14px;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: #06b6d4; }

        /* Remember row */
        .remember-row {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 24px;
        }
        .remember-row input[type="checkbox"] {
            accent-color: #06b6d4;
            width: 16px; height: 16px; cursor: pointer;
        }
        .remember-row label {
            font-size: 13.5px; color: #64748b; cursor: pointer;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #06b6d4, #0ea5e9);
            border: none; border-radius: 12px;
            color: #fff; font-size: 15px; font-weight: 600;
            font-family: 'Space Grotesk', sans-serif;
            cursor: pointer; letter-spacing: 0.02em;
            box-shadow: 0 6px 20px rgba(6,182,212,0.35);
            transition: all 0.25s;
            display: flex; align-items: center; justify-content: center; gap: 9px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(6,182,212,0.5);
            background: linear-gradient(135deg, #0891b2, #0284c7);
        }
        .btn-login:active { transform: translateY(0); }

        /* Back to site */
        .back-to-site {
            text-align: center; margin-top: 24px;
        }
        .back-to-site a {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 13px; color: #475569;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-to-site a:hover { color: #06b6d4; }

        @media (max-width: 480px) {
            .login-card { padding: 32px 24px; }
        }
    </style>
</head>
<body>

    <!-- Background -->
    <div class="bg-grid">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <div class="login-wrapper">
        <div class="login-card">

            <!-- Brand -->
            <div class="login-brand">
                <div class="brand-logo">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h1 class="brand-title">Welcome back</h1>
                <p class="brand-subtitle">Sign in to your admin panel</p>
            </div>

            <!-- Error Alert -->
            @if($errors->any())
                <div class="auth-alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" name="email" id="email" required autofocus
                            class="form-input" placeholder="email@example.com"
                            value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" id="password" required
                            class="form-input" placeholder="••••••••">
                        <button type="button" class="toggle-password" onclick="togglePassword()" id="toggleBtn" aria-label="Toggle password">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Keep me signed in</label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Sign In
                </button>
            </form>

            <div class="back-to-site">
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-arrow-left" style="font-size:11px;"></i>
                    Back to site
                </a>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fa-regular fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fa-regular fa-eye';
            }
        }
    </script>
</body>
</html>
