<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Klinis - Rumah Sakit UII</title>
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
<body class="bg-slate-100 text-blue-900 min-h-screen">

<header class="sticky top-0 z-[100] bg-blue-600 px-6 shadow-md border-b border-blue-300">
    <div class="max-w-7xl mx-auto flex items-center justify-between h-[72px]">
        {{-- Logo dan header title --}}
        <div class="flex items-center gap-4">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-auto h-[45px]">
            </div>
            <div class="text-white">
                <h1 class="text-lg font-extrabold leading-tight tracking-tight">Dokumen Klinis - Rumah Sakit UII</h1>
                <p class="text-[11px] text-white font-medium">Sistem Informasi Manajemen Dokumen Klinis</p>
            </div>
        </div>

        {{-- Tampilkan totalan rekapitulasi dokumen --}}
        <div class="hidden md:flex gap-2">
            @foreach($stats as $stat)
                <div class="flex flex-col items-center bg-blue-800 backdrop-blur-sm rounded-xl px-4 py-2 min-w-[75px]">
                    <span class="text-xl font-extrabold text-white leading-none">{{ $stat->files_count }}</span>
                    <span class="text-[10px] font-bold text-slate-400 mt-1 uppercase">{{ $stat->category_name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</header>

<nav class="sticky top-[72px] z-[90] bg-white border-b border-slate-200 px-6 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 h-14">
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar flex-1 py-2">
            {{-- Tampilkan semua KSM dalam 1 halaman --}}
            <a href="{{ route('public.files.index') }}" 
               class="px-4 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap 
               {{ !request('ksm_id') ? 'bg-blue-600 text-white shadow-md shadow-slate-900/20' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                Semua KSM
            </a>

            {{-- Loop navigasi KSM di bawah navbar --}}
            @foreach($ksms as $ksm)
                <a href="{{ route('public.files.index', ['ksm_id' => $ksm->id]) }}" 
                   class="px-4 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap
                   {{ request('ksm_id') == $ksm->id ? 'bg-blue-600 text-white shadow-md shadow-slate-900/20' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-900' }}">
                    {{ $ksm->ksm_name }}
                </a>
            @endforeach
        </div>

        {{-- Search --}}
        <div class="relative shrink-0">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 transition-all duration-300" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <form method="GET" action="{{ route('public.files.index') }}">
            @if(request('ksm_id')) <input type="hidden" name="ksm_id" value="{{ request('ksm_id') }}"> @endif
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="pl-9 pr-4 py-2 bg-slate-100 border border-slate-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:w-80 shadow-inner transition-all duration-300 w-48" 
                   placeholder="Cari dokumen...">
            </form>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-6 py-8 pb-20">
    {{-- Syntax Loop Kategori --}}
    @php
        $categoryNames = $categories->pluck('category_name');
        $gridStyle = "grid-template-columns: 220px repeat(" . $categoryNames->count() . ", 1fr);";
    @endphp

    @forelse($grouped as $ksmName => $spesialisList)
        @php
            $ksmFiles = $spesialisList->flatten();
            $ksmByCategory = $ksmFiles->groupBy('category.category_name');
        @endphp

        <section class="mb-10 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-blue-600 px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-3 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <span class="text-white font-extrabold text-sm tracking-wide uppercase">KSM {{ $ksmName }}</span>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($categoryNames as $catName)
                        @if(isset($ksmByCategory[$catName]))
                            <span class="text-[10px] bg-blue-800 text-slate-100 px-3 py-1 rounded-full font-bold uppercase shadow-sm">
                                {{ $ksmByCategory[$catName]->count() }} {{ $catName }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Kolom Spesialis di bagian paling kiri KSM --}}
            <div class="hidden lg:grid bg-slate-50 border-b border-slate-200 px-6 py-3" style="{{ $gridStyle }}">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Spesialis</span>
                @foreach($categoryNames as $catName)
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">{{ $catName }}</span>
                @endforeach
            </div>

            {{-- Dokumen dalam tiap kategori dan dalam tiap spesialis dalam suatu KSM --}}
            @foreach($spesialisList as $spesialisName => $files)
                @php $byCategory = $files->groupBy('category.category_name'); @endphp
                <div class="border-b border-slate-100 last:border-0 px-6 py-6 lg:py-4 hover:bg-slate-50">
                    <div class="flex flex-col lg:grid gap-6 lg:gap-4 items-start" style="{{ $gridStyle }}">
                        
                        <div class="text-slate-900 font-bold text-sm leading-snug lg:pt-2">{{ $spesialisName }}</div>

                        @foreach($categoryNames as $catName)
                        <div class="flex flex-col gap-2 w-full">
                            <span class="lg:hidden text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b pb-1 mb-1">{{ $catName }}</span>
                            @if(isset($byCategory[$catName]))
                                <div class="space-y-3"> 
                                    @foreach($byCategory[$catName] as $i => $surat)
                                        <div class="group relative bg-white border border-slate-200 rounded-xl hover:shadow-xl transition-all duration-300 overflow-hidden">
                                            
                                            <div class="flex items-center justify-between">
                                                {{-- AREA KLIK PREVIEW (Membungkus hampir seluruh kartu) --}}
                                                <a href="{{ route('public.files.preview', $surat->id) }}" target="_blank" class="flex items-start p-4 gap-4 flex-1 min-w-0">
                                                    
                                                    {{-- Nomor Urut --}}
                                                    <span class="shrink-0 w-7 h-7 bg-slate-100 text-slate-600 group-hover:bg-blue-600 group-hover:text-white text-[11px] font-black flex items-center justify-center rounded-lg transition-all duration-300 mt-0.5">
                                                        {{ $i + 1 }}
                                                    </span>

                                                    <div class="flex flex-col min-w-0">
                                                        {{-- Judul: Full Text & Wrap --}}
                                                        <h3 class="text-[13px] font-bold text-slate-700 group-hover:text-blue-600 transition-colors">
                                                            {{ $surat->title }}
                                                        </h3>
                                                        
                                                        {{-- Metadata: Diunggah & Terakhir Diupdate --}}
                                                        <div class="flex flex-wrap gap-x-4 gap-y-1.5 mt-2.5">
                                                            <span class="text-[10px] text-slate-400 flex items-center gap-1.5 font-bold">
                                                                <x-heroicon-o-calendar class="w-3.5 h-3.5"/>
                                                                Diunggah: {{ $surat->created_at->translatedFormat('d M Y') }}
                                                            </span>
                                                            <span class="text-[10px] text-slate-400 flex items-center gap-1.5 font-bold">
                                                                <x-heroicon-o-arrow-path class="w-3.5 h-3.5"/>
                                                                Diperbarui: {{ $surat->updated_at->translatedFormat('d M Y H:i') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>

                                                {{-- TOMBOL DOWNLOAD (Terpisah secara elemen namun terlihat menyatu) --}}
                                                <div class="pr-4">
                                                    <a href="{{ route('public.files.download', $surat->id) }}" 
                                                    class="relative z-10 flex items-center justify-center w-10 h-10 bg-slate-50 text-slate-400 hover:bg-blue-600 hover:text-white rounded-full transition-all duration-300 shadow-sm" 
                                                    title="Unduh Dokumen">
                                                        <x-heroicon-o-arrow-down-tray class="w-5 h-5"/>
                                                    </a>
                                                </div>
                                            </div>
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
            <h3 class="text-slate-500 font-semibold text-md">Tidak ada dokumen</h3>
        </div>
    @endforelse

    {{-- @if($grouped->count() > 0)
        <div class="bg-slate-900 rounded-xl p-5 text-right shadow-xl">
            <span class="text-xs font-bold text-slate-300 tracking-wide uppercase">
                REKAPITULASI DOKUMEN: 
                @foreach($stats as $stat)
                    <span class="text-white ml-2 bg-slate-800 px-2 py-1 rounded">{{ $stat->files_count }} {{ $stat->category_name }}</span>{{ !$loop->last ? ' • ' : '' }}
                @endforeach
            </span>
        </div>
    @endif --}}
</main>

<footer class="text-center py-12 bg-slate-100 mt-10">
    <div class="text-[11px] text-slate-400 font-bold uppercase tracking-widest">
        © {{ date('Y') }} Rumah Sakit UII
    </div>
    <div class="text-[10px] text-slate-300 mt-1 uppercase">Sistem Informasi Manajemen Dokumen Klinis</div>
</footer>

<div class="fixed bottom-6 right-6 z-[1000]">
    @guest
        <a href="{{ route('login') }}" class="flex items-center gap-2 bg-blue-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl text-[11px] font-bold shadow-2xl">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            ADMIN LOGIN
        </a>
    @else
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-blue-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl text-[11px] font-bold shadow-2xl">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            DASHBOARD
        </a>
    @endguest
</div>

</body>
</html>