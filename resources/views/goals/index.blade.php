<x-app-layout>
    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-dark">
        <div class="card-title">
            <span>Your Goals</span>
        </div>

        <div>
            @forelse($goals as $goal)
            <div class="goal-item">
                <form action="{{ route('goals.update', $goal) }}" method="POST" id="goal-form-{{ $goal->id }}" style="display: flex; align-items: center; gap: 12px; flex: 1;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="title" value="{{ $goal->title }}">
                    
                    <!-- Hidden field to handle unchecked state -->
                     <input type="hidden" name="is_completed" value="0">
                    <input type="checkbox" name="is_completed" value="1" 
                           {{ $goal->is_completed ? 'checked' : '' }} 
                           onchange="document.getElementById('goal-form-{{ $goal->id }}').submit()"
                           class="checkbox {{ $goal->is_completed ? 'checked' : '' }}" 
                           style="width: 20px; height: 20px; cursor: pointer;">
                    
                    <label style="color: {{ $goal->is_completed ? '#fff' : '#94a3b8' }}; font-size: 14px; text-decoration: {{ $goal->is_completed ? 'line-through' : 'none' }}; flex: 1;">
                        {{ $goal->title }}
                        <span style="font-size: 11px; color: #64748b; margin-left: 8px;">({{ date("F", mktime(0, 0, 0, $goal->month, 10)) }} {{ $goal->year }})</span>
                    </label>
                </form>

                 <div style="display: flex; gap: 8px;">
                     <a href="{{ route('goals.edit', $goal) }}" style="color: #94a3b8; padding: 4px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>
                    <form action="{{ route('goals.destroy', $goal) }}" method="POST" onsubmit="return confirm('Delete this goal?');" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; padding: 4px; cursor: pointer; color: #ef4444;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><line x1="10" y1="11" x2="10.01" y2="11"></line><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div style="color: #64748b; font-size: 14px; padding: 20px; text-align: center;">No goals found.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
