<x-app-layout>
    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::user()->role && Auth::user()->role->name === 'admin')
    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
        <a href="{{ route('teams.create') }}" class="create-btn" style="text-decoration:none;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Create New Team
        </a>
    </div>
    @endif

    <div class="projects-grid">
        @forelse($teams as $team)
        <div class="card card-dark" style="display: flex; flex-direction: column; height: 100%;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                <div>
                    <h4 style="color: #fff; font-size: 18px; margin-bottom: 8px; font-weight: 600;">{{ $team->name }}</h4>
                    <div style="font-size: 13px; color: #94a3b8; display: flex; align-items: center; gap: 6px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        {{ $team->users ? $team->users->count() : 0 }} Members
                    </div>
                </div>
                @if(Auth::user()->role && Auth::user()->role->name === 'admin')
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('teams.edit', $team) }}" style="color: #94a3b8; padding: 4px; border-radius: 4px; transition: color 0.2s;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>
                    <form action="{{ route('teams.destroy', $team) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; padding: 4px; cursor: pointer; color: #ef4444;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <p style="font-size: 14px; color: #94a3b8; line-height: 1.6; margin-bottom: 20px; flex: 1;">
                {{ Str::limit($team->description, 100) }}
            </p>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 16px; font-size: 13px; color: #64748b;">
                Created: {{ $team->created_at->format('M d, Y') }}
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; padding: 40px; text-align: center; color: #94a3b8; background: rgba(255,255,255,0.03); border-radius: 20px;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-bottom: 16px; opacity: 0.5;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            <p>No teams found.</p>
            <a href="{{ route('teams.create') }}" style="color: #3b82f6; text-decoration: none; font-weight: 500; margin-top: 8px; display: inline-block;">Create your first team</a>
        </div>
        @endforelse
    </div>
</x-app-layout>
