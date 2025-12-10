<x-app-layout>
    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::user()->role && Auth::user()->role->name === 'admin')
    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
        <a href="{{ route('projects.create') }}" class="create-btn" style="text-decoration:none;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Create New Project
        </a>
    </div>
    @endif

    <div class="projects-grid">
        @forelse($projects as $project)
        <div class="card card-dark" style="display: flex; flex-direction: column; height: 100%;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 16px;">
                <div>
                    <h4 style="color: #fff; font-size: 18px; margin-bottom: 8px; font-weight: 600;">{{ $project->name }}</h4>
                    <div class="project-status {{ $project->status == 'completed' ? 'status-completed' : 'status-progress' }}">
                        ● {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </div>
                </div>
                @if(Auth::user()->role && Auth::user()->role->name === 'admin')
                <div style="display: flex; gap: 8px;">
                    <a href="{{ route('projects.edit', $project) }}" style="color: #94a3b8; padding: 4px; border-radius: 4px; transition: color 0.2s;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
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
                {{ Str::limit($project->description, 100) }}
            </p>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 16px; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #64748b;">
                <span>Due: {{ $project->due_date ? $project->due_date->format('M d, Y') : 'N/A' }}</span>
                <span>Team: {{ $project->team->name ?? 'None' }}</span>
            </div>
        </div>
        @empty
        <div style="grid-column: 1 / -1; padding: 40px; text-align: center; color: #94a3b8; background: rgba(255,255,255,0.03); border-radius: 20px;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-bottom: 16px; opacity: 0.5;"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
            <p>No projects found.</p>
            <a href="{{ route('projects.create') }}" style="color: #3b82f6; text-decoration: none; font-weight: 500; margin-top: 8px; display: inline-block;">Create your first project</a>
        </div>
        @endforelse
    </div>
</x-app-layout>
