<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Rumah Sakit UII</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --teal-dark:  #1a4a52;
            --teal:       #1e6374;
            --teal-mid:   #2a7f8f;
            --teal-light: #3a9aab;
            --teal-pale:  #e8f4f6;
            --teal-ghost: #f0f8fa;
            --accent:     #00c9b1;
            --text-dark:  #1a2e35;
            --text-mid:   #4a6470;
            --text-light: #8aa5ae;
            --border:     #d0e8ec;
            --white:      #ffffff;
            --danger:     #e53e3e;
            --danger-light: #fff5f5;
            --success:    #38a169;
            --success-light: #f0fff4;
            --warning:    #d69e2e;
            --sidebar-w:  240px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f4f5;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--teal-dark);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand .brand-icon {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
        }

        .sidebar-brand .brand-icon svg { color: var(--teal-dark); }

        .sidebar-brand h1 {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            line-height: 1.3;
        }

        .sidebar-brand p {
            font-size: 10px;
            color: rgba(255,255,255,0.5);
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255,255,255,0.35);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0 8px;
            margin: 16px 0 6px;
        }

        .nav-section-label:first-child { margin-top: 0; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.15s;
            margin-bottom: 2px;
        }

        .nav-link:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .nav-link.active { background: rgba(255,255,255,0.15); color: #fff; }

        .nav-link svg { flex-shrink: 0; opacity: 0.7; }
        .nav-link.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .user-avatar {
            width: 32px; height: 32px;
            background: var(--teal-mid);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .user-name { font-size: 12px; font-weight: 600; color: #fff; }
        .user-role { font-size: 10px; color: rgba(255,255,255,0.45); }

        .btn-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px;
            background: rgba(229,62,62,0.15);
            color: #fc8181;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
            font-family: inherit;
        }

        .btn-logout:hover { background: rgba(229,62,62,0.25); }

        /* ── MAIN CONTENT ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 0 28px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .content-area {
            padding: 28px;
            flex: 1;
        }

        /* ── ALERT ── */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success { background: var(--success-light); color: var(--success); border: 1px solid #c6f6d5; }
        .alert-error   { background: var(--danger-light);  color: var(--danger);  border: 1px solid #fed7d7; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.15s;
            font-family: inherit;
        }

        .btn-primary   { background: var(--teal); color: #fff; }
        .btn-primary:hover { background: var(--teal-mid); }
        .btn-outline   { background: transparent; color: var(--teal); border: 1.5px solid var(--teal); }
        .btn-outline:hover { background: var(--teal-pale); }
        .btn-danger    { background: transparent; color: var(--danger); border: 1.5px solid var(--danger); }
        .btn-danger:hover { background: var(--danger-light); }
        .btn-sm { padding: 6px 11px; font-size: 12px; }
        .btn-xs { padding: 4px 9px; font-size: 11px; border-radius: 6px; }

        /* ── CARDS ── */
        .card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .card-body { padding: 20px; }

        /* ── FORM ── */
        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 12px; font-weight: 600; color: var(--text-mid); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.04em; }
        .form-control {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            color: var(--text-dark);
            background: #fff;
            transition: border-color 0.15s;
            outline: none;
        }
        .form-control:focus { border-color: var(--teal-mid); }
        .form-control.error { border-color: var(--danger); }
        .form-error { font-size: 11px; color: var(--danger); margin-top: 4px; }

        /* ── TABLE ── */
        .table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .table th { padding: 10px 14px; text-align: left; font-size: 11px; font-weight: 600; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border); }
        .table td { padding: 12px 14px; border-bottom: 1px solid #f0f4f5; vertical-align: middle; }
        .table tr:last-child td { border-bottom: none; }
        .table tr:hover td { background: var(--teal-ghost); }

        /* ── BADGE ── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-teal   { background: var(--teal-pale);   color: var(--teal); }
        .badge-green  { background: #f0fff4; color: #276749; }
        .badge-purple { background: #faf5ff; color: #6b46c1; }
        .badge-orange { background: #fffaf0; color: #c05621; }
        .badge-gray   { background: #f7fafc; color: #4a5568; }

        /* ── MODAL ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open { display: flex; }

        .modal {
            background: #fff;
            border-radius: 14px;
            width: 100%;
            max-width: 460px;
            margin: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .modal-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title { font-size: 15px; font-weight: 700; }

        .modal-close {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-light);
            padding: 4px;
            border-radius: 6px;
            transition: background 0.15s;
        }

        .modal-close:hover { background: #f0f4f5; }

        .modal-body { padding: 20px 24px; }

        .modal-footer {
            padding: 16px 24px;
            background: #f8fafc;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.38 2 2 0 0 1 3.58 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        </div>
        <h1>Rumah Sakit UII</h1>
        <p>Sistem Surat Klinis</p>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>

        <a href="{{ route('admin.surat.index') }}"
           class="nav-link {{ request()->routeIs('admin.surat.*') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
            Kelola Surat
        </a>

        <a href="{{ route('admin.surat.create') }}"
           class="nav-link {{ request()->routeIs('admin.surat.create') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
            Upload Surat
        </a>

        <div class="nav-section-label">Pengaturan</div>

        <a href="{{ route('admin.settings') }}"
           class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 1 0 4.93 19.07 10 10 0 0 0 19.07 4.93z"/></svg>
            Master Data
        </a>

        <a href="{{ route('public.surat.index') }}" target="_blank" class="nav-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Lihat Halaman Publik
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<main class="main">
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="topbar-right">
            @yield('topbar-actions')
        </div>
    </div>

    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

@stack('scripts')

<script>
function openModal(id) {
    document.getElementById(id).classList.add('open');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('open');
}

// Close modal when clicking overlay
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
        if (e.target === this) closeModal(this.id);
    });
});
</script>

</body>
</html>