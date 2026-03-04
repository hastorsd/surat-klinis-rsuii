@extends('layouts.admin-sidebar')

@section('title', 'Manajemen Dokumen')
@section('page-title', 'Kelola Dokumen Klinis')

@section('content')
<div class="space-y-6">
    {{-- ALERT SUCCESS --}}
    {{-- @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl shadow-sm animate-fade-in-down">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif --}}

    {{-- MAIN CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- HEADER TABLE --}}
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
            <div>
                <h3 class="text-base font-bold text-slate-800">Daftar Dokumen Klinis</h3>
                <p class="text-xs text-slate-500 mt-1 font-medium">Total: {{ $files->count() }} dokumen</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- Per Page Selector --}}
                <form method="GET" class="flex items-center bg-white border border-slate-200 rounded-xl px-3 py-1.5 shadow-sm">
                    <span class="text-[10px] font-bold text-slate-400 uppercase mr-2 tracking-wider">Tampilkan</span>
                    <select name="perPage" onchange="this.form.submit()" class="text-xs font-bold text-slate-700 focus:outline-none bg-transparent cursor-pointer">
                        @foreach ([10, 25, 50, 100] as $size)
                            <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }}</option>
                        @endforeach
                    </select>
                </form>

                {{-- Tombol Tambah --}}
                <a href="{{ route('admin.files.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-800 hover:bg-blue-900 text-white text-xs font-bold rounded-xl transition-all shadow-sm hover:shadow-md active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Dokumen
                </a>
            </div>
        </div>

        {{-- TABLE AREA --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-500 font-bold">
                        <th class="px-6 py-4 border-b border-slate-100">Judul Dokumen</th>
                        <th class="px-6 py-4 border-b border-slate-100">KSM</th>
                        <th class="px-6 py-4 border-b border-slate-100">Kategori</th>
                        <th class="px-6 py-4 border-b border-slate-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($files as $f)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-700 group-hover:text-blue-800 transition-colors break-words max-w-lg">{{ $f->title }}</span>
                                <span class="mt-1 text-[10px] text-slate-400 font-medium">Diunggah: {{ $f->created_at->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-[11px] font-bold text-slate-600 uppercase">{{ $f->spesialis->ksm->ksm_name ?? 'N/A' }}</span>
                                <span class="text-xs text-slate-500">{{ $f->spesialis->spesialis_name ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-100 uppercase">
                                {{ $f->category->category_name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.files.edit', $f->id) }}" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all" title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>

                                {{-- Tombol Hapus --}}
                                {{-- <form action="{{ route('admin.files.destroy', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus Data">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                    </button>
                                </form> --}}
                                <button type="button"
                                    onclick="confirmDeleteFile('{{ $f->id }}', '{{ addslashes($f->title) }}')"
                                    class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-slate-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"/></svg>
                                <p class="text-sm text-slate-400 font-medium">Belum ada dokumen yang tersedia.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- FOOTER AREA (Jika ada pagination) --}}
        @if($files instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="p-4 bg-slate-50/50 border-t border-slate-100">
            {{ $files->appends(['perPage' => $perPage])->links() }}
        </div>
        @endif
    </div>
</div>

<div id="modal-delete-file" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-sm rounded-2xl p-6 text-center">
        <h3 class="text-lg font-bold text-slate-800 mb-1">Hapus File?</h3>
        <p class="text-sm text-slate-500 mb-6">Anda akan menghapus <span id="delete-file-name" class="font-bold"></span>.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-delete-file')" class="flex-1 py-2 text-xs font-bold text-slate-500 bg-slate-100 rounded-xl">Batal</button>
                <form id="form-delete-file" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2 text-xs font-bold text-white bg-red-600 rounded-xl">Hapus</button>
                </form>
        </div>
    </div>
</div>

@endsection