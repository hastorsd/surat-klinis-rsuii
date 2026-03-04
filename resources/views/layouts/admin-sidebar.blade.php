<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Rumah Sakit UII</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex">

<aside class="fixed inset-y-0 left-0 w-64 bg-slate-900 flex flex-col z-[100] shadow-2xl">
    <div class="p-6 flex items-center gap-3">
        <div class="h-10 w-10 bg-slate-900 rounded-xl flex items-center justify-center shrink-0">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-6 h-6 object-contain">
        </div>
        <div>
            <h1 class="text-white text-sm font-extrabold leading-tight">Rumah Sakit UII</h1>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">Admin Panel</p>
        </div>
    </div>

    <nav class="flex-1 px-4 py-4 space-y-1">
        <div class="px-4 py-3 text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em]">Manajemen</div>

        {{-- <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all 
           {{ request()->routeIs('admin.dashboard.*') ? 'bg-blue-800 text-white shadow-lg shadow-blue-800/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <x-heroicon-o-home class="w-5 h-5 mr-3" />
            Dashboard
        </a> --}}

        <a href="{{ route('admin.files.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all 
           {{ request()->routeIs('admin.files.*') ? 'bg-blue-800 text-white shadow-lg shadow-blue-800/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <x-heroicon-o-folder class="w-5 h-5 mr-3" />
            Kelola Dokumen
        </a>

        <a href="{{ route('admin.master') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all 
           {{ request()->routeIs('admin.master') ? 'bg-blue-800 text-white shadow-lg shadow-blue-800/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <x-heroicon-o-rectangle-stack class="w-5 h-5 mr-3" />
            Master Data
        </a>

        <div class="px-4 py-6 text-[10px] font-bold text-slate-600 uppercase tracking-[0.2em]">Redirect</div>
        
        <a href="{{ route('public.files.index') }}" target="_blank" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-400 hover:bg-white/5 hover:text-white transition-all">
            <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Halaman Publik
        </a>
    </nav>

    <div class="p-4 bg-black/20">
        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-2xl mb-3 border border-white/5">
            <div class="h-9 w-9 bg-slate-700 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-white text-xs font-bold truncate">{{ auth()->user()->name }}</p>
                <p class="text-slate-500 text-[10px] font-medium">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-bold text-red-400 border border-red-400/20 hover:bg-red-400/10 transition-all">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

<main class="flex-1 ml-64 min-h-screen flex flex-col">
    <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 px-8 flex items-center justify-between">
        <h2 class="text-lg font-extrabold text-slate-800 tracking-tight">@yield('page-title', 'Dashboard')</h2>
        <div class="flex items-center gap-3">
            @yield('topbar-actions')
        </div>
    </header>

    <div class="p-8">
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 text-emerald-700 border border-emerald-100 p-4 rounded-2xl mb-6 shadow-sm">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 text-red-700 border border-red-100 p-4 rounded-2xl mb-6 shadow-sm">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span class="text-sm font-bold">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </div>
</main>

@stack('scripts')

<script>
    // === CORE MODAL ENGINE ===
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }

    // Close modal when clicking outside (overlay)
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-overlay')) {
            closeModal(e.target.id);
        }
    });

    // === KSM FUNCTIONS ===
    function openEditKsm(id, name) {
        const input = document.getElementById('edit-ksm-name');
        const form = document.getElementById('form-edit-ksm');
        if (input && form) {
            input.value = name;
            form.action = `/admin/ksm/${id}`;
            openModal('modal-edit-ksm');
        }
    }

    function confirmDeleteKsm(id, name) {
        const span = document.getElementById('delete-ksm-name');
        const form = document.getElementById('form-delete-ksm');
        if (span && form) {
            span.textContent = name;
            form.action = `/admin/ksm/${id}`;
            openModal('modal-delete-ksm');
        }
    }

    // === SPESIALIS FUNCTIONS ===
    function openEditSpesialis(id, ksmId, name) {
        const inputName = document.getElementById('edit-spesialis-name');
        const inputKsm = document.getElementById('edit-spesialis-ksm');
        const form = document.getElementById('form-edit-spesialis');
        if (inputName && inputKsm && form) {
            inputName.value = name;
            inputKsm.value = ksmId;
            form.action = `/admin/spesialis/${id}`;
            openModal('modal-edit-spesialis');
        }
    }

    function confirmDeleteSpesialis(id, name) {
        const span = document.getElementById('delete-spesialis-name');
        const form = document.getElementById('form-delete-spesialis');
        if (span && form) {
            span.textContent = name;
            form.action = `/admin/spesialis/${id}`;
            openModal('modal-delete-spesialis');
        }
    }

    // === CATEGORY FUNCTIONS ===
    function openEditCategory(id, name) {
        const input = document.getElementById('edit-category-name');
        const form = document.getElementById('form-edit-category');
        if (input && form) {
            input.value = name;
            form.action = `/admin/category/${id}`;
            openModal('modal-edit-category');
        }
    }

    function confirmDeleteCategory(id, name) {
        const span = document.getElementById('delete-category-name');
        const form = document.getElementById('form-delete-category');
        if (span && form) {
            span.textContent = name;
            form.action = `/admin/category/${id}`;
            openModal('modal-delete-category');
        }
    }

    // === FILES FUNCTION ===
    function confirmDeleteFile(id, name) {
        const span = document.getElementById('delete-file-name');
        const form = document.getElementById('form-delete-file');
        if (span && form) {
            span.textContent = name;
            form.action = `/admin/files/${id}`;
            openModal(`modal-delete-file`);
        }
    }
</script>

</body>
</html>