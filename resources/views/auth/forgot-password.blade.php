<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Forgot Password - Mirza.Dev</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Use the newly created custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login-custom.css') }}">
</head>

<body>

    <!-- Floating Background Blobs -->
    <div class="bg-shape blob-1"></div>
    <div class="bg-shape blob-2"></div>

    <div class="wrap">

        <!-- BRANDING SECTION (Desktop) -->
        <div class="glass-panel hero">
            <div class="brand-header">
                <div class="logo-box">MN</div>
                <div style="font-family:var(--font-display); font-weight:700; font-size:24px;">Mirza.Dev</div>
            </div>

            <h1>Secure Account<br>Recovery</h1>
            <p class="lead">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</p>

            <div class="features-grid">
                <div class="feature-item">
                    <div class="check-icon">✓</div> Secure Reset
                </div>
                <div class="feature-item">
                    <div class="check-icon">✓</div> Instant Email
                </div>
            </div>
        </div>

        <!-- MAIN FORM CARD -->
        <div class="glass-panel auth-card" style="justify-content: center;">

            <div class="forms-wrapper" style="overflow: visible;">
                 <!-- Validation Errors Display -->
                 <x-auth-session-status class="mb-4" :status="session('status')" />
                 @if ($errors->any())
                     <div class="mb-4">
                         <ul class="text-sm text-red-400 space-y-1">
                             @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                             @endforeach
                         </ul>
                     </div>
                 @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div style="margin-bottom: 20px;">
                        <h2 style="font-family: var(--font-display); font-size: 24px; margin: 0 0 8px 0;">Reset Password</h2>
                        <p style="font-size: 14px; color: #94a3b8; margin: 0;">Enter your email to receive instructions.</p>
                    </div>

                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" :value="old('email')" placeholder="john@example.com" required autofocus id="email">
                            <div class="input-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <path d="M3 7l9 6 9-6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button class="btn-submit" type="submit" style="margin-top: 24px;">Email Password Reset Link</button>

                    <div class="mobile-prompt" style="margin-top: 24px;">
                        Remember your password? <a href="{{ route('login') }}">Back to Login</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Toast message for session flash messages -->
    @if (session('status'))
        <div class="toast visible" id="toast">{{ session('status') }}</div>
        <script>
             setTimeout(() => document.getElementById('toast').classList.remove('visible'), 3000);
        </script>
    @endif

    <script src="{{ asset('js/login-custom.js') }}"></script>

</body>

</html>
