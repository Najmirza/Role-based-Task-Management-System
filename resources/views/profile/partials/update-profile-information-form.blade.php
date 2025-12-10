<section>
    <header class="section-header">
        <h2 class="section-title">Profile Information</h2>
        <p class="section-desc">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="input-group">
            <label for="name">Name</label>
            <div class="input-wrapper">
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                <div class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
            </div>
            @error('name')
                <span style="color: #f87171; font-size: 13px; margin-top: 8px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group" style="margin-top: 20px;">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                <div class="input-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                </div>
            </div>
            @error('email')
                <span style="color: #f87171; font-size: 13px; margin-top: 8px; display: block;">{{ $message }}</span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: 16px; padding: 12px; background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.2); border-radius: 8px;">
                    <p style="color: #fbbf24; font-size: 13px;">
                        Your email address is unverified.
                        <button form="send-verification" style="color: #fbbf24; text-decoration: underline; background: none; border: none; cursor: pointer; padding: 0; font-size: 13px;">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top: 8px; font-weight: 500; font-size: 13px; color: #10b981;">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="margin-top: 24px; display: flex; align-items: center; gap: 16px;">
            <button type="submit" class="btn-submit" style="width: auto; padding: 12px 32px;">Save</button>

            @if (session('status') === 'profile-updated')
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
