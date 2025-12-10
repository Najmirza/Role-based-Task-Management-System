<x-app-layout>
    <div style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: start;">
        <div>
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 700; color: #fff; margin-bottom: 8px;">System Settings</h2>
            <p style="color: #94a3b8; font-size: 14px;">Configure global application settings.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; font-size: 14px; transition: color 0.2s;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-dark" style="max-width: 600px;">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #94a3b8; margin-bottom: 8px; font-size: 14px;">Site Name</label>
                <input type="text" name="site_name" value="{{ \App\Models\Setting::getValue('site_name', 'Task System') }}" 
                    class="form-control"
                    style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 10px; color: #fff;">
            </div>

            <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <input type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1" 
                    {{ \App\Models\Setting::getValue('maintenance_mode') === '1' ? 'checked' : '' }}
                    style="width: 18px; height: 18px; accent-color: #3b82f6;">
                <label for="maintenance_mode" style="color: #fff; font-weight: 500;">Enable Maintenance Mode</label>
            </div>

            <button type="submit" class="create-btn" style="width: 100%; justify-content: center;">
                Save Changes
            </button>
        </form>
    </div>
</x-app-layout>
