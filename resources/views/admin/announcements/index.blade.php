<x-app-layout>
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; font-size: 14px; margin-bottom: 16px; transition: color 0.2s;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Dashboard
        </a>
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 700; color: #fff; margin-bottom: 8px;">Global Announcements</h2>
        <p style="color: #94a3b8; font-size: 14px;">Post messages to all users in the system.</p>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">
        <!-- Create Form -->
        <div class="card card-dark" style="height: fit-content;">
            <h3 style="font-size: 18px; font-weight: 600; color: #fff; margin-bottom: 20px;">Post New Announcement</h3>
            <form action="{{ route('admin.announcements.store') }}" method="POST">
                @csrf
                
                <div style="margin-bottom: 16px;">
                    <label style="display: block; color: #94a3b8; margin-bottom: 8px; font-size: 13px;">Title</label>
                    <input type="text" name="title" required
                        style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 10px; color: #fff;">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; color: #94a3b8; margin-bottom: 8px; font-size: 13px;">Message</label>
                    <textarea name="message" rows="3" required
                        style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 10px; color: #fff;"></textarea>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; color: #94a3b8; margin-bottom: 8px; font-size: 13px;">Type</label>
                    <select name="type" style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 10px; color: #fff;">
                        <option value="info" style="background: #1e293b; color: #fff;">Info (Blue)</option>
                        <option value="success" style="background: #1e293b; color: #fff;">Success (Green)</option>
                        <option value="warning" style="background: #1e293b; color: #fff;">Warning (Orange)</option>
                        <option value="danger" style="background: #1e293b; color: #fff;">Danger (Red)</option>
                    </select>
                </div>

                <button type="submit" class="create-btn" style="width: 100%; justify-content: center;">
                    Post Announcement
                </button>
            </form>
        </div>

        <!-- List -->
        <div class="card card-dark">
            <h3 style="font-size: 18px; font-weight: 600; color: #fff; margin-bottom: 20px;">Active Announcements</h3>
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                @forelse($announcements as $announcement)
                    <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 12px; font-weight: 700; padding: 4px 8px; border-radius: 4px; text-transform: uppercase;
                                    @if($announcement->type == 'info') background: rgba(59, 130, 246, 0.2); color: #3b82f6;
                                    @elseif($announcement->type == 'success') background: rgba(16, 185, 129, 0.2); color: #10b981;
                                    @elseif($announcement->type == 'warning') background: rgba(249, 115, 22, 0.2); color: #f97316;
                                    @elseif($announcement->type == 'danger') background: rgba(239, 68, 68, 0.2); color: #ef4444;
                                    @endif">
                                    {{ $announcement->type }}
                                </span>
                                <h4 style="font-weight: 600; color: #fff; margin: 0;">{{ $announcement->title }}</h4>
                            </div>
                            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Delete this announcement?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #64748b; cursor: pointer; padding: 4px;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"></path></svg>
                                </button>
                            </form>
                        </div>
                        <p style="color: #94a3b8; font-size: 14px; margin: 0;">{{ $announcement->message }}</p>
                        <div style="margin-top: 12px; font-size: 12px; color: #64748b;">Posted {{ $announcement->created_at->diffForHumans() }}</div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px; color: #64748b;">No active announcements.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
