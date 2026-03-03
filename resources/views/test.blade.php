<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Surat Klinis — Rumah Sakit UII</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen">

<header class="sticky top-0 z-[100] bg-blue-800 px-6 shadow-md border-b border-blue-900">
    <div class="max-w-7xl mx-auto flex items-center justify-between h-[72px]">
        <div class="flex items-center gap-4">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[22px] h-[22px]">
            </div>
            <div class="text-white">
                <h1 class="text-lg font-extrabold leading-tight tracking-tight">Dokumen Klinis Rumah Sakit UII</h1>
                <p class="text-[11px] text-blue-200/70 font-medium">Sistem Manajemen Dokumen Terintegrasi</p>
            </div>
        </div>

        <div class="hidden md:flex gap-2">
            @foreach($stats as $stat)
                <div class="flex flex-col items-center bg-blue-900/40 border border-white/10 backdrop-blur-sm rounded-xl px-4 py-2 min-w-[75px] hover:bg-blue-900/60 transition-colors">
                    <span class="text-xl font-extrabold text-white leading-none">{{ $stat->files_count }}</span>
                    <span class="text-[10px] font-bold text-blue-200/60 mt-1 uppercase">{{ $stat->category_name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</header>

<nav class="sticky top-[72px] z-[90] bg-white border-b border-slate-200 px-6 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 h-14">
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar flex-1 py-2">
            <a href="{{ route('public.files.index') }}" 
               class="px-4 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap transition-all 
               {{ !request('ksm_id') ? 'bg-blue-800 text-white shadow-md shadow-blue-800/20' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-800' }}">
               Semua KSM
            </a>
            @foreach($ksms as $ksm)
                <a href="{{ route('public.files.index', ['ksm_id' => $ksm->id]) }}" 
                   class="px-4 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap transition-all
                   {{ request('ksm_id') == $ksm->id ? 'bg-blue-800 text-white shadow-md shadow-blue-800/20' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-800' }}">
                    {{ $ksm->ksm_name }}
                </a>
            @endforeach
        </div>

        <div class="relative shrink-0">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <form method="GET" action="{{ route('public.files.index') }}">
                @if(request('ksm_id')) <input type="hidden" name="ksm_id" value="{{ request('ksm_id') }}"> @endif
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="pl-9 pr-4 py-2 bg-slate-100 border border-slate-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-blue-800 focus:bg-white w-48 transition-all focus:w-64 shadow-inner" 
                       placeholder="Cari dokumen...">
            </form>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-6 py-8 pb-20">
    @php
        $categoryNames = $categories->pluck('category_name');
        $gridStyle = "grid-template-columns: 220px repeat(" . $categoryNames->count() . ", 1fr);";
    @endphp

    @forelse($grouped as $ksmName => $spesialisList)
        @php
            $ksmFiles = $spesialisList->flatten();
            $ksmByCategory = $ksmFiles->groupBy('category.category_name');
        @endphp

        <section class="mb-10 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden border-t-4 border-t-blue-800">
            <div class="bg-blue-800 px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-3 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <span class="text-white font-extrabold text-sm tracking-wide uppercase">KSM {{ $ksmName }}</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($categoryNames as $catName)
                        @if(isset($ksmByCategory[$catName]))
                            <span class="text-[10px] bg-blue-50 text-blue-800 px-3 py-1 rounded-full font-bold uppercase border border-blue-100 shadow-sm">
                                {{ $ksmByCategory[$catName]->count() }} {{ $catName }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="hidden lg:grid bg-slate-50 border-b border-slate-200 px-6 py-3" style="{{ $gridStyle }}">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Spesialis</span>
                @foreach($categoryNames as $catName)
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">{{ $catName }}</span>
                @endforeach
            </div>

            @foreach($spesialisList as $spesialisName => $files)
                @php $byCategory = $files->groupBy('category.category_name'); @endphp
                <div class="border-b border-slate-100 last:border-0 px-6 py-6 lg:py-4 hover:bg-blue-50/20 transition-colors">
                    <div class="flex flex-col lg:grid gap-6 lg:gap-4 items-start" style="{{ $gridStyle }}">
                        
                        <div class="text-blue-800 font-bold text-sm leading-snug lg:pt-2">{{ $spesialisName }}</div>

                        @foreach($categoryNames as $catName)
                        <div class="flex flex-col gap-2 w-full">
                            <span class="lg:hidden text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b pb-1 mb-1">{{ $catName }}</span>
                            @if(isset($byCategory[$catName]))
                                <div class="flex flex-col gap-2">
                                    @foreach($byCategory[$catName] as $i => $surat)
                                        <div class="group flex items-center">
                                            <a href="{{ route('public.files.preview', $surat->id) }}" target="_blank" 
                                               class="flex items-center gap-3 w-full p-2.5 bg-white border border-slate-200 rounded-lg hover:border-blue-800 hover:shadow-md transition-all">
                                                <span class="shrink-0 w-5 h-5 bg-blue-800 text-white text-[10px] font-bold flex items-center justify-center rounded">{{ $i + 1 }}</span>
                                                <span class="text-[11.5px] font-semibold text-slate-700 leading-tight flex-1 line-clamp-2">{{ $surat->title }}</span>
                                                
                                                <object class="shrink-0">
                                                    <a href="{{ route('public.files.download', $surat->id) }}" 
                                                       class="opacity-0 group-hover:opacity-100 p-1.5 text-blue-800 hover:bg-blue-50 rounded transition-all" 
                                                       title="Download">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                                    </a>
                                                </object>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-slate-300 text-xs italic lg:text-center lg:pt-2">—</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>
    @empty
        <div class="bg-white rounded-xl border-2 border-dashed border-slate-200 p-20 text-center">
            <h3 class="text-slate-500 font-bold text-lg text-blue-800/50">Tidak ada dokumen</h3>
        </div>
    @endforelse

    @if($grouped->count() > 0)
        <div class="bg-blue-800 rounded-xl p-5 text-right shadow-xl">
            <span class="text-xs font-bold text-blue-100 tracking-wide">
                REKAPITULASI DOKUMEN: 
                @foreach($stats as $stat)
                    <span class="text-white ml-2 bg-blue-900/50 px-2 py-1 rounded">{{ $stat->files_count }} {{ $stat->category_name }}</span>{{ !$loop->last ? ' • ' : '' }}
                @endforeach
            </span>
        </div>
    @endif
</main>

<footer class="text-center py-12 bg-slate-100 mt-10">
    <div class="text-[11px] text-slate-400 font-bold uppercase tracking-widest">
        © {{ date('Y') }} Rumah Sakit UII
    </div>
    <div class="text-[10px] text-slate-300 mt-1 uppercase">Sistem Informasi Dokumen Klinis</div>
</footer>

<div class="fixed bottom-6 right-6 z-[1000]">
    @guest
        <a href="{{ route('login') }}" class="flex items-center gap-2 bg-blue-800 hover:bg-blue-900 text-white px-5 py-3 rounded-xl text-[11px] font-bold shadow-2xl transition-all hover:scale-105 active:scale-95">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            ADMIN LOGIN
        </a>
    @else
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-blue-800 hover:bg-blue-900 text-white px-5 py-3 rounded-xl text-[11px] font-bold shadow-2xl transition-all hover:scale-105 active:scale-95">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            DASHBOARD
        </a>
    @endguest
</div>

</body>
</html>