<x-app-layout>
    <div style="margin-bottom: 24px;">
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 700; color: #fff; margin-bottom: 8px;">Notifications</h2>
        <p style="color: #94a3b8; font-size: 14px;">Stay updated with the latest system announcements.</p>
    </div>

    <div class="card card-dark">
        <div style="display: flex; flex-direction: column; gap: 0;">
            @forelse($announcements as $announcement)
                <div style="padding: 24px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background 0.2s; display: flex; gap: 20px; align-items: start;">
                    
                    <div style="padding: 10px; border-radius: 12px; height: fit-content;
                        @if($announcement->type == 'info') background: rgba(59, 130, 246, 0.1); color: #3b82f6;
                        @elseif($announcement->type == 'success') background: rgba(16, 185, 129, 0.1); color: #10b981;
                        @elseif($announcement->type == 'warning') background: rgba(249, 115, 22, 0.1); color: #f97316;
                        @elseif($announcement->type == 'danger') background: rgba(239, 68, 68, 0.1); color: #ef4444;
                        @endif">
                        @if($announcement->type == 'info') <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        @elseif($announcement->type == 'success') <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        @elseif($announcement->type == 'warning') <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        @elseif($announcement->type == 'danger') <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        @endif
                    </div>

                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                            <h3 style="font-size: 18px; font-weight: 600; color: #fff; margin: 0;">{{ $announcement->title }}</h3>
                            <span style="font-size: 13px; color: #64748b;">{{ $announcement->created_at->format('M d, Y • h:i A') }}</span>
                        </div>
                        <p style="color: #94a3b8; font-size: 15px; line-height: 1.6; margin-bottom: 12px;">{{ $announcement->message }}</p>
                        <div style="font-size: 12px; color: #64748b;">Posted {{ $announcement->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            @empty
                <div style="padding: 60px; text-align: center; color: #64748b;">
                    <div style="margin-bottom: 16px; opacity: 0.5;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 01-3.46 0"></path><line x1="2" y1="2" x2="22" y2="22"></line></svg>
                    </div>
                    <div style="font-size: 16px;">No notifications found</div>
                </div>
            @endforelse
        </div>
        
        <div style="padding: 24px; border-top: 1px solid rgba(255, 255, 255, 0.05);">
            {{ $announcements->links() }}
        </div>
    </div>
</x-app-layout>
