@extends('layouts.admin')

@section('page-title', 'Edit Dokumen Klinis')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.files.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-teal-600 transition-colors mb-6 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        KEMBALI KE LIST SURAT
    </a>

    <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-600 text-white shadow-lg shadow-teal-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Edit Detail Surat</h2>
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-widest mt-0.5">ID Dokumen: #{{ str_pad($files->id, 4, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.files.update', $files->id) }}" method="POST" enctype="multipart/form-data" class="px-10 py-10">
            @csrf 
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-8">
                
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 ml-1">Judul Dokumen Klinis</label>
                    <input type="text" name="title" value="{{ old('title', $files->title) }}" 
                        class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-4 text-sm font-semibold text-slate-700 focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10 transition-all outline-none"
                        placeholder="Masukkan judul lengkap surat...">
                    @error('title') <p class="text-[11px] font-bold text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 ml-1">Spesialis Penanggung Jawab</label>
                        <div class="relative">
                            <select name="spesialis_id" class="w-full appearance-none rounded-2xl border-slate-200 bg-slate-50 px-5 py-4 text-sm font-semibold text-slate-700 focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10 transition-all outline-none">
                                @foreach($spesialis as $sp)
                                    <option value="{{ $sp->id }}" @selected($sp->id == $files->spesialis_id)>
                                        {{ $sp->ksm->ksm_name }} — {{ $sp->spesialis_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 ml-1">Kategori Dokumen</label>
                        <div class="relative">
                            <select name="category_id" class="w-full appearance-none rounded-2xl border-slate-200 bg-slate-50 px-5 py-4 text-sm font-semibold text-slate-700 focus:border-teal-500 focus:bg-white focus:ring-4 focus:ring-teal-500/10 transition-all outline-none">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected($cat->id == $files->category_id)>
                                        {{ $cat->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <label class="block text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 mb-3 ml-1">Lampiran File (PDF)</label>
                    
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-teal-50 border border-teal-100 mb-4">
                        <div class="h-10 w-10 flex items-center justify-center rounded-xl bg-teal-500 text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/><path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] font-black text-teal-600 uppercase tracking-tighter">File Saat Ini</p>
                            <p class="truncate text-sm font-bold text-teal-900">{{ basename($files->file_path) }}</p>
                        </div>
                        <a href="{{ asset('storage/' . $files->file_path) }}" target="_blank" class="text-xs font-bold text-teal-600 hover:underline">Lihat File</a>
                    </div>

                    <div class="relative group">
                        <input type="file" name="file" id="file" class="hidden">
                        <label for="file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-200 rounded-[2rem] cursor-pointer bg-slate-50/50 hover:bg-white hover:border-teal-400 transition-all duration-300">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-2 text-slate-400 group-hover:text-teal-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                <p class="text-xs font-bold text-slate-500">Klik untuk mengganti file baru</p>
                                <p class="text-[10px] text-slate-400 mt-1">PDF (Maks. 10MB)</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-50">
                    <button type="submit" class="group flex items-center gap-3 bg-teal-600 text-white px-8 py-4 rounded-2xl text-sm font-black shadow-lg shadow-teal-500/25 hover:bg-teal-700 active:scale-95 transition-all">
                        SIMPAN PERUBAHAN
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection