@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('topbar-actions')
    <a href="{{ route('admin.file.create') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Upload Surat
    </a>
@endsection

@section('content')

{{-- ── BANNER PERINGATAN MASTER DATA ── --}}
@if(!$masterDataLengkap)
    <div style="background: linear-gradient(135deg, #fffbeb, #fef3c7); border: 1px solid #fcd34d; border-radius: 12px; padding: 16px 20px; margin-bottom: 22px; display: flex; align-items: center; gap: 16px;">
        <div style="font-size: 28px; flex-shrink: 0;">⚠️</div>
        <div style="flex: 1;">
            <div style="font-size: 14px; font-weight: 700; color: #92400e; margin-bottom: 4px;">Master Data Belum Lengkap</div>
            <div style="font-size: 12px; color: #78350f;">
                Sebelum upload surat, pastikan sudah mengisi:
                <span style="{{ $totalKsm > 0 ? 'color:#16a34a; font-weight:600;' : 'color:#dc2626; font-weight:600;' }}">
                    KSM {{ $totalKsm > 0 ? '✓' : '✗' }}
                </span> →
                <span style="{{ $totalSpesialis > 0 ? 'color:#16a34a; font-weight:600;' : 'color:#dc2626; font-weight:600;' }}">
                    Spesialis {{ $totalSpesialis > 0 ? '✓' : '✗' }}
                </span> →
                <span style="{{ $totalKategori > 0 ? 'color:#16a34a; font-weight:600;' : 'color:#dc2626; font-weight:600;' }}">
                    Kategori {{ $totalKategori > 0 ? '✓' : '✗' }}
                </span>
            </div>
        </div>
        <a href="{{ route('admin.settings') }}" class="btn btn-primary" style="flex-shrink:0; font-size:12px;">
            Setup Master Data →
        </a>
    </div>
@endif

{{-- ── STAT CARDS ── --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px;">

    {{-- Total Surat --}}
    <div style="background: linear-gradient(135deg, var(--teal-dark), var(--teal-mid)); border-radius: 12px; padding: 20px; color: #fff; position: relative; overflow: hidden;">
        <div style="position: absolute; right: -10px; top: -10px; width: 70px; height: 70px; background: rgba(255,255,255,0.07); border-radius: 50%;"></div>
        <div style="font-size: 32px; font-weight: 800; line-height: 1;">{{ $totalSurat }}</div>
        <div style="font-size: 12px; font-weight: 600; opacity: 0.7; margin-top: 4px;">Total Surat</div>
        <div style="margin-top: 14px;">
            <a href="{{ route('admin.file.index') }}" style="font-size: 11px; color: rgba(255,255,255,0.7); text-decoration: none; display: flex; align-items: center; gap: 4px;">
                Lihat semua
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>

    {{-- KSM --}}
    <div style="background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div style="width: 36px; height: 36px; background: var(--teal-pale); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            </div>
        </div>
        <div style="font-size: 28px; font-weight: 800; color: var(--text-dark); line-height: 1;">{{ $totalKsm }}</div>
        <div style="font-size: 12px; color: var(--text-light); margin-top: 4px; font-weight: 600;">KSM Terdaftar</div>
    </div>

    {{-- Spesialis --}}
    <div style="background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div style="width: 36px; height: 36px; background: #f0fdf4; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
        </div>
        <div style="font-size: 28px; font-weight: 800; color: var(--text-dark); line-height: 1;">{{ $totalSpesialis }}</div>
        <div style="font-size: 12px; color: var(--text-light); margin-top: 4px; font-weight: 600;">Spesialis</div>
    </div>

    {{-- Kategori --}}
    <div style="background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <div style="width: 36px; height: 36px; background: #fdf4ff; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#9333ea" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
            </div>
        </div>
        <div style="font-size: 28px; font-weight: 800; color: var(--text-dark); line-height: 1;">{{ $totalKategori }}</div>
        <div style="font-size: 12px; color: var(--text-light); margin-top: 4px; font-weight: 600;">Kategori Dokumen</div>
    </div>
</div>

{{-- ── ROW 2: DISTRIBUSI + RECENT ── --}}
<div style="display: grid; grid-template-columns: 1fr 1.6fr; gap: 18px; margin-bottom: 18px;">

    {{-- Distribusi per Kategori --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Distribusi per Kategori</div>
        </div>
        <div class="card-body" style="padding: 16px 20px;">
            @forelse($statsByCategory as $cat)
                @php
                    $pct = $totalSurat > 0 ? round(($cat->surats_count / $totalSurat) * 100) : 0;
                    $colors = [
                        'PPK'       => ['bar' => '#1e6374', 'bg' => '#e8f4f6', 'text' => '#1e6374'],
                        'CP'        => ['bar' => '#16a34a', 'bg' => '#f0fdf4', 'text' => '#16a34a'],
                        'SPO'       => ['bar' => '#9333ea', 'bg' => '#fdf4ff', 'text' => '#9333ea'],
                        'Algoritma' => ['bar' => '#d97706', 'bg' => '#fffbeb', 'text' => '#d97706'],
                    ];
                    $c = $colors[$cat->category_name] ?? ['bar' => '#64748b', 'bg' => '#f8fafc', 'text' => '#64748b'];
                @endphp
                <div style="margin-bottom: 14px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px;">
                        <div style="display: flex; align-items: center; gap: 7px;">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $c['bar'] }}; flex-shrink: 0;"></span>
                            <span style="font-size: 12px; font-weight: 600; color: var(--text-dark);">{{ $cat->category_name }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-size: 12px; font-weight: 700; color: {{ $c['text'] }};">{{ $cat->surats_count }}</span>
                            <span style="font-size: 10px; color: var(--text-light);">{{ $pct }}%</span>
                        </div>
                    </div>
                    <div style="height: 6px; background: {{ $c['bg'] }}; border-radius: 999px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $pct }}%; background: {{ $c['bar'] }}; border-radius: 999px; transition: width 0.6s ease;"></div>
                    </div>
                </div>
            @empty
                <p style="font-size: 12px; color: var(--text-light); text-align: center; padding: 20px 0;">Belum ada kategori</p>
            @endforelse
        </div>
    </div>

    {{-- Upload Terbaru --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Upload Terbaru</div>
            <a href="{{ route('admin.file.index') }}" style="font-size: 11px; color: var(--teal); text-decoration: none; font-weight: 600;">
                Lihat semua →
            </a>
        </div>
        @forelse($recentSurats as $surat)
            @php
                $catColors = [
                    'PPK'       => 'badge-teal',
                    'CP'        => 'badge-green',
                    'SPO'       => 'badge-purple',
                    'Algoritma' => 'badge-orange',
                ];
                $badgeClass = $catColors[$surat->category?->category_name] ?? 'badge-gray';
            @endphp
            <div style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; border-bottom: 1px solid #f0f5f6;">
                {{-- Icon --}}
                <div style="width: 36px; height: 36px; background: var(--teal-pale); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                {{-- Info --}}
                <div style="flex: 1; min-width: 0;">
                    <div style="font-size: 13px; font-weight: 600; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $surat->title }}
                    </div>
                    <div style="font-size: 11px; color: var(--text-light); margin-top: 2px;">
                        {{ $surat->spesialis?->ksm?->ksm_name }} — {{ $surat->spesialis?->spesialis_name }}
                    </div>
                </div>
                {{-- Badge + tanggal --}}
                <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 4px; flex-shrink: 0;">
                    <span class="badge {{ $badgeClass }}">{{ $surat->category?->category_name }}</span>
                    <span style="font-size: 10px; color: var(--text-light);">{{ $surat->created_at->diffForHumans() }}</span>
                </div>
            </div>
        @empty
            <div style="padding: 40px 20px; text-align: center; color: var(--text-light); font-size: 13px;">
                Belum ada surat yang diupload
            </div>
        @endforelse
    </div>
</div>

{{-- ── ROW 3: DISTRIBUSI PER KSM ── --}}
<div class="card">
    <div class="card-header">
        <div class="card-title">Distribusi per KSM</div>
        <a href="{{ route('admin.file.index') }}" style="font-size: 11px; color: var(--teal); text-decoration: none; font-weight: 600;">
            Kelola Surat →
        </a>
    </div>

    @if($statsByKsm->count() > 0)
        <div style="padding: 16px 20px; display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px;">
            @foreach($statsByKsm as $ksm)
                <div style="background: var(--teal-ghost); border: 1px solid var(--border); border-radius: 10px; padding: 14px 16px; display: flex; align-items: center; gap: 12px;">
                    <div style="width: 38px; height: 38px; background: var(--teal-dark); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 13px; font-weight: 800; color: rgba(255,255,255,0.9);">
                        {{ strtoupper(substr($ksm->ksm_name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-size: 13px; font-weight: 700; color: var(--text-dark);">{{ $ksm->ksm_name }}</div>
                        <div style="font-size: 11px; color: var(--text-light); margin-top: 2px;">
                            {{ $ksm->surat_count ?? 0 }} surat
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="padding: 40px 20px; text-align: center; color: var(--text-light); font-size: 13px;">
            Belum ada data KSM. <a href="{{ route('admin.settings') }}" style="color: var(--teal); font-weight: 600;">Setup master data →</a>
        </div>
    @endif
</div>

{{-- ── QUICK ACTIONS ── --}}
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-top: 18px;">
    <a href="{{ route('admin.file.create') }}"
       style="background: #fff; border: 1.5px dashed var(--border); border-radius: 12px; padding: 20px; text-align: center; text-decoration: none; transition: all 0.15s; display: block;"
       onmouseover="this.style.borderColor='var(--teal)'; this.style.background='var(--teal-ghost)'"
       onmouseout="this.style.borderColor='var(--border)'; this.style.background='#fff'">
        <div style="width: 40px; height: 40px; background: var(--teal-pale); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
        </div>
        <div style="font-size: 13px; font-weight: 700; color: var(--text-dark);">Upload Surat</div>
        <div style="font-size: 11px; color: var(--text-light); margin-top: 3px;">Tambah dokumen baru</div>
    </a>

    <a href="{{ route('admin.file.index') }}"
       style="background: #fff; border: 1.5px dashed var(--border); border-radius: 12px; padding: 20px; text-align: center; text-decoration: none; transition: all 0.15s; display: block;"
       onmouseover="this.style.borderColor='var(--teal)'; this.style.background='var(--teal-ghost)'"
       onmouseout="this.style.borderColor='var(--border)'; this.style.background='#fff'">
        <div style="width: 40px; height: 40px; background: var(--teal-pale); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        </div>
        <div style="font-size: 13px; font-weight: 700; color: var(--text-dark);">Kelola Surat</div>
        <div style="font-size: 11px; color: var(--text-light); margin-top: 3px;">Lihat & edit semua surat</div>
    </a>

    <a href="{{ route('admin.settings') }}"
       style="background: #fff; border: 1.5px dashed var(--border); border-radius: 12px; padding: 20px; text-align: center; text-decoration: none; transition: all 0.15s; display: block;"
       onmouseover="this.style.borderColor='var(--teal)'; this.style.background='var(--teal-ghost)'"
       onmouseout="this.style.borderColor='var(--border)'; this.style.background='#fff'">
        <div style="width: 40px; height: 40px; background: var(--teal-pale); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--teal)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 1 0 4.93 19.07 10 10 0 0 0 19.07 4.93z"/></svg>
        </div>
        <div style="font-size: 13px; font-weight: 700; color: var(--text-dark);">Master Data</div>
        <div style="font-size: 11px; color: var(--text-light); margin-top: 3px;">KSM, Spesialis, Kategori</div>
    </a>
</div>

@endsection