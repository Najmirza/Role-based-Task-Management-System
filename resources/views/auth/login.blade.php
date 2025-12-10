<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Modern Login & Sign-up</title>

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

            <h1>Future of<br>Authentication</h1>
            <p class="lead">Experience the next generation of secure, fast, and beautiful user interfaces. Access your
                dashboard in style.</p>

            <div class="features-grid">
                <div class="feature-item">
                    <div class="check-icon">✓</div> Ultra Secure
                </div>
                <div class="feature-item">
                    <div class="check-icon">✓</div> Fast Performance
                </div>
                <div class="feature-item">
                    <div class="check-icon">✓</div> 99.9% Uptime
                </div>
                <div class="feature-item">
                    <div class="check-icon">✓</div> 24/7 Support
                </div>
            </div>
        </div>

        <!-- MAIN FORM CARD -->
        <div class="glass-panel auth-card">

            <!-- Toggle Switch -->
            <div class="switcher-container">
                <div class="switch-bg" id="switch-bg"></div>
                <button class="switch-btn active" id="tab-signin" onclick="switchMode('signin')">Sign In</button>
                <button class="switch-btn" id="tab-signup" onclick="switchMode('signup')">Sign Up</button>
            </div>

            <div class="forms-wrapper">
                <div class="forms-slider mode-signin" id="forms-slider">

                    <!-- SIGN IN FORM -->
                    <div class="form-col form-signin">
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

                        <form method="POST" action="{{ route('login') }}" id="signin-form">
                            @csrf
                            <div class="input-group">
                                <label for="email">Email Address</label>
                                <div class="input-wrapper">
                                    <input type="email" name="email" :value="old('email')" placeholder="john@example.com" required autofocus autocomplete="username" id="email">
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

                            <div class="input-group">
                                <label for="password">Password</label>
                                <div class="input-wrapper">
                                    <input type="password" name="password" placeholder="••••••••" required autocomplete="current-password" id="password">
                                    <div class="input-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2"
                                                ry="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                    </div>
                                    <button type="button" class="toggle-pass" onclick="togglePassword('password')">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="form-footer">
                                <label class="checkbox-label" for="remember_me">
                                    <input type="checkbox" id="remember_me" name="remember">
                                    <div class="custom-check">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="4" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                    </div>
                                    Remember me
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                                @endif
                            </div>

                            <button class="btn-submit" type="submit" style="margin-top: 20px;">Sign In</button>

                            <div class="separator">or continue with</div>

                            <button type="button" class="btn-google" disabled style="opacity: 0.5; cursor: not-allowed;">
                                <svg width="20" height="20" viewBox="0 0 24 24">
                                    <path
                                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                        fill="#4285F4" />
                                    <path
                                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                        fill="#34A853" />
                                    <path
                                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                        fill="#FBBC05" />
                                    <path
                                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                        fill="#EA4335" />
                                </svg>
                                Google
                            </button>

                            <a href="{{ url('/') }}" class="btn-submit" style="margin-top: 20px; text-decoration: none; display: block; text-align: center;">Home</a>


                            <div class="mobile-prompt">
                                Don't have an account? <a onclick="switchMode('signup')">Sign up</a>
                            </div>
                        </form>
                    </div>

                    <!-- SIGN UP FORM -->
                    <div class="form-col form-signup">
                        <form method="POST" action="{{ route('register') }}" id="signup-form">
                            @csrf
                            <div class="input-group">
                                <label for="name">Full Name</label>
                                <div class="input-wrapper">
                                    <input type="text" name="name" :value="old('name')" placeholder="John Doe" required autofocus autocomplete="name" id="name">
                                    <div class="input-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="reg_email">Email Address</label>
                                <div class="input-wrapper">
                                    <input type="email" name="email" :value="old('email')" placeholder="john@example.com" required autocomplete="username" id="reg_email">
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

                            <div class="input-group">
                                <label for="reg_password">Create Password</label>
                                <div class="input-wrapper">
                                    <input type="password" name="password" placeholder="Min. 5 characters and Max. 15 characters" required autocomplete="new-password" id="reg_password">
                                    <div class="input-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2"
                                                ry="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                    </div>
                                    <button type="button" class="toggle-pass" onclick="togglePassword('reg_password')">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-wrapper">
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" id="password_confirmation">
                                    <div class="input-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2"
                                                ry="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                    </div>
                                    <button type="button" class="toggle-pass" onclick="togglePassword('password_confirmation')">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <button class="btn-submit" type="submit" style="margin-top:10px">Create Account</button>

                            <div class="mobile-prompt">
                                Already have an account? <a onclick="switchMode('signin')">Sign in</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Toast message can be used for session flash messages if desired, but errors are handling cleanly above -->
    @if (session('status'))
        <div class="toast visible" id="toast">{{ session('status') }}</div>
        <script>
             setTimeout(() => document.getElementById('toast').classList.remove('visible'), 3000);
        </script>
    @else
         <div class="toast" id="toast">Signed in successfully!</div>
    @endif

    <script src="{{ asset('js/login-custom.js') }}"></script>

</body>

</html>
