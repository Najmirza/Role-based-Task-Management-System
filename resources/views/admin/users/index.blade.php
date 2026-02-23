<x-app-layout>
<style>
    .admin-page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
        gap: 16px;
        flex-wrap: wrap;
    }
    .admin-page-header h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 6px;
    }
    .admin-page-header p { color: #94a3b8; font-size: 14px; }

    .admin-header-right {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .search-form {
        display: flex;
    }
    .search-input {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 8px 0 0 8px;
        padding: 9px 14px;
        color: #fff;
        outline: none;
        width: 200px;
        font-size: 14px;
    }
    .search-btn {
        background: rgba(59,130,246,0.2);
        color: #3b82f6;
        border: 1px solid rgba(59,130,246,0.3);
        padding: 0 14px;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
        font-size: 14px;
        white-space: nowrap;
    }
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
        white-space: nowrap;
    }
    .back-link:hover { color: #fff; }

    .alert-success { background:rgba(16,185,129,0.15); color:#10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:14px; }
    .alert-error   { background:rgba(239,68,68,0.15);  color:#ef4444;  padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:14px; }

    .admin-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .admin-table-wrap table { width:100%; border-collapse:collapse; min-width: 500px; }

    @media (max-width: 640px) {
        .admin-page-header { flex-direction: column; align-items: flex-start; }
        .admin-header-right { width: 100%; }
        .search-input { width: 100%; flex: 1; }
        .admin-page-header h2 { font-size: 20px; }
    }
</style>

    <div class="admin-page-header">
        <div>
            <h2>User Management</h2>
            <p>Manage system users and view their details.</p>
        </div>
        <div class="admin-header-right">
            <a href="{{ route('admin.dashboard') }}" class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Dashboard
            </a>
            <form method="GET" action="{{ route('admin.users.index') }}" class="search-form">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." class="search-input">
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <div class="card card-dark">
        <div class="admin-table-wrap">
            <table>
                <thead>
                    <tr style="text-align:left;border-bottom:1px solid rgba(255,255,255,0.1);">
                        <th style="padding:14px 16px;font-size:11px;color:#94a3b8;font-weight:600;">NAME</th>
                        <th style="padding:14px 16px;font-size:11px;color:#94a3b8;font-weight:600;">EMAIL</th>
                        <th style="padding:14px 16px;font-size:11px;color:#94a3b8;font-weight:600;">ROLE</th>
                        <th style="padding:14px 16px;font-size:11px;color:#94a3b8;font-weight:600;">JOINED</th>
                        <th style="padding:14px 16px;font-size:11px;color:#94a3b8;font-weight:600;text-align:right;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.05);">
                        <td style="padding:14px 16px;color:#fff;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:30px;height:30px;border-radius:50%;background:#3b82f6;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;flex-shrink:0;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span style="font-weight:500;white-space:nowrap;">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td style="padding:14px 16px;color:#94a3b8;font-size:13px;">{{ $user->email }}</td>
                        <td style="padding:14px 16px;">
                            <span style="padding:5px 10px;border-radius:20px;font-size:11px;font-weight:600;
                                background:{{ $user->role && $user->role->name==='admin' ? 'rgba(16,185,129,0.2)' : 'rgba(59,130,246,0.2)' }};
                                color:{{ $user->role && $user->role->name==='admin' ? '#10b981' : '#3b82f6' }};">
                                {{ $user->role ? ucfirst($user->role->name) : 'User' }}
                            </span>
                        </td>
                        <td style="padding:14px 16px;color:#94a3b8;font-size:13px;white-space:nowrap;">{{ $user->created_at->format('M d, Y') }}</td>
                        <td style="padding:14px 16px;text-align:right;">
                            @if(Auth::id() !== $user->id && (!$user->role || $user->role->name !== 'admin'))
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:rgba(239,68,68,0.1);color:#ef4444;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;transition:background 0.2s;">
                                        Delete
                                    </button>
                                </form>
                            @else
                                <span style="color:#64748b;font-size:12px;font-style:italic;">Protected</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding:20px;border-top:1px solid rgba(255,255,255,0.05);">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
