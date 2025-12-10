<x-app-layout>
    <div style="margin-bottom: 24px;">
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 700; color: #fff; margin-bottom: 8px;">Admin Dashboard</h2>
        <p style="color: #94a3b8; font-size: 14px;">Overview of system performance and user statistics.</p>
    </div>

    <!-- Stats Grid -->
    <div class="cards-grid" style="grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px;">
        <a href="{{ route('admin.users.index') }}" class="card card-dark" style="display: flex; align-items: center; gap: 16px; text-decoration: none; transition: transform 0.2s, background 0.2s;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(59, 130, 246, 0.2); color: #3b82f6; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: 700; color: #fff;">{{ $stats['total_users'] }}</div>
                <div style="font-size: 13px; color: #94a3b8;">Total Users</div>
            </div>
        </a>

        <a href="{{ route('projects.index') }}" class="card card-dark" style="display: flex; align-items: center; gap: 16px; text-decoration: none; transition: transform 0.2s, background 0.2s;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(168, 85, 247, 0.2); color: #a855f7; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: 700; color: #fff;">{{ $stats['total_projects'] }}</div>
                <div style="font-size: 13px; color: #94a3b8;">Active Projects</div>
            </div>
        </a>

        <a href="{{ route('teams.index') }}" class="card card-dark" style="display: flex; align-items: center; gap: 16px; text-decoration: none; transition: transform 0.2s, background 0.2s;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.2); color: #10b981; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: 700; color: #fff;">{{ $stats['total_teams'] }}</div>
                <div style="font-size: 13px; color: #94a3b8;">Total Teams</div>
            </div>
        </a>

        <a href="{{ route('tasks.index') }}" class="card card-dark" style="display: flex; align-items: center; gap: 16px; text-decoration: none; transition: transform 0.2s, background 0.2s;">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(249, 115, 22, 0.2); color: #f97316; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg>
            </div>
            <div>
                <div style="font-size: 24px; font-weight: 700; color: #fff;">{{ $stats['total_tasks'] }}</div>
                <div style="font-size: 13px; color: #94a3b8;">Total Tasks</div>
            </div>
        </a>
    </div>

    <!-- Quick Actions & Recent Users -->
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">
        <!-- Quick Actions -->
        <div class="card card-dark">
            <h3 style="font-size: 18px; font-weight: 600; color: #fff; margin-bottom: 20px;">Quick Actions</h3>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('admin.users.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; color: #fff; text-decoration: none; transition: background 0.2s;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Manage Users
                </a>
                <a href="{{ route('projects.create') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; color: #fff; text-decoration: none; transition: background 0.2s;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"></path></svg>
                    New Project
                </a>
                <a href="{{ route('admin.announcements.index') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; color: #fff; text-decoration: none; transition: background 0.2s;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Announcements
                </a>
                <a href="{{ route('admin.settings') }}" style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; color: #fff; text-decoration: none; transition: background 0.2s;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    Settings
                </a>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="card card-dark">
            <h3 style="font-size: 18px; font-weight: 600; color: #fff; margin-bottom: 20px;">Recent Registrations</h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <th style="padding: 12px; font-size: 12px; color: #94a3b8; font-weight: 600;">NAME</th>
                            <th style="padding: 12px; font-size: 12px; color: #94a3b8; font-weight: 600;">EMAIL</th>
                            <th style="padding: 12px; font-size: 12px; color: #94a3b8; font-weight: 600;">ROLE</th>
                            <th style="padding: 12px; font-size: 12px; color: #94a3b8; font-weight: 600;">JOINED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_users as $user)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="padding: 12px; color: #fff;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 24px; height: 24px; border-radius: 50%; background: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td style="padding: 12px; color: #94a3b8;">{{ $user->email }}</td>
                            <td style="padding: 12px;">
                                <span style="padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; 
                                    background: {{ $user->role && $user->role->name === 'admin' ? 'rgba(16, 185, 129, 0.2)' : 'rgba(59, 130, 246, 0.2)' }}; 
                                    color: {{ $user->role && $user->role->name === 'admin' ? '#10b981' : '#3b82f6' }};">
                                    {{ $user->role ? ucfirst($user->role->name) : 'User' }}
                                </span>
                            </td>
                            <td style="padding: 12px; color: #94a3b8; font-size: 13px;">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
