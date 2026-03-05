@extends('layouts.admin-sidebar')

@section('title', 'Edit Dokumen - Admin')
@section('page-title', 'Edit Dokumen Klinis')

@section('topbar-actions')
<a href="{{ route('admin.files.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
    <x-heroicon-o-arrow-left class="w-4 h-4" />
    Kembali
</a>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Card Utama --}}
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        
        {{-- Header Form --}}
        <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-black text-slate-800">Edit Dokumen</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Lengkapi dokumen dengan data terbaru</p>
            </div>
        </div>

        <form action="{{ route('admin.files.update', $files->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf 
            @method('PUT')
            
            {{-- Input Judul --}}
            <div class="space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">Judul Dokumen</label>
                <input type="text" name="title" value="{{ old('title', $files->title) }}" 
                    class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/30 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm font-semibold text-slate-700 placeholder:text-slate-300" required>
                @error('title') <p class="text-[11px] font-bold text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Pilih Spesialis --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">Spesialis (KSM)</label>
                    <div class="relative">
                        <select name="spesialis_id" 
                            class="appearance-none w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/30 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-sm font-semibold text-slate-700" required>
                            @foreach($spesialis as $sp)
                                <option value="{{ $sp->id }}" @selected($sp->id == $files->spesialis_id)>
                                    {{ $sp->ksm->ksm_name }} - {{ $sp->spesialis_name }}
                                </option>
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
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected($cat->id == $files->category_id)>
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <x-heroicon-s-chevron-down class="w-4 h-4" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- File Saat Ini --}}
            <div class="p-4 rounded-2xl bg-blue-50/50 border border-blue-100 flex items-center justify-between group">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="h-10 w-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-blue-200">
                        <x-heroicon-o-document-text class="w-5 h-5" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-tighter">Dokumen Saat Ini:</p>
                        <p class="truncate text-sm font-bold text-slate-700">{{ basename($files->file_path) }}</p>
                    </div>
                </div>
                <a href="{{ asset('storage/' . $files->file_path) }}" target="_blank" class="px-4 py-2 text-xs font-bold text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition-all border border-blue-200">
                    Lihat File
                </a>
            </div>

            {{-- Upload File Baru Area --}}
            <div class="space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">Ganti Berkas (Opsional)</label>
                <div class="relative group">
                    <div class="absolute inset-0 border-2 border-dashed border-slate-200 group-hover:border-blue-400 transition-colors rounded-[2rem]"></div>
                    <input type="file" name="file" id="file-upload-edit" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="relative p-8 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-blue-50 group-hover:text-blue-600 transition-all duration-300">
                            <x-heroicon-o-arrow-path class="w-6 h-6" />
                        </div>
                        <p class="text-sm font-bold text-slate-600" id="file-name-edit">Klik untuk telusuri dokumen baru</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">PDF/DOC (Maks. 10MB)</p>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                <p class="text-[10px] font-bold text-slate-400 uppercase">*Kosongkan file jika tidak ingin mengubah dokumen</p>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.files.index') }}" 
                        class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-100 transition-all">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-8 py-3 bg-blue-800 hover:bg-blue-900 text-white rounded-xl text-sm font-bold transition-all shadow-lg shadow-slate-200 active:scale-95 flex items-center gap-2">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('file-upload-edit').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : "Pilih berkas baru jika ingin mengganti";
        document.getElementById('file-name-edit').textContent = fileName;
        document.getElementById('file-name-edit').classList.add('text-blue-600');
    });
</script>
@endpush
@endsection