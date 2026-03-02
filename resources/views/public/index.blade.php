<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Surat Klinis — Rumah Sakit UII</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --teal-dark:   #1a4a52;
            --teal:        #1e6374;
            --teal-mid:    #2a7f8f;
            --teal-light:  #3a9aab;
            --teal-pale:   #e8f4f6;
            --teal-ghost:  #f4fafb;
            --accent:      #00c9b1;
            --text-dark:   #1a2e35;
            --text-mid:    #4a6470;
            --text-light:  #8aa5ae;
            --border:      #d0e8ec;
            --bg:          #eef3f5;
            --white:       #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* ─── HEADER ─── */
        .header {
            background: linear-gradient(135deg, var(--teal-dark) 0%, var(--teal-mid) 100%);
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 20px rgba(0,0,0,0.15);
        }

        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        .brand-text h1 {
            font-size: 17px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.01em;
        }

        .brand-text p {
            font-size: 11px;
            color: rgba(255,255,255,0.55);
            margin-top: 1px;
        }

        .header-stats {
            display: flex;
            gap: 6px;
        }

        .stat-pill {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            padding: 8px 16px;
            min-width: 60px;
            backdrop-filter: blur(8px);
            transition: background 0.2s;
        }

        .stat-pill:hover { background: rgba(255,255,255,0.18); }

        .stat-pill .num {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .stat-pill .lbl {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255,255,255,0.6);
            margin-top: 2px;
        }

        /* ─── FILTER BAR ─── */
        .filter-bar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 40px;
            position: sticky;
            top: 72px;
            z-index: 90;
            box-shadow: 0 1px 8px rgba(0,0,0,0.04);
        }

        .filter-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            height: 56px;
        }

        .ksm-tabs {
            display: flex;
            gap: 4px;
            align-items: center;
            flex: 1;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .ksm-tabs::-webkit-scrollbar { display: none; }

        .ksm-tab {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.15s;
            color: var(--text-mid);
            background: transparent;
            border: 1.5px solid transparent;
        }

        .ksm-tab:hover {
            background: var(--teal-pale);
            color: var(--teal);
        }

        .ksm-tab.active {
            background: var(--teal-dark);
            color: #fff;
            border-color: var(--teal-dark);
        }

        .search-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .search-wrap svg {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            pointer-events: none;
        }

        .search-input {
            padding: 8px 12px 8px 34px;
            border: 1.5px solid var(--border);
            border-radius: 999px;
            font-size: 12px;
            font-family: inherit;
            color: var(--text-dark);
            background: var(--bg);
            outline: none;
            width: 200px;
            transition: border-color 0.15s, width 0.2s;
        }

        .search-input:focus {
            border-color: var(--teal-mid);
            width: 240px;
        }

        /* ─── MAIN ─── */
        .main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 28px 40px 60px;
        }

        /* ─── KSM SECTION ─── */
        .ksm-section {
            margin-bottom: 20px;
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 1px 6px rgba(0,0,0,0.04);
        }

        .ksm-header {
            background: var(--teal-dark);
            padding: 14px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .ksm-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ksm-name {
            font-size: 13px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .ksm-badges {
            display: flex;
            gap: 8px;
        }

        .ksm-badge {
            font-size: 10px;
            color: rgba(255,255,255,0.65);
            font-weight: 600;
        }

        /* ─── TABLE ─── */
        .doc-table {
            width: 100%;
            border-collapse: collapse;
        }

        .doc-table-head {
            display: grid;
            padding: 9px 22px;
            background: #f6fafb;
            border-bottom: 1px solid var(--border);
        }

        .doc-table-head span {
            font-size: 10px;
            font-weight: 700;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* Grid columns will be set inline based on number of categories */

        .spesialis-row {
            border-bottom: 1px solid #f0f5f6;
        }

        .spesialis-row:last-child { border-bottom: none; }

        .spesialis-inner {
            display: grid;
            padding: 14px 22px;
            align-items: start;
            gap: 8px;
        }

        .spesialis-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--teal);
            padding-top: 3px;
        }

        /* ─── DOC ITEMS ─── */
        .doc-list {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .doc-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--teal-ghost);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 7px 10px;
            transition: all 0.15s;
            text-decoration: none;
        }

        .doc-item:hover {
            background: var(--teal-pale);
            border-color: var(--teal-light);
            transform: translateX(2px);
        }

        .doc-num {
            width: 20px;
            height: 20px;
            background: var(--teal-dark);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .doc-title {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-dark);
            flex: 1;
            line-height: 1.35;
        }

        .doc-download {
            flex-shrink: 0;
            color: var(--text-light);
            opacity: 0;
            transition: opacity 0.15s, color 0.15s;
        }

        .doc-item:hover .doc-download {
            opacity: 1;
            color: var(--teal);
        }

        .doc-empty {
            font-size: 12px;
            color: var(--text-light);
            font-style: italic;
            padding: 2px 0;
        }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--border);
        }

        .empty-state svg { margin: 0 auto 16px; display: block; }
        .empty-state h3 { font-size: 16px; font-weight: 700; color: var(--text-mid); margin-bottom: 6px; }
        .empty-state p  { font-size: 13px; color: var(--text-light); }

        /* ─── FOOTER TOTAL ─── */
        .footer-total {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--border);
            padding: 16px 24px;
            text-align: right;
            margin-top: 8px;
        }

        .footer-total span {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* ─── SITE FOOTER ─── */
        .site-footer {
            text-align: center;
            padding: 32px 20px;
            font-size: 12px;
            color: var(--text-light);
            line-height: 1.8;
        }

        .site-footer .status-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #38a169;
            margin-right: 5px;
            vertical-align: middle;
        }

        /* ─── ADMIN LINK ─── */
        .admin-link {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: var(--teal-dark);
            color: rgba(255,255,255,0.7);
            border: none;
            border-radius: 10px;
            padding: 9px 14px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s;
            font-family: inherit;
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        }

        .admin-link:hover { background: var(--teal); color: #fff; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .header, .filter-bar { padding: 0 16px; }
            .main { padding: 16px 16px 60px; }
            .header-stats { display: none; }
            .spesialis-inner { grid-template-columns: 1fr !important; }
            .doc-table-head { display: none; }
            .brand-text p { display: none; }
        }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════════ --}}
{{-- HEADER --}}
{{-- ═══════════════════════════════════════════ --}}
<header class="header">
    <div class="header-inner">
        <div class="brand">
            <div class="brand-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.38 2 2 0 0 1 3.58 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
            </div>
            <div class="brand-text">
                <h1>Rumah Sakit UII</h1>
                <p>Manajemen PPK, Clinical Pathway, SPO & Algoritma</p>
            </div>
        </div>

        <div class="header-stats">
            @foreach($stats as $stat)
                <div class="stat-pill">
                    <span class="num">{{ $stat->files_count }}</span>
                    <span class="lbl">{{ $stat->category_name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</header>

{{-- ═══════════════════════════════════════════ --}}
{{-- FILTER BAR --}}
{{-- ═══════════════════════════════════════════ --}}
<div class="filter-bar">
    <div class="filter-inner">
        <div class="ksm-tabs">
            {{-- Semua KSM --}}
            <a href="{{ route('public.files.index') }}"
               class="ksm-tab {{ !request('ksm_id') && !request('search') ? 'active' : '' }}">
                Semua KSM
            </a>

            {{-- Per KSM --}}
            @foreach($ksms as $ksm)
                <a href="{{ route('public.files.index', ['ksm_id' => $ksm->id]) }}"
                   class="ksm-tab {{ request('ksm_id') == $ksm->id ? 'active' : '' }}">
                    {{ $ksm->ksm_name }}
                </a>
            @endforeach
        </div>

        <div class="search-wrap">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <form method="GET" action="{{ route('public.files.index') }}" style="display:inline;">
                @if(request('ksm_id'))
                    <input type="hidden" name="ksm_id" value="{{ request('ksm_id') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}"
                       class="search-input" placeholder="Cari dokumen...">
            </form>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════ --}}
{{-- MAIN CONTENT --}}
{{-- ═══════════════════════════════════════════ --}}
<main class="main">

    @php
        $categoryNames = $categories->pluck('category_name');
        $catCount = $categoryNames->count();
        // Grid: 160px untuk spesialis + 1fr per kategori
        $gridCols = '160px ' . implode(' ', array_fill(0, $catCount, '1fr'));
    @endphp

    @forelse($grouped as $ksmName => $spesialisList)
        @php
            $ksmFiles = $spesialisList->flatten();
            $ksmByCategory = $ksmFiles->groupBy('category.category_name');
        @endphp

        <section class="ksm-section">
            {{-- KSM Header --}}
            <div class="ksm-header">
                <div class="ksm-header-left">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    <span class="ksm-name">KSM {{ $ksmName }}</span>
                </div>
                <div class="ksm-badges">
                    @foreach($categoryNames as $catName)
                        @if(isset($ksmByCategory[$catName]) && $ksmByCategory[$catName]->count() > 0)
                            <span class="ksm-badge">
                                Total {{ $ksmByCategory[$catName]->count() }} {{ $catName }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Table Head --}}
            <div class="doc-table-head" style="grid-template-columns: {{ $gridCols }};">
                <span>Spesialis</span>
                @foreach($categoryNames as $catName)
                    <span>{{ $catName }}</span>
                @endforeach
            </div>

            {{-- Spesialis Rows --}}
            @foreach($spesialisList as $spesialisName => $files)
                @php
                    $byCategory = $files->groupBy('category.category_name');
                @endphp
                <div class="spesialis-row">
                    <div class="spesialis-inner" style="grid-template-columns: {{ $gridCols }};">
                        {{-- Spesialis Name --}}
                        <div class="spesialis-label">{{ $spesialisName }}</div>

                        {{-- Docs per Category --}}
                        @foreach($categoryNames as $catName)
                            <div>
                                @if(isset($byCategory[$catName]) && $byCategory[$catName]->count() > 0)
                                    <div class="doc-list">
                                        @foreach($byCategory[$catName] as $i => $surat)
                                            <a href="{{ route('public.surat.download', $surat) }}"
                                               class="doc-item" title="Download {{ $surat->title }}">
                                                <span class="doc-num">{{ $i + 1 }}</span>
                                                <span class="doc-title">{{ $surat->title }}</span>
                                                <span class="doc-download">
                                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="doc-empty">—</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>

    @empty
        <div class="empty-state">
            <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="#d0e8ec" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            @if(request()->hasAny(['search','ksm_id','category_id']))
                <h3>Dokumen tidak ditemukan</h3>
                <p>Coba ubah kata kunci atau filter pencarian Anda.</p>
                <a href="{{ route('public.files.index') }}"
                   style="display:inline-flex; align-items:center; gap:6px; margin-top:16px; color:var(--teal); font-size:13px; font-weight:600; text-decoration:none;">
                    ← Lihat semua dokumen
                </a>
            @else
                <h3>Belum ada dokumen klinis</h3>
                <p>Dokumen akan ditampilkan di sini setelah admin melakukan upload.</p>
            @endif
        </div>
    @endforelse

    {{-- ─── TOTAL FOOTER ─── --}}
    @if($grouped->count() > 0)
        <div class="footer-total">
            <span>
                TOTAL KESELURUHAN:
                @foreach($stats as $stat)
                    {{ $stat->files_count }} {{ $stat->category_name }}{{ !$loop->last ? ' | ' : '' }}
                @endforeach
            </span>
        </div>
    @endif

</main>

{{-- ─── SITE FOOTER ─── --}}
<footer class="site-footer">
    <div>© {{ date('Y') }} Rumah Sakit UII — Sistem Manajemen Dokumen Klinis</div>
    <div>Terakhir diperbarui: {{ \App\Models\Surat::latest()->first()?->updated_at?->translatedFormat('d F Y') ?? '-' }}</div>
    <div>
        <span class="status-dot"></span>
        Semua dokumen sudah berjalan, menunggu pengesahan RS
    </div>
</footer>

{{-- ─── ADMIN LINK ─── --}}
@guest
    <a href="{{ route('login') }}" class="admin-link">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Admin
    </a>
@endguest

@auth
    <a href="{{ route('admin.dashboard') }}" class="admin-link">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Dashboard Admin
    </a>
@endauth

</body>
</html>