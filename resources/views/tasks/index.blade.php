<x-app-layout>
    <div class="card card-dark">
        <div class="card-title">
            <span>All Tasks</span>
        </div>

        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; color: #fff; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left;">
                        <th style="padding: 12px; color: #94a3b8; font-weight: 500;">Title</th>
                        <th style="padding: 12px; color: #94a3b8; font-weight: 500;">Project</th>
                        <th style="padding: 12px; color: #94a3b8; font-weight: 500;">Priority</th>
                        <th style="padding: 12px; color: #94a3b8; font-weight: 500;">Status</th>
                        <th style="padding: 12px; color: #94a3b8; font-weight: 500;">Due Date</th>
                        <th style="padding: 12px; color: #94a3b8; font-weight: 500;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 16px 12px;">
                            <a href="{{ route('tasks.show', $task) }}" style="color: #fff; text-decoration: none; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#fff'">
                                {{ $task->title }}
                            </a>
                        </td>
                        <td style="padding: 16px 12px;">{{ $task->project->name ?? 'No Project' }}</td>
                        <td style="padding: 16px 12px;">
                            @if($task->priority == 'high')
                                <span style="color: #ef4444; background: rgba(239, 68, 68, 0.2); padding: 4px 8px; border-radius: 4px; font-size: 12px;">High</span>
                            @elseif($task->priority == 'medium')
                                <span style="color: #f59e0b; background: rgba(245, 158, 11, 0.2); padding: 4px 8px; border-radius: 4px; font-size: 12px;">Medium</span>
                            @else
                                <span style="color: #10b981; background: rgba(16, 185, 129, 0.2); padding: 4px 8px; border-radius: 4px; font-size: 12px;">Low</span>
                            @endif
                        </td>
                        <td style="padding: 16px 12px;">
                             @php
                                $currentUser = Auth::user();
                                $isAdmin = $currentUser->role && $currentUser->role->name === 'admin';
                                $myAssignment = $task->assignees->where('id', $currentUser->id)->first();
                                // If admin, show Global status. If user, show THEIR status (default to pending if null)
                                $displayStatus = $isAdmin ? $task->status : ($myAssignment ? $myAssignment->pivot->status : 'pending');
                             @endphp

                             <span style="font-size: 12px; padding: 4px 8px; border-radius: 20px; background: rgba(255,255,255,0.1);">
                                {{ ucfirst(str_replace('_', ' ', $displayStatus)) }}
                             </span>
                        </td>
                        <td style="padding: 16px 12px; color: #94a3b8;">
                            {{ $task->due_date ? $task->due_date->format('M d, Y') : '-' }}
                        </td>
                        <td style="padding: 16px 12px;">
                            @if(Auth::user()->role && Auth::user()->role->name === 'admin')
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('tasks.edit', $task) }}" style="padding: 6px; background: rgba(59, 130, 246, 0.2); color: #3b82f6; border-radius: 6px; display: inline-flex; align-items: center;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 6px; background: rgba(239, 68, 68, 0.2); color: #ef4444; border-radius: 6px; border: none; cursor: pointer; display: inline-flex; align-items: center;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                            @elseif($displayStatus != 'completed')
                            <form action="{{ route('tasks.update', $task) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" style="padding: 6px 12px; border-radius: 6px; border: 1px solid rgba(16, 185, 129, 0.4); background: rgba(16, 185, 129, 0.1); color: #10b981; cursor: pointer; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; transition: background 0.2s;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    Mark Complete
                                </button>
                            </form>
                            @else
                                <span style="color: #10b981; font-size: 11px; font-weight: 600;">Completed</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 24px; text-align: center; color: #94a3b8;">No tasks found. Create one to get started!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
