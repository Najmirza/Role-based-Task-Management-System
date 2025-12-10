<x-app-layout>
    <div class="card card-dark" style="width: 100%; margin: 0 auto;">
        @if ($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Project Name</label>
                <input type="text" name="name" value="{{ old('name', $project->name) }}" required
                       style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Description</label>
                <textarea name="description" rows="4"
                          style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">{{ old('description', $project->description) }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Status</label>
                    <select name="status" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                        <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">In Progress</option>
                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">Completed</option>
                        <option value="on_hold" {{ old('status', $project->status) == 'on_hold' ? 'selected' : '' }} style="background: #0f172a; color: #fff;">On Hold</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Team</label>
                    <select name="team_id" required style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
                        <option value="" style="background: #0f172a; color: #94a3b8;">Select Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team_id', $project->team_id) == $team->id ? 'selected' : '' }} style="background: #0f172a; color: #fff;">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date', $project->due_date ? $project->due_date->format('Y-m-d') : '') }}"
                       style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>

            <div style="text-align: right;">
                <button type="submit" class="create-btn" style="display: inline-flex; border: none;">
                    Update Project
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
