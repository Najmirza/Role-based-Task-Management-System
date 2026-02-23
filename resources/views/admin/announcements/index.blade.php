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

    /* Announcements grid: form + list */
    .announcements-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 24px;
    }

    .form-label  { display:block; color:#94a3b8; margin-bottom:8px; font-size:13px; }
    .form-input  { width:100%; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:8px; padding:10px; color:#fff; box-sizing:border-box; font-size:14px; }
    .form-select { width:100%; background:rgba(30,41,59,0.95); border:1px solid rgba(255,255,255,0.1); border-radius:8px; padding:10px; color:#fff; box-sizing:border-box; font-size:14px; }

    .ann-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        padding: 16px;
    }
    .ann-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 8px;
        gap: 8px;
    }
    .ann-type-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        flex-shrink: 0;
    }
    .ann-delete-btn {
        background: none;
        border: none;
        color: #64748b;
        cursor: pointer;
        padding: 4px;
        flex-shrink: 0;
    }
    .ann-delete-btn:hover { color: #ef4444; }

    @media (max-width: 768px) {
        .announcements-grid { grid-template-columns: 1fr; }
        .admin-page-header h2 { font-size: 20px; }
    }
</style>

    <div class="admin-page-header">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="back-link" style="display:inline-flex;margin-bottom:10px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Dashboard
            </a>
            <h2>Global Announcements</h2>
            <p>Post messages to all users in the system.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="announcements-grid">
        {{-- Create Form --}}
        <div class="card card-dark" style="height:fit-content;">
            <h3 style="font-size:17px;font-weight:600;color:#fff;margin-bottom:18px;">Post New Announcement</h3>
            <form action="{{ route('admin.announcements.store') }}" method="POST">
                @csrf
                <div style="margin-bottom:14px;">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" required class="form-input" placeholder="Announcement title…">
                </div>
                <div style="margin-bottom:14px;">
                    <label class="form-label">Message</label>
                    <textarea name="message" rows="3" required class="form-input" placeholder="Write your message…" style="resize:vertical;"></textarea>
                </div>
                <div style="margin-bottom:20px;">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="info"    style="background:#1e293b;">Info (Blue)</option>
                        <option value="success" style="background:#1e293b;">Success (Green)</option>
                        <option value="warning" style="background:#1e293b;">Warning (Orange)</option>
                        <option value="danger"  style="background:#1e293b;">Danger (Red)</option>
                    </select>
                </div>
                <button type="submit" class="create-btn" style="width:100%;justify-content:center;">
                    Post Announcement
                </button>
            </form>
        </div>

        {{-- Active Announcements List --}}
        <div class="card card-dark">
            <h3 style="font-size:17px;font-weight:600;color:#fff;margin-bottom:18px;">Active Announcements</h3>
            <div style="display:flex;flex-direction:column;gap:14px;">
                @forelse($announcements as $announcement)
                    <div class="ann-card">
                        <div class="ann-card-header">
                            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;min-width:0;">
                                <span class="ann-type-badge"
                                    style="@if($announcement->type=='info') background:rgba(59,130,246,0.2);color:#3b82f6;
                                           @elseif($announcement->type=='success') background:rgba(16,185,129,0.2);color:#10b981;
                                           @elseif($announcement->type=='warning') background:rgba(249,115,22,0.2);color:#f97316;
                                           @elseif($announcement->type=='danger') background:rgba(239,68,68,0.2);color:#ef4444;
                                           @endif">
                                    {{ $announcement->type }}
                                </span>
                                <h4 style="font-weight:600;color:#fff;margin:0;font-size:14px;">{{ $announcement->title }}</h4>
                            </div>
                            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST"
                                  onsubmit="return confirm('Delete this announcement?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ann-delete-btn">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </div>
                        <p style="color:#94a3b8;font-size:14px;margin:0;line-height:1.5;">{{ $announcement->message }}</p>
                        <div style="margin-top:10px;font-size:12px;color:#64748b;">Posted {{ $announcement->created_at->diffForHumans() }}</div>
                    </div>
                @empty
                    <div style="text-align:center;padding:40px;color:#64748b;">No active announcements.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
