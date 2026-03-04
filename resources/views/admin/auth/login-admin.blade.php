<!DOCTYPE html>
<html lang="id" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Dokumen Klinis RS UII</title>
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

@if(Auth::check())
    <script>window.location = "{{ route('admin.dashboard') }}";</script>
@endif

<body class="bg-slate-300 flex items-center justify-center min-h-screen p-6 transition-colors duration-500">
    {{-- Lebar max ditingkatkan sedikit ke max-w-lg untuk kenyamanan visual teks yang panjang --}}
    <div class="relative bg-white shadow-2xl rounded-3xl border border-gray-100 p-8 md:p-12 w-full max-w-lg transition-all duration-500">
        
        {{-- Header Area --}}
        <div class="flex flex-col items-center mb-10">
            {{-- Grup Logo & Nama Sistem --}}
            <div class="flex items-center gap-4 mb-8">
                {{-- Container Logo --}}
                <div class="p-2 bg-slate-50 rounded-2xl border border-slate-100 shadow-sm">
                    <img src="{{ asset('images/logo-transparent.png') }}"
                        alt="Logo RS UII"
                        class="w-14 h-14 object-contain">
                </div>
                
                {{-- Pembatas Vertikal --}}
                <div class="w-px h-12 bg-slate-200"></div>

                {{-- Teks Brand --}}
                <div class="flex flex-col">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] leading-tight">Sistem Informasi</span>
                    <h2 class="text-lg font-black text-slate-800 leading-tight tracking-tight">
                        Dokumen Klinis <span class="text-blue-600">RS UII</span>
                    </h2>
                </div>
            </div>
            
            {{-- Judul Halaman --}}
            <div class="relative w-full flex items-center justify-center">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <div class="relative bg-white px-4">
                    <h1 class="text-2xl font-black text-slate-900">
                        Admin Login
                    </h1>
                </div>
            </div>
        </div>

        {{-- Form Login: Margin top ditingkatkan (mt-10) untuk memisahkan konten header dan form --}}
        <form method="POST" action="{{ route('login') }}" class="mt-5 space-y-6">
            @csrf

            {{-- Email: Padding input ditingkatkan (py-3) agar lebih mudah diklik --}}
            <div class="space-y-2">
                <label for="email" class="block text-left text-gray-700 font-bold text-sm ml-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="block w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-gray-50 focus:bg-white outline-none"
                       />
                @error('email')
                    <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="space-y-2">
                <label for="password" class="block text-left text-gray-700 font-bold text-sm ml-1">Password</label>
                <input id="password" type="password" name="password" required
                       class="block w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-gray-50 focus:bg-white outline-none"
                        />
                @error('password')
                    <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me & Lupa Password: Margin vertikal disesuaikan --}}
            <div class="flex items-center justify-between text-xs md:text-sm px-1 py-1">
                <label class="inline-flex items-center text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4">
                    <span class="ml-2 font-medium">Ingat saya</span>
                </label>
            </div>

            {{-- Tombol Login: Padding vertikal dipertebal (py-3.5) untuk kesan lebih kokoh --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-slate-900 text-white font-bold py-3.5 rounded-xl hover:bg-slate-800 transition-all shadow-lg active:scale-[0.98] tracking-wider">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</body>
</html>