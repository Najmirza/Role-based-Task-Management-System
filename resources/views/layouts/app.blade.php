<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Use custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-custom.css') }}">
    
    <style>
        /* Force Layout Stability */
        body { margin: 0; background: #0f172a; font-family: 'Inter', sans-serif; }
        
        .dashboard-container {
            display: grid;
    grid-template-columns: 240px minmax(0, 1fr);
    min-height: 100vh;
    width: 100%;
    max-width: 100vw;

    gap: 20px;
    padding: 20px;
    box-sizing: border-box;

    align-items: stretch;
        }

        .sidebar {
            position: sticky;
            top: 20px;
            height: calc(100vh - 40px);
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            padding: 20px;
            backdrop-filter: blur(20px);
             width: 240px;
    min-width: 240px;
    max-width: 240px;

    position: sticky;
    top: 20px;

    height: calc(100vh - 40px);
    flex-shrink: 0;
        }
        .main-content {
    width: 100%;
    min-width: 0;
    max-width: 100%;

    display: flex;
    flex-direction: column;

    overflow-x: hidden;
}

        /* Responsive Breakpoint - Force Tablet/Mobile only */
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            .sidebar {
                position: static;
                height: auto;
                margin-bottom: 20px;
            }
        }
    </style>
    
    
    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- Floating Background Blobs -->
    <div class="bg-shape blob-1"></div>
    <div class="bg-shape blob-2"></div>

    <div class="dashboard-container">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-box" style="width: 32px; height: 32px; font-size: 14px;">MN</div>
                <div style="font-family:var(--font-display); font-weight:700; font-size:18px; color: #fff;">{{ \App\Models\Setting::getValue('site_name', 'Task System') }}</div>
            </div>

            <nav style="flex: 1;">
                <div class="sidebar-section">
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('calendar') }}" class="nav-item {{ request()->routeIs('calendar') ? 'active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        Calendar
                    </a>
                    <a href="{{ route('tasks.index') }}" class="nav-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg>
                        @if(Auth::user()->role && Auth::user()->role->name === 'admin')
                            Assign Tasks
                        @else
                            My Tasks
                        @endif
                    </a>
                    <a href="{{ route('statistics.index') }}" class="nav-item {{ request()->routeIs('statistics.*') ? 'active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                        Statistics
                    </a>
                    <a href="{{ route('projects.index') }}" class="nav-item {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                        Projects
                    </a>
                    <a href="{{ route('teams.index') }}" class="nav-item {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                         <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        Teams
                    </a>
                </div>

                <div class="sidebar-section">
                    <div class="section-label">INTEGRATIONS</div>
                    <a href="#" class="nav-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"></path></svg>
                        Slack
                    </a>
                    <a href="#" class="nav-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"></path></svg>
                        Notion
                    </a>
                </div>
            </nav>

            <div class="sidebar-section" style="margin-top: auto; margin-bottom: 0;">
                <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"></path></svg>
                    Settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item" style="width: 100%; border: none; cursor: pointer; background: transparent;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <h1 class="greeting">Hi, {{ Auth::user()->name }}!</h1>
                <div class="top-actions">
                    <a href="{{ route('tasks.create') }}" class="create-btn" style="text-decoration:none;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Create
                    </a>
                    <button class="icon-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                    </button>
                    @php
                        $isAdmin = Auth::user()->role && Auth::user()->role->name === 'admin';
                        $announcements = $isAdmin ? collect() : \App\Models\Announcement::where('is_active', true)->latest()->get();
                        $count = $announcements->count();
                        $latestId = $announcements->first()->id ?? 0;
                    @endphp

                    <div class="relative" 
                         x-data="{ 
                            open: false, 
                            unread: {{ $count }}, 
                            latestId: {{ $latestId }},
                            init() {
                                const lastSeenId = localStorage.getItem('last_seen_announcement_id') || 0;
                                if (this.latestId <= lastSeenId) {
                                    this.unread = 0;
                                }
                            },
                            markRead() {
                                this.open = !this.open;
                                if (this.unread > 0) {
                                    this.unread = 0;
                                    localStorage.setItem('last_seen_announcement_id', this.latestId);
                                }
                            }
                         }" 
                         @click.outside="open = false" 
                         style="position: relative;">
                        <!-- Icon Button -->
                        <button @click="markRead()" class="icon-btn" style="position: relative;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 01-3.46 0"></path></svg>
                            
                            <!-- Red Number Badge -->
                            <span x-show="unread > 0" class="notification-badge" x-text="unread"></span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="notification-dropdown"
                             style="display: none;">
                            
                            <div style="padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,0.05); font-weight: 600; color: #fff; font-size: 14px; background: rgba(0,0,0,0.2);">
                                Notifications
                            </div>

                            <div style="max-height: 300px; overflow-y: auto;">
                                @forelse($announcements as $announcement)
                                    <a href="{{ route('notifications.index') }}" class="notification-item" style="text-decoration: none; display: block;">
                                        <div style="display: flex; gap: 10px; align-items: start;">
                                            <div style="margin-top: 2px;
                                                @if($announcement->type == 'info') color: #3b82f6;
                                                @elseif($announcement->type == 'success') color: #10b981;
                                                @elseif($announcement->type == 'warning') color: #f97316;
                                                @elseif($announcement->type == 'danger') color: #ef4444;
                                                @endif">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                            </div>
                                            <div>
                                                <div style="color: #fff; font-size: 13px; font-weight: 500; margin-bottom: 2px;">{{ $announcement->title }}</div>
                                                <div style="color: #94a3b8; font-size: 12px; line-height: 1.4;">{{ Str::limit($announcement->message, 80) }}</div>
                                                <div style="color: #64748b; font-size: 10px; margin-top: 4px;">{{ $announcement->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div style="padding: 30px; text-align: center; color: #64748b;">
                                        <div style="margin-bottom: 8px; opacity: 0.5;">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 01-3.46 0"></path><line x1="2" y1="2" x2="22" y2="22"></line></svg>
                                        </div>
                                        <div style="font-size: 13px;">No new notifications</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" style="position: relative;">
                        <div @click="open = !open" class="profile-pic" style="cursor: pointer;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="user-dropdown"
                             style="display: none;">
                            
                            <div style="padding: 16px; border-bottom: 1px solid rgba(255,255,255,0.05); margin-bottom: 8px;">
                                <div style="font-weight: 600; color: #fff;">{{ Auth::user()->name }}</div>
                                <div style="font-size: 12px; color: #94a3b8;">{{ Auth::user()->email }}</div>
                            </div>

                            @if(Auth::user()->role && Auth::user()->role->name === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>
                                    Admin Dashboard
                                </a>
                            @endif

                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                Settings
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; border: none; background: none; font-family: inherit; font-size: inherit; cursor: pointer;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{ $slot }}
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/login-custom.js') }}"></script>
    <script>
        // Interactive checkboxes (if needed globally, or move to specific view)
        document.querySelectorAll('.checkbox:not(.checked)').forEach(box => {
            box.addEventListener('click', function() {
                this.classList.toggle('checked');
            });
        });
    </script>

</body>
</html>
