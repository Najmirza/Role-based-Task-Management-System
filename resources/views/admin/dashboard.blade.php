<x-app-layout>
<style>
    /* ── Admin Dashboard Responsive ── */
    .admin-page-header {
        margin-bottom: 24px;
    }
    .admin-page-header h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 26px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 6px;
    }
    .admin-page-header p {
        color: #94a3b8;
        font-size: 14px;
    }

    /* 4-col grid → 2-col → 1-col */
    .admin-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    /* Quick Actions + Recent Users: 1fr 2fr → stack */
    .admin-main-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 24px;
    }

    .admin-stat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        transition: transform 0.2s, background 0.2s;
    }
    .admin-stat-card:hover { transform: translateY(-2px); }

    .admin-stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .quick-action-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: rgba(255,255,255,0.05);
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        transition: background 0.2s;
        font-size: 14px;
    }
    .quick-action-link:hover { background: rgba(255,255,255,0.09); color: #fff; }

    /* ── Recent Registrations — Responsive rows ── */
    .reg-desktop-header {
        display: grid;
        grid-template-columns: 36px 2fr 2.5fr 1fr 1.2fr;
        gap: 8px;
        padding: 6px 12px 10px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        margin-bottom: 6px;
        font-size: 10px;
        font-weight: 600;
        color: #64748b;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    /* Every row is flex on mobile, grid on desktop */
    .reg-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 8px;
        transition: background 0.15s;
    }
    .reg-row:hover { background: rgba(255,255,255,0.04); }

    /* Avatar */
    .reg-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #3b82f6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    /* Left zone: name + email stacked (mobile) */
    .reg-info {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 2px;
        overflow: hidden;
    }
    .reg-name {
        color: #fff;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .reg-email-inline {
        color: #64748b;
        font-size: 11px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Right zone: role badge + time stacked (mobile) */
    .reg-meta {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 4px;
        flex-shrink: 0;
    }
    .reg-meta-time {
        color: #64748b;
        font-size: 11px;
        white-space: nowrap;
    }

    /* Desktop columns (hidden on mobile) */
    .reg-email-col,
    .reg-role-col,
    .reg-time-col {
        display: none;
    }

    /* ── Desktop layout ≥ 700px ── */
    @media (min-width: 700px) {
        .reg-desktop-header { display: grid; }

        .reg-row {
            display: grid;
            grid-template-columns: 36px 2fr 2.5fr 1fr 1.2fr;
            gap: 8px;
            align-items: center;
        }

        /* On desktop: show separate columns, hide mobile stacked meta */
        .reg-email-inline { display: none; }
        .reg-meta         { display: none; }

        .reg-email-col {
            display: block;
            color: #94a3b8;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 0;
        }
        .reg-role-col {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .reg-time-col {
            display: block;
            color: #64748b;
            font-size: 12px;
            text-align: right;
            white-space: nowrap;
        }
    }

    /* ── Mobile: hide desktop header ── */
    @media (max-width: 699px) {
        .reg-desktop-header { display: none; }
    }

    @media (max-width: 900px) {
        .admin-stats-grid { grid-template-columns: repeat(2, 1fr); }
        .admin-main-grid  { grid-template-columns: 1fr; }
    }

    @media (max-width: 480px) {
        .admin-stats-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .admin-page-header h2 { font-size: 20px; }
        .admin-stat-icon { width: 38px; height: 38px; }
        .admin-stat-card { gap: 10px; }
    }
</style>

    {{-- Page Header --}}
    <div class="admin-page-header">
        <h2>Admin Dashboard</h2>
        <p>Overview of system performance and user statistics.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="admin-stats-grid">
        <a href="{{ route('admin.users.index') }}" class="card card-dark admin-stat-card">
            <div class="admin-stat-icon" style="background:rgba(59,130,246,0.2);color:#3b82f6;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <div style="font-size:22px;font-weight:700;color:#fff;">{{ $stats['total_users'] }}</div>
                <div style="font-size:12px;color:#94a3b8;">Total Users</div>
            </div>
        </a>

        <a href="{{ route('projects.index') }}" class="card card-dark admin-stat-card">
            <div class="admin-stat-icon" style="background:rgba(168,85,247,0.2);color:#a855f7;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div>
                <div style="font-size:22px;font-weight:700;color:#fff;">{{ $stats['total_projects'] }}</div>
                <div style="font-size:12px;color:#94a3b8;">Active Projects</div>
            </div>
        </a>

        <a href="{{ route('teams.index') }}" class="card card-dark admin-stat-card">
            <div class="admin-stat-icon" style="background:rgba(16,185,129,0.2);color:#10b981;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <div style="font-size:22px;font-weight:700;color:#fff;">{{ $stats['total_teams'] }}</div>
                <div style="font-size:12px;color:#94a3b8;">Total Teams</div>
            </div>
        </a>

        <a href="{{ route('tasks.index') }}" class="card card-dark admin-stat-card">
            <div class="admin-stat-icon" style="background:rgba(249,115,22,0.2);color:#f97316;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
            </div>
            <div>
                <div style="font-size:22px;font-weight:700;color:#fff;">{{ $stats['total_tasks'] }}</div>
                <div style="font-size:12px;color:#94a3b8;">Total Tasks</div>
            </div>
        </a>
    </div>

    {{-- Quick Actions & Recent Users --}}
    <div class="admin-main-grid">

        {{-- Quick Actions --}}
        <div class="card card-dark">
            <h3 style="font-size:17px;font-weight:600;color:#fff;margin-bottom:18px;">Quick Actions</h3>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <a href="{{ route('admin.users.index') }}" class="quick-action-link">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Manage Users
                </a>
                <a href="{{ route('projects.create') }}" class="quick-action-link">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    New Project
                </a>
                <a href="{{ route('admin.announcements.index') }}" class="quick-action-link">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Announcements
                </a>
                <a href="{{ route('admin.settings') }}" class="quick-action-link">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    Settings
                </a>
            </div>
        </div>

        {{-- Recent Registrations --}}
        <div class="card card-dark">
            <h3 style="font-size:17px;font-weight:600;color:#fff;margin-bottom:4px;">Recent Registrations</h3>
            <p style="font-size:12px;color:#64748b;margin-bottom:16px;">Latest users who joined the system</p>

            {{-- Desktop column headers (hidden on mobile via CSS) --}}
            <div class="reg-desktop-header">
                <span></span>
                <span>USER</span>
                <span>EMAIL</span>
                <span style="text-align:center;">ROLE</span>
                <span style="text-align:right;">JOINED</span>
            </div>

            {{-- User rows --}}
            <div style="display:flex;flex-direction:column;gap:4px;">
                @foreach($recent_users as $user)
                @php
                    $roleName  = $user->role ? $user->role->name : 'user';
                    $roleColor = match($roleName) {
                        'admin'   => ['bg'=>'rgba(16,185,129,0.15)','text'=>'#10b981'],
                        'manager' => ['bg'=>'rgba(249,115,22,0.15)','text'=>'#f97316'],
                        default   => ['bg'=>'rgba(59,130,246,0.15)','text'=>'#3b82f6'],
                    };
                @endphp

                <div class="reg-row">

                    {{-- Avatar --}}
                    <div class="reg-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>

                    {{-- Name + email stacked (always; email hidden on desktop via CSS) --}}
                    <div class="reg-info">
                        <span class="reg-name">{{ $user->name }}</span>
                        <span class="reg-email-inline">{{ $user->email }}</span>
                    </div>

                    {{-- Email — desktop grid column only --}}
                    <div class="reg-email-col" title="{{ $user->email }}">{{ $user->email }}</div>

                    {{-- Role badge — desktop grid column only --}}
                    <div class="reg-role-col">
                        <span style="padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;white-space:nowrap;
                            background:{{ $roleColor['bg'] }};color:{{ $roleColor['text'] }};">
                            {{ ucfirst($roleName) }}
                        </span>
                    </div>

                    {{-- Joined date — desktop grid column only --}}
                    <div class="reg-time-col">{{ $user->created_at->diffForHumans() }}</div>

                    {{-- Role badge + time stacked — mobile only --}}
                    <div class="reg-meta">
                        <span style="padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;white-space:nowrap;
                            background:{{ $roleColor['bg'] }};color:{{ $roleColor['text'] }};">
                            {{ ucfirst($roleName) }}
                        </span>
                        <span class="reg-meta-time">{{ $user->created_at->diffForHumans() }}</span>
                    </div>

                </div>
                @endforeach
            </div>

            {{-- Footer link --}}
            <div style="margin-top:16px;padding-top:14px;border-top:1px solid rgba(255,255,255,0.05);text-align:right;">
                <a href="{{ route('admin.users.index') }}"
                   style="font-size:13px;color:#6366f1;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:color 0.2s;">
                    View all users
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>

