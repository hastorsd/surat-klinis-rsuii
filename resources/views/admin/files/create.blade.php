@extends('layouts.admin-sidebar')

@section('title', 'Tambah Dokumen')
@section('page-title', 'Tambah Dokumen Klinis')

{{-- Menambahkan tombol kembali di topbar jika layout Anda mendukung @yield('topbar-actions') --}}
{{-- @section('topbar-actions')
<a href="{{ route('admin.files.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
    <x-heroicon-o-arrow-left class="w-4 h-4" />
    Kembali
</a>
@endsection --}}

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Card Utama --}}
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        
        {{-- Header Form --}}
        <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50">
            <h3 class="text-lg font-black text-slate-800">Upload Dokumen Baru</h3>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Lengkapi informasi dokumen baru</p>
        </div>

        <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-2">
            @csrf
            
            {{-- Input Judul --}}
            <div class="space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">Judul Dokumen</label>
                <input type="text" name="title" 
                    class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/30 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm font-semibold text-slate-700 placeholder:text-slate-300" 
                    placeholder="Contoh: Panduan Praktik Klinis - Kardiologi" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Pilih Spesialis --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">KSM - Spesialis</label>
                    <div class="relative">
                        <select name="spesialis_id" 
                            class="appearance-none w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/30 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm font-semibold text-slate-700" required>
                            <option value="" disabled selected>Pilih KSM - Spesialis</option>
                            @foreach($spesialis as $sp)
                                <option value="{{ $sp->id }}">{{ $sp->ksm->ksm_name }} - {{ $sp->spesialis_name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <x-heroicon-s-chevron-down class="w-4 h-4" />
                        </div>
                    </div>
                </div>

                {{-- Kategori Dokumen --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">Kategori</label>
                    <div class="relative">
                        <select name="category_id" 
                            class="appearance-none w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/30 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm font-semibold text-slate-700" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <x-heroicon-s-chevron-down class="w-4 h-4" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Custom Upload File Area --}}
            <div class="space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">Berkas Dokumen (PDF/DOC)</label>
                <div class="relative group">
                    <div class="absolute inset-0 border-2 border-dashed border-slate-200 group-hover:border-blue-400 transition-colors rounded-[2rem]"></div>
                    <input type="file" name="file" id="file-upload" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                    <div class="relative p-10 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <x-heroicon-o-document-arrow-up class="w-8 h-8" />
                        </div>
                        <p class="text-sm font-bold text-slate-700" id="file-name-display">Klik untuk telusuri berkas</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase mt-1 tracking-wider">Maksimal ukuran file 10MB</p>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                <button type="reset" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">Reset Form</button>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.files.index') }}" 
                        class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-100 transition-all">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-8 py-3 bg-blue-800 hover:bg-blue-900 text-white rounded-xl text-sm font-bold transition-all shadow-lg shadow-slate-200 active:scale-95">
                        Simpan Dokumen
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Script sederhana untuk menampilkan nama file yang dipilih
    document.getElementById('file-upload').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : "Klik untuk telusuri berkas";
        document.getElementById('file-name-display').textContent = fileName;
        document.getElementById('file-name-display').classList.add('text-blue-600');
    });
</script>
@endpush
@endsection