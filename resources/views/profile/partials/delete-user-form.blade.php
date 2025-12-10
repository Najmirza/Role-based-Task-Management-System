<section>
    <header class="section-header">
        <h2 class="section-title" style="color: #f87171;">Delete Account</h2>
        <p class="section-desc">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-submit"
        style="width: auto; padding: 12px 32px; background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3);"
    >Delete Account</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 40px;">
            @csrf
            @method('delete')

            <h2 style="font-family: var(--font-display); font-size: 24px; font-weight: 700; color: #f8fafc; margin-bottom: 16px;">
                Are you sure you want to delete your account?
            </h2>

            <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password"
                    >
                    <div class="input-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </div>
                </div>
                @error('password', 'userDeletion')
                    <span style="color: #f87171; font-size: 13px; margin-top: 8px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" x-on:click="$dispatch('close')" class="btn-submit" style="width: auto; padding: 12px 24px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                    Cancel
                </button>

                <button type="submit" class="btn-submit" style="width: auto; padding: 12px 24px; background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3);">
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>
