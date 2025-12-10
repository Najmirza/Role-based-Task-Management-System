<x-app-layout>
    <div style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; max-width: 1000px; margin: 0 auto 24px auto;">
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 700; color: #fff;">Create New Project</h2>
        <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; font-size: 14px; transition: color 0.2s;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Dashboard
        </a>
    </div>

    <div class="card card-dark" style="width: 100%; max-width: 1000px; margin: 0 auto;">
        @if ($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Project Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Description</label>
                <textarea name="description" rows="4"
                          style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">{{ old('description') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Status</label>
                    <select name="status" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                        <option value="in_progress" style="background: #0f172a; color: #fff;">In Progress</option>
                        <option value="completed" style="background: #0f172a; color: #fff;">Completed</option>
                        <option value="on_hold" style="background: #0f172a; color: #fff;">On Hold</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Team</label>
                    <select name="team_id" required style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                        <option value="" style="background: #0f172a; color: #94a3b8;">Select Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" style="background: #0f172a; color: #fff;">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}"
                       style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>

            <div style="text-align: right;">
                <button type="submit" class="create-btn" style="display: inline-flex; border: none;">
                    Create Project
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
