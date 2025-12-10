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

        <form action="{{ route('teams.update', $team) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Team Name</label>
                <input type="text" name="name" value="{{ old('name', $team->name) }}" required
                       style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Description</label>
                <textarea name="description" rows="4"
                          style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none;">{{ old('description', $team->description) }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; font-size: 14px; margin-bottom: 8px;">Assign Members</label>
                <select name="members[]" multiple style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; color: #fff; outline: none; height: 120px;">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" 
                            {{ $team->users->contains($user->id) ? 'selected' : '' }}
                            style="background: #0f172a; padding: 4px;">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                <p style="color: #64748b; font-size: 12px; margin-top: 4px;">Hold Ctrl (Windows) or Cmd (Mac) to select multiple users.</p>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="create-btn" style="display: inline-flex; border: none;">
                    Update Team
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
