<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/login-custom.css') }}">
    <!-- <style>
        /* Landing Page Specific Overrides */
        body {
            display: block; /* Override flex from login-custom */
            min-height: 100vh;
            overflow-x: hidden;
            background: #0f172a; /* Match body bg */
        }

        .landing-wrap {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 40px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1200px;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            z-index: 100;
            transition: all 0.3s ease;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-link {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.2s;
            line-height: 1;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            color: #fff;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 0; /* Override login-custom.css */
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 140px 20px 60px;
        }

        .hero-title {
            font-family: var(--font-display);
            font-size: 64px;
            font-weight: 800;
            line-height: 1.1;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 24px;
        }

        .hero-subtitle {
            font-size: 20px;
            color: #94a3b8;
            max-width: 600px;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .cta-group {
            display: flex;
            gap: 16px;
        }

        /* Default Sections */
        .section {
            padding: 100px 20px;
        }

        .section-title {
            font-family: var(--font-display);
            font-size: 40px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 60px;
            color: #fff;
        }

        .section-title span {
            color: var(--primary);
        }

        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 24px;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.05);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .feature-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #fff;
        }

        .feature-desc {
            color: #94a3b8;
            line-height: 1.6;
        }

        /* About & Product Split */
        .split-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .split-content h2 {
            font-family: var(--font-display);
            font-size: 36px;
            margin-bottom: 20px;
            color: #fff;
        }

        .split-content p {
            color: #94a3b8;
            margin-bottom: 30px;
            font-size: 18px;
            line-height: 1.6;
        }

        .split-image {
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            border-radius: 30px;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,0.1);
        }

        /* Contact Form */
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(15, 23, 42, 0.6);
            padding: 40px;
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Footer */
        .footer {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 60px 20px;
            margin-top: 60px;
            background: #0b1120;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 16px 20px;
            }
            .nav-links {
                display: none; /* Hide for mobile for now or create toggle */
            }
            .hero-title {
                font-size: 40px;
            }
            .split-section {
                grid-template-columns: 1fr;
            }
            .footer-content {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style> -->
    <link rel="stylesheet" href="{{ asset('css/welcome-custom.css') }}">
</head>

<body>

    <!-- Floating Background Blobs -->
    <div class="bg-shape blob-1" style="top: -10%; left: -10%;"></div>
    <div class="bg-shape blob-2" style="bottom: 10%; right: -10%;"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="brand-header">
            <div class="logo-box" style="width: 32px; height: 32px; font-size: 14px;">MN</div>
            <div style="font-family:var(--font-display); font-weight:700; font-size:18px; color: #fff;">Mirza.Dev</div>
        </div>

        <div class="nav-links">
            <a href="#hero" class="nav-link">Home</a>
            <a href="#about" class="nav-link">About</a>
            <a href="#services" class="nav-link">Services</a>
            <a href="#product" class="nav-link">Product</a>
            <a href="#contact" class="nav-link">Contact Us</a>
        </div>

        <div class="auth-buttons" style="display: flex; gap: 12px; align-items: center;">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-submit" style="padding: 10px 20px; width: auto; font-size: 14px;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-submit" style="background: transparent; border: 1px solid rgba(255,255,255,0.2); padding: 10px 20px; width: auto; font-size: 14px;">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('login') }}" class="btn-submit" style="padding: 10px 20px; width: auto; font-size: 14px;">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <div class="landing-wrap">
        
        <!-- Hero Section -->
        <section id="hero" class="hero-section">
            <h1 class="hero-title">Find Your Focus, Fuel<br>Your Progress</h1>
            <p class="hero-subtitle">Curate your personal search space to craft your services, to-do, docs, chat, and screencast</p>
            <div class="cta-group">
                <a href="{{ route('login') }}" class="btn-submit" style="width: auto; padding: 16px 40px; font-size: 16px;">Learn More</a>
                <a href="{{ route('login') }}" class="btn-submit" style="width: auto; padding: 16px 40px; font-size: 16px;">Get Started</a>
            </div>
            
            <!-- Dashboard Preview Card -->
            <div style="margin-top: 60px; width: 100%; max-width: 900px;">
                <div class="glass-panel" style="padding:32px; background: rgba(255,255,255,0.05);">
                    <div style="display: flex; gap: 20px; margin-bottom: 20px; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 120px; padding: 16px; background: rgba(255,255,255,0.05); border-radius: 8px;">
                            <div style="font-size: 12px; color: #94a3b8; margin-bottom: 4px;">HERO</div>
                            <div style="font-size: 24px; font-weight: 800; color: #fff;">172</div>
                        </div>
                        <div style="flex: 1; min-width: 120px; padding: 16px; background: rgba(255,255,255,0.05); border-radius: 8px;">
                            <div style="font-size: 12px; color: #94a3b8; margin-bottom: 4px;">MED</div>
                            <div style="font-size: 24px; font-weight: 800; color: #fff;">282</div>
                        </div>
                        <div style="flex: 1; min-width: 120px; padding: 16px; background: rgba(255,255,255,0.05); border-radius: 8px;">
                            <div style="font-size: 12px; color: #94a3b8; margin-bottom: 4px;">MED</div>
                            <div style="font-size: 24px; font-weight: 800; color: #fff;">282</div>
                        </div>
                        <div style="flex: 1; min-width: 120px; padding: 16px; background: rgba(255,255,255,0.05); border-radius: 8px;">
                            <div style="font-size: 12px; color: #94a3b8; margin-bottom: 4px;">GOD</div>
                            <div style="font-size: 24px; font-weight: 800; color: #fff;">145</div>
                        </div>
                        <div style="flex: 1; min-width: 120px; padding: 16px; background: rgba(255,255,255,0.05); border-radius: 8px;">
                            <div style="font-size: 12px; color: #94a3b8; margin-bottom: 4px;">VIP</div>
                            <div style="font-size: 24px; font-weight: 800; color: #fff;">98</div>
                        </div>
                    </div>
                    <p style="text-align: center; color: #94a3b8; padding: 20px 0;">Track your productivity with real-time analytics</p>
                </div>
            </div>
        </section>

        <!-- Trusted By Section -->
        <section class="section" style="padding: 60px 20px;">
            <p style="text-align: center; color: #94a3b8; margin-bottom: 30px; font-weight: 500;">Trusted by thousands of teams around the world</p>
            <div style="display: flex; justify-content: center; align-items: center; gap: 60px; flex-wrap: wrap;">
                <div style="font-weight: 700; color: #64748b; font-size: 18px;">Indusium</div>
                <div style="font-weight: 700; color: #64748b; font-size: 18px;">Uber</div>
                <div style="font-weight: 700; color: #64748b; font-size: 18px;">NETFLIX</div>
                <div style="font-weight: 700; color: #64748b; font-size: 18px;">trivago</div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="section" style="padding: 60px 20px;">
            <div class="features-grid" style="grid-template-columns: repeat(3, 1fr);">
                <div class="feature-card" style="text-align: center;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 24px; background: rgba(59, 130, 246, 0.1); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 36px;">�</div>
                    <h3 class="feature-title">Keep project details in one place</h3>
                    <p class="feature-desc">Save time by accessing everything your team needs in a single location. No more switching between tools.</p>
                </div>
                <div class="feature-card" style="text-align: center;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 24px; background: rgba(245, 158, 11, 0.1); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 36px;">�</div>
                    <h3 class="feature-title">Manage an easy workflow that's on schedule</h3>
                    <p class="feature-desc">Stay on track with automated workflows and smart reminders that keep projects moving forward.</p>
                </div>
                <div class="feature-card" style="text-align: center;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 24px; background: rgba(236, 72, 153, 0.1); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 36px;">�</div>
                    <h3 class="feature-title">Work with any team and boost productivity</h3>
                    <p class="feature-desc">Collaborate seamlessly across departments with tools designed for modern team communication.</p>
                </div>
            </div>
        </section>

        <!-- Collaborate Section -->
        <section id="about" class="section">
            <div class="split-section">
                <div class="split-image">
                    <div style="background: rgba(255,255,255,0.05); padding: 24px; border-radius: 12px;">
                        <div style="font-weight: 700; margin-bottom: 12px; color: #fff;">Team Collaboration</div>
                        <div style="font-size: 14px; color: #94a3b8;">Real-time updates</div>
                    </div>
                </div>
                <div class="split-content">
                    <h2>Collaborate more effectively</h2>
                    <p>Bring your team together with powerful collaboration tools. Share ideas, track progress, and celebrate wins together in one unified workspace.</p>
                    <a href="{{ route('login') }}" class="btn-submit" style="width: auto; padding: 12px 28px;">Learn More →</a>
                </div>
            </div>
        </section>

        <!-- Brand Visibility Section -->
        <section class="section">
            <div class="split-section">
                <div class="split-content">
                    <h2>Make your brand more visible</h2>
                    <p>Reach more people and grow your audience with powerful analytics. Track engagement, measure impact, and optimize your strategy with data-driven insights.</p>
                    <a href="#" class="btn-submit" style="width: auto; padding: 12px 28px;">Learn More →</a>
                </div>
                <div class="split-image">
                    <div style="text-align: center;">
                        <div style="font-size: 36px; font-weight: 800; margin-bottom: 8px; color: #fff;">63,688</div>
                        <div style="color: #94a3b8; margin-bottom: 20px;">Direct Budget Spent</div>
                        <div style="background: rgba(255,255,255,0.05); padding: 16px; border-radius: 12px;">
                            <div style="height: 100px; background: linear-gradient(to top, #3b82f6 0%, #8b5cf6 50%, #a855f7 100%); border-radius: 8px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Checklist --><section id="services" class="section">
            <h2 class="section-title" style="text-align: left; max-width: 1200px; margin: 0 auto 40px;">Our product offers you</h2>
            <div style="max-width: 1200px; margin: 0 auto;">
                <div style="display: flex; gap: 20px; margin-bottom: 32px;">
                    <div style="width: 28px; height: 28px; border-radius: 50%; border: 2px solid #3b82f6; display: flex; align-items: center; justify-content: center; color: #3b82f6; flex-shrink: 0;">✓</div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 8px; color: #fff;">Get updates with our apps</h3>
                        <p style="color: #94a3b8; line-height: 1.6;">Designing better experience through innovation, collaboration and customer focus</p>
                    </div>
                </div>
                <div style="display: flex; gap: 20px; margin-bottom: 32px;">
                    <div style="width: 28px; height: 28px; border-radius: 50%; border: 2px solid #3b82f6; display: flex; align-items: center; justify-content: center; color: #3b82f6; flex-shrink: 0;">✓</div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 8px; color: #fff;">Unlimited features, boundless potential</h3>
                        <p style="color: #94a3b8; line-height: 1.6;">Empower your workflow with unlimited features that adapt to your growing needs</p>
                    </div>
                </div>
                <div style="display: flex; gap: 20px; margin-bottom: 32px;">
                    <div style="width: 28px; height: 28px; border-radius: 50%; border: 2px solid #3b82f6; display: flex; align-items: center; justify-content: center; color: #3b82f6; flex-shrink: 0;">✓</div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 8px; color: #fff;">Effortless allocation with lower cost</h3>
                        <p style="color: #94a3b8; line-height: 1.6;">Optimize resources efficiently while keeping costs minimal and productivity high</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial -->
        <section class="section">
            <div style="max-width: 800px; margin: 0 auto; display: flex; gap: 40px; align-items: center;">
                <div style="width: 200px; height: 200px; border-radius: 20px; background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%); flex-shrink: 0;"></div>
                <div>
                    <h3 style="font-size: 24px; font-weight: 700; margin-bottom: 16px; color: #fff;">Once we implemented Mirza.Dev, I was amazed to see that some of our projects I thought were going to take weeks to finish were completed in just a matter of days.</h3>
                    <p style="color: #94a3b8; line-height: 1.8; margin-bottom: 20px; font-style: italic;">"The efficiency gains have been remarkable for our entire team."</p>
                    <div style="font-weight: 600; color: #fff;">Naj Mirza</div>
                </div>
            </div>
        </section>

        <!-- Product Section -->
        <section id="product" class="section">
            <h2 class="section-title">Our <span>Product</span></h2>
            <div class="split-section">
                <div class="split-image">
                    <div style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 16px; width: 100%;">
                        <div style="background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); height: 200px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 60px;">💻</span>
                        </div>
                        <div style="display: flex; gap: 12px; margin-top: 16px;">
                            <div style="flex: 1; background: rgba(255,255,255,0.05); padding: 16px; border-radius: 8px; text-align: center;">
                                <div style="font-size: 24px; font-weight: 800; color: #fff;">$20,455.67</div>
                                <div style="font-size: 12px; color: #94a3b8;">Total Revenue</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="split-content">
                    <h2>We offer more opportunities for an affordable price</h2>
                    <p>Designed with a focus on User Experience, our dashboard centralizes everything you need. From project tracking to financial overviews, get a bird's eye view of your operations.</p>
                    <ul style="list-style: none; padding: 0; color: #cbd5e1; gap: 12px; display: flex; flex-direction: column; margin-bottom: 30px;">
                        <li style="display: flex; gap: 10px; align-items: center;"><span style="color: var(--primary);">✓</span> Advanced analytics dashboard</li>
                        <li style="display: flex; gap: 10px; align-items: center;"><span style="color: var(--primary);">✓</span> Real-time project tracking</li>
                        <li style="display: flex; gap: 10px; align-items: center;"><span style="color: var(--primary);">✓</span> Financial overview tools</li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn-submit" style="width: auto; padding: 12px 30px;">Start Free Trial</a>
                </div>
            </div>
        </section>

        <!-- Contact Us Section -->
        <section id="contact" class="section">
            <h2 class="section-title">Contact <span>Us</span></h2>
            <div class="contact-form glass-panel" style="max-width: 600px; margin: 0 auto; background: rgba(15, 23, 42, 0.6); padding: 40px; border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.1);">
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Message sent successfully!');">
                    <div class="input-group">
                        <label>Your Name</label>
                        <div class="input-wrapper">
                            <input type="text" placeholder="John Doe" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" placeholder="john@example.com" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Message</label>
                        <div class="input-wrapper">
                            <textarea rows="4" placeholder="How can we help you?" style="width: 100%; border: none; background: transparent; color: #fff; padding: 12px; outline: none; resize: vertical;"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section" style="text-align: center; background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(168, 85, 247, 0.1) 100%); padding: 80px 20px; border-radius: 24px; max-width: 1200px; margin: 60px auto;">
            <h2 style="font-family: var(--font-display); font-size: 42px; font-weight: 800; margin-bottom: 30px; color: #fff;">Get started with us today</h2>
            <div style="display: flex; gap: 16px; justify-content: center; margin-top: 30px; flex-wrap: wrap;">
                <a href="#" onclick="showToast(); return false;" class="btn-submit" style="width: auto; padding: 14px 32px; font-size: 16px;">📥 Download Now</a>
                <a href="#" onclick="showToast(); return false;" class="btn-submit" style="width: auto; padding: 14px 32px; font-size: 16px; background: transparent; border: 2px solid rgba(255,255,255,0.2);">📱 Download Now</a>
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 1fr; gap: 60px; max-width: 1200px; margin: 0 auto; padding: 60px 20px 40px;">
            <!-- Brand Section -->
            <div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div class="logo-box" style="width: 40px; height: 40px; font-size: 16px;">MN</div>
                    <h3 style="font-family: var(--font-display); font-weight: 700; font-size: 20px; color: #fff; margin: 0;">Mirza.Dev</h3>
                </div>
                <p style="color: #94a3b8; line-height: 1.6; margin: 0; max-width: 280px;">
                    Mirza.Dev is your all-in-one solution for organizing tasks and managing projects efficiently.
                </p>
            </div>

            <!-- Contact Us Section -->
            <div>
                <h4 style="color: #f8fafc; font-size: 16px; font-weight: 600; margin: 0 0 20px 0;">Contact Us</h4>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="tel:+16046823444" style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #94a3b8; transition: color 0.2s;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span style="font-size: 14px;">+91 9937762490</span>
                    </a>
                    <a href="mailto:najmirza7867@gmail.com" style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: #94a3b8; transition: color 0.2s;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                        <span style="font-size: 14px;">najmirza7867@gmail.com</span>
                    </a>
                </div>
            </div>

            <!-- Company Section -->
            <div>
                <h4 style="color: #f8fafc; font-size: 16px; font-weight: 600; margin: 0 0 20px 0;">Company</h4>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="#hero" style="text-decoration: none; color: #94a3b8; font-size: 14px; transition: color 0.2s;">Home</a>
                    <a href="#about" style="text-decoration: none; color: #94a3b8; font-size: 14px; transition: color 0.2s;">About Us</a>
                    <a href="#services" style="text-decoration: none; color: #94a3b8; font-size: 14px; transition: color 0.2s;">Services</a>
                </div>
            </div>

            <!-- Support Section -->
            <div>
                <h4 style="color: #f8fafc; font-size: 16px; font-weight: 600; margin: 0 0 20px 0;">Support</h4>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="#contact" style="text-decoration: none; color: #94a3b8; font-size: 14px; transition: color 0.2s;">Help Center</a>
                    <a href="#" style="text-decoration: none; color: #94a3b8; font-size: 14px; transition: color 0.2s;">FAQ</a>
                </div>
            </div>

            <!-- Legal Section -->
            <div>
                <h4 style="color: #f8fafc; font-size: 16px; font-weight: 600; margin: 0 0 20px 0;">Legal</h4>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="#" style="text-decoration: none; color: #94a3b8; font-size: 14px; transition: color 0.2s;">Privacy Policy</a>
                    <a href="#" style="text-decoration: none; color: #94a3b8; font-size: 14px; transition: color 0.2s;">Term of Use</a>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div style="border-top: 1px solid rgba(255,255,255,0.05); padding: 24px 20px; text-align: center;">
            <p style="margin: 0; color: #64748b; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 6px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M15 9.354a4 4 0 1 0 0 5.292"></path></svg>
                {{ date('Y') }} Mirza.Dev. All Right Reserved.
            </p>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/login-custom.js') }}"></script>

    <!-- Toast Notification -->
    <div id="toast" style="position: fixed; bottom: 30px; right: 30px; background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; padding: 16px 28px; border-radius: 12px; box-shadow: 0 10px 40px rgba(59, 130, 246, 0.4); transform: translateX(400px); opacity: 0; transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); z-index: 9999; display: flex; align-items: center; gap: 12px;">
        <span style="font-size: 24px;">🚀</span>
        <div>
            <div style="font-weight: 700; font-size: 16px;">Coming Soon!</div>
            <div style="font-size: 13px; opacity: 0.9;">Download will be available shortly</div>
        </div>
    </div>
</body>
</html>
