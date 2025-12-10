<section>
    <header class="section-header">
        <h2 class="section-title">Update Password</h2>
        <p class="section-desc">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="input-group">
            <label for="update_password_current_password">Current Password</label>
            <div class="input-wrapper">
                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
                <div class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
            </div>
            @error('current_password', 'updatePassword')
                <span style="color: #f87171; font-size: 13px; margin-top: 8px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group" style="margin-top: 20px;">
            <label for="update_password_password">New Password</label>
            <div class="input-wrapper">
                <input id="update_password_password" name="password" type="password" autocomplete="new-password">
                <div class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
            </div>
            @error('password', 'updatePassword')
                <span style="color: #f87171; font-size: 13px; margin-top: 8px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group" style="margin-top: 20px;">
            <label for="update_password_password_confirmation">Confirm Password</label>
            <div class="input-wrapper">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                <div class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>
            </div>
            @error('password_confirmation', 'updatePassword')
                <span style="color: #f87171; font-size: 13px; margin-top: 8px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-top: 24px; display: flex; align-items: center; gap: 16px;">
            <button type="submit" class="btn-submit" style="width: auto; padding: 12px 32px;">Save</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    style="color: #10b981; font-size: 14px;"
                >Saved.</p>
            @endif
        </div>
    </form>
</section>
