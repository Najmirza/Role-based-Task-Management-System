<x-app-layout>
    <div style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 700; color: #fff; margin-bottom: 8px;">User Management</h2>
            <p style="color: #94a3b8; font-size: 14px;">Manage system users and view their details.</p>
        </div>
        
        <div style="display: flex; align-items: center; gap: 16px;">
            <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; font-size: 14px; transition: color 0.2s;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Dashboard
            </a>
            <form method="GET" action="{{ route('admin.users.index') }}" style="display: flex;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." 
                    style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px 0 0 8px; padding: 10px 16px; color: #fff; outline: none; width: 240px;">
                <button type="submit" style="background: rgba(59, 130, 246, 0.2); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3); padding: 0 16px; border-radius: 0 8px 8px 0; cursor: pointer;">Search</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="card card-dark">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <th style="padding: 16px; font-size: 12px; color: #94a3b8; font-weight: 600;">NAME</th>
                        <th style="padding: 16px; font-size: 12px; color: #94a3b8; font-weight: 600;">EMAIL</th>
                        <th style="padding: 16px; font-size: 12px; color: #94a3b8; font-weight: 600;">ROLE</th>
                        <th style="padding: 16px; font-size: 12px; color: #94a3b8; font-weight: 600;">JOINED</th>
                        <th style="padding: 16px; font-size: 12px; color: #94a3b8; font-weight: 600; text-align: right;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 16px; color: #fff;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div style="font-weight: 500;">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td style="padding: 16px; color: #94a3b8;">{{ $user->email }}</td>
                        <td style="padding: 16px;">
                            <span style="padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; 
                                background: {{ $user->role && $user->role->name === 'admin' ? 'rgba(16, 185, 129, 0.2)' : 'rgba(59, 130, 246, 0.2)' }}; 
                                color: {{ $user->role && $user->role->name === 'admin' ? '#10b981' : '#3b82f6' }};">
                                {{ $user->role ? ucfirst($user->role->name) : 'User' }}
                            </span>
                        </td>
                        <td style="padding: 16px; color: #94a3b8; font-size: 14px;">{{ $user->created_at->format('M d, Y') }}</td>
                        <td style="padding: 16px; text-align: right;">
                            @if(Auth::id() !== $user->id && (!$user->role || $user->role->name !== 'admin'))
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; transition: background 0.2s;">
                                        Delete
                                    </button>
                                </form>
                            @else
                                <span style="color: #64748b; font-size: 12px; font-style: italic;">Protected</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div style="padding: 20px; border-top: 1px solid rgba(255,255,255,0.05);">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
