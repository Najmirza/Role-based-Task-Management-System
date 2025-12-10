<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Profile - Mirza.Dev</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Use the newly created custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login-custom.css') }}">
    
    <!-- Alpine.js for modal functionality -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Dashboard Specific Overrides */
        .wrap {
            max-width: 1200px;
            grid-template-columns: 250px 1fr;
            align-items: start;
        }
        
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
            height: 100%;
        }

        .nav-item {
            padding: 12px 16px;
            border-radius: 12px;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            transition: all 200ms;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255, 255, 255, 0.05);
            color: #f1f5f9;
        }

        .nav-item.active {
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary);
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .profile-section {
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 32px;
            border-radius: 20px;
        }

        .section-header {
            margin-bottom: 24px;
        }

        .section-title {
            font-family: var(--font-display);
            font-size: 20px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 8px;
        }

        .section-desc {
            color: #94a3b8;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .wrap {
                grid-template-columns: 1fr;
            }
            .sidebar {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Floating Background Blobs -->
    <div class="bg-shape blob-1"></div>
    <div class="bg-shape blob-2"></div>

    <div class="wrap" style="align-items: stretch; min-height: 80vh;">

        <!-- SIDEBAR -->
        <div class="glass-panel sidebar" style="padding: 24px;">
            <div class="brand-header" style="margin-bottom: 40px;">
                <div class="logo-box" style="width: 40px; height: 40px; font-size: 16px;">MN</div>
                <div style="font-family:var(--font-display); font-weight:700; font-size:20px;">Mirza.Dev</div>
            </div>

            <nav style="display: flex; flex-direction: column; gap: 8px; flex: 1;">
                <a href="{{ route('dashboard') }}" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Dashboard
                </a>
                <a href="{{ route('calendar') }}" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Calendar
                </a>
                <a href="{{ route('tasks.index') }}" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg>
                    My Tasks
                </a>
                <a href="{{ route('statistics.index') }}" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    Statistics
                </a>
                <a href="{{ route('projects.index') }}" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                    Projects
                </a>
                <a href="{{ route('teams.index') }}" class="nav-item">
                     <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Teams
                </a>

                <div style="height: 1px; background: rgba(255,255,255,0.1); margin: 8px 0;"></div>

                <div style="font-size: 11px; font-weight: 700; color: #64748b; letter-spacing: 0.05em; margin-bottom: 4px; padding: 0 16px;">INTEGRATIONS</div>
                <a href="#" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"></path></svg>
                    Slack
                </a>
                <a href="#" class="nav-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"></path></svg>
                    Notion
                </a>
                
                <div style="height: 1px; background: rgba(255,255,255,0.1); margin: 8px 0;"></div>

                <a href="{{ route('profile.edit') }}" class="nav-item active">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    Settings
                </a>
            </nav>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item" style="width: 100%; border: none; cursor: pointer; color: #f87171; background: rgba(239, 68, 68, 0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Log Out
                </button>
            </form>
        </div>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- Profile Information Section -->
            <div class="glass-panel profile-section">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password Section -->
            <div class="glass-panel profile-section">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account Section -->
            <div class="glass-panel profile-section">
                @include('profile.partials.delete-user-form')
            </div>

        </main>
    </div>

    <!-- 3D Tilt Script Reuse -->
    <script src="{{ asset('js/login-custom.js') }}"></script>

</body>

</html>
