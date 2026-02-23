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
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .back-link:hover { color: #fff; }

    .alert-success { background:rgba(16,185,129,0.15); color:#10b981; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:14px; }

    .settings-card {
        max-width: 560px;
        width: 100%;
    }

    .form-label { display:block; color:#94a3b8; margin-bottom:8px; font-size:14px; }
    .form-input  { width:100%; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:8px; padding:10px 12px; color:#fff; box-sizing:border-box; font-size:14px; outline:none; }
    .form-input:focus { border-color: rgba(99,102,241,0.5); }

    @media (max-width: 640px) {
        .admin-page-header { flex-direction: column; }
        .admin-page-header h2 { font-size: 20px; }
        .settings-card { max-width: 100%; }
    }
</style>

    <div class="admin-page-header">
        <div>
            <h2>System Settings</h2>
            <p>Configure global application settings.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="back-link">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-dark settings-card">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div style="margin-bottom:20px;">
                <label class="form-label">Site Name</label>
                <input type="text" name="site_name"
                    value="{{ \App\Models\Setting::getValue('site_name', 'Task System') }}"
                    class="form-input"
                    placeholder="e.g. Task Manager">
            </div>

            <div style="margin-bottom:28px;display:flex;align-items:center;gap:12px;">
                <input type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1"
                    {{ \App\Models\Setting::getValue('maintenance_mode') === '1' ? 'checked' : '' }}
                    style="width:18px;height:18px;accent-color:#3b82f6;flex-shrink:0;">
                <label for="maintenance_mode" style="color:#fff;font-weight:500;font-size:14px;cursor:pointer;">
                    Enable Maintenance Mode
                </label>
            </div>

            <button type="submit" class="create-btn" style="width:100%;justify-content:center;">
                Save Changes
            </button>
        </form>
    </div>
</x-app-layout>
