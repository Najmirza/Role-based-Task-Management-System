<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>403 — Access Restricted</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:   #6366f1;
            --accent:    #a855f7;
            --danger:    #ef4444;
            --bg-dark:   #0f172a;
            --surface:   rgba(255,255,255,0.04);
            --border:    rgba(255,255,255,0.08);
            --text-muted:#94a3b8;
        }

        body {
            min-height: 100vh;
            background: var(--bg-dark);
            font-family: 'Inter', sans-serif;
            color: #f1f5f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            padding: 24px;
            background-image:
                radial-gradient(at 20% 20%, rgba(99,102,241,0.15) 0px, transparent 50%),
                radial-gradient(at 80% 0%,  rgba(168,85,247,0.12) 0px, transparent 50%),
                radial-gradient(at 80% 80%, rgba(239,68,68,0.08)  0px, transparent 50%);
        }

        /* Floating blobs */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            pointer-events: none;
            z-index: 0;
            animation: float 20s infinite ease-in-out;
        }
        .blob-1 { width: 380px; height: 380px; background: #4f46e5; top: -120px; left: -120px; }
        .blob-2 { width: 280px; height: 280px; background: #7c3aed; bottom: -80px; right: -80px; animation-delay: -7s; }

        @keyframes float {
            0%, 100% { transform: translate(0,0); }
            50%       { transform: translate(20px, -20px) scale(1.04); }
        }

        /* ──────────────────────────────────
           TOP HEADER BAR
        ────────────────────────────────── */
        .top-bar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 60px;
            background: rgba(15,23,42,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 100;
        }

        .top-bar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-box {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
        }

        .brand-name {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 17px;
            color: #fff;
        }

        .top-bar-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border);
        }
        .btn-ghost:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
            border-color: rgba(255,255,255,0.16);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            box-shadow: 0 4px 16px rgba(99,102,241,0.3);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(99,102,241,0.45);
        }

        /* ──────────────────────────────────
           MAIN CARD
        ────────────────────────────────── */
        .error-card {
            position: relative;
            z-index: 10;
            margin-top: 60px; /* offset for fixed header */
            width: 100%;
            max-width: 520px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 52px 44px 44px;
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow:
                0 32px 64px rgba(0,0,0,0.4),
                inset 0 1px 0 rgba(255,255,255,0.07);
            text-align: center;
            animation: slideUp 0.5s cubic-bezier(0.4,0,0.2,1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(32px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Shield icon */
        .shield-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            margin-bottom: 28px;
            position: relative;
            animation: pulse-ring 3s infinite;
        }

        @keyframes pulse-ring {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.2); }
            50%       { box-shadow: 0 0 0 14px rgba(239,68,68,0.0); }
        }

        .shield-wrap svg {
            animation: shield-shake 4s ease-in-out infinite;
        }

        @keyframes shield-shake {
            0%, 90%, 100%       { transform: rotate(0deg); }
            92%                  { transform: rotate(-6deg); }
            96%                  { transform: rotate(6deg); }
        }

        /* Error code badge */
        .error-code {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #ef4444;
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 50px;
            padding: 5px 14px;
            margin-bottom: 18px;
        }

        .error-title {
            font-family: 'Outfit', sans-serif;
            font-size: 30px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 14px;
            line-height: 1.2;
        }

        .error-desc {
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 32px;
        }

        /* Admin-only info box */
        .admin-notice {
            background: rgba(99,102,241,0.08);
            border: 1px solid rgba(99,102,241,0.2);
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 36px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            text-align: left;
        }

        .admin-notice-icon {
            color: var(--primary);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .admin-notice-text {
            font-size: 13px;
            color: #c4b5fd;
            line-height: 1.6;
        }

        .admin-notice-text strong {
            color: #fff;
            font-weight: 600;
        }

        /* Action buttons */
        .action-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .action-group .btn {
            width: 100%;
            justify-content: center;
            padding: 13px 20px;
            font-size: 15px;
            border-radius: 12px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #475569;
            font-size: 12px;
            margin: 4px 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* Responsive */
        @media (max-width: 540px) {
            .error-card {
                padding: 40px 24px 32px;
                border-radius: 22px;
            }
            .error-title { font-size: 24px; }
            .top-bar { padding: 0 16px; }
            .brand-name { display: none; }
        }
    </style>
</head>
<body>

    <!-- Blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- ═══════════ TOP HEADER ═══════════ -->
    <header class="top-bar">
        <!-- Brand -->
        <a href="{{ url('/dashboard') }}" class="top-bar-brand">
            <div class="logo-box">MN</div>
            <span class="brand-name">Task System</span>
        </a>

        <!-- Back actions -->
        <div class="top-bar-actions">
            <a href="javascript:history.back()" class="btn btn-ghost">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                </svg>
                Go Back
            </a>
            <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
        </div>
    </header>

    <!-- ═══════════ ERROR CARD ═══════════ -->
    <div class="error-card">

        <!-- Shield icon -->
        <div class="shield-wrap">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <circle cx="12" cy="15" r="0.5" fill="#ef4444"/>
            </svg>
        </div>

        <!-- Badge -->
        <div class="error-code">403 — Access Forbidden</div>

        <!-- Title -->
        <h1 class="error-title">Admin Action Only</h1>

        <!-- Description -->
        <p class="error-desc">
            You don't have permission to perform this action.
            This feature is restricted to <strong style="color:#fff;">administrators</strong> only.
        </p>

        <!-- Admin notice box -->
        <div class="admin-notice">
            <div class="admin-notice-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="12"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
            </div>
            <div class="admin-notice-text">
                <strong>Why am I seeing this?</strong><br>
                Actions like creating projects, assigning tasks to others, managing teams, or changing system settings require an <strong>Admin</strong> role. If you believe you should have access, please contact your administrator.
            </div>
        </div>

        <!-- Action buttons -->
        <div class="action-group">
            <a href="javascript:history.back()" class="btn btn-primary">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                </svg>
                Go Back
            </a>

            <div class="divider">or</div>

            <a href="{{ url('/dashboard') }}" class="btn btn-ghost">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Return to Dashboard
            </a>
        </div>
    </div>

</body>
</html>
