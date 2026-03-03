@extends('layouts.admin')

@section('title', 'Master Data')
@section('page-title', 'Master Data')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
    {{-- CARD: KSM --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="text-sm font-bold text-slate-800">KSM (Kelompok Staf Medis)</h3>
                <p class="text-[11px] text-slate-500 mt-0.5 font-medium">{{ $ksm->count() }} Total KSM</p>
            </div>
            <button onclick="openModal('modal-add-ksm')" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-800 hover:bg-blue-900 text-white text-xs font-bold rounded-lg transition-colors">
                Tambah
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-[10px] uppercase tracking-wider text-slate-500 font-bold">
                    <tr>
                        <th class="px-5 py-3 border-b border-slate-100 w-10">#</th>
                        <th class="px-5 py-3 border-b border-slate-100">Nama KSM</th>
                        <th class="px-5 py-3 border-b border-slate-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($ksm as $i => $k)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 text-[11px] text-slate-400">{{ $i + 1 }}</td>
                        <td class="px-5 py-3 text-sm font-bold text-slate-700">{{ $k->ksm_name }}</td>
                        <td class="px-5 py-3 text-right flex justify-end gap-1">
                            <button onclick="openEditKsm({{ $k->id }}, '{{ addslashes($k->ksm_name) }}')" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <button onclick="confirmDeleteKsm({{ $k->id }}, '{{ addslashes($k->ksm_name) }}')" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-5 py-10 text-center text-xs text-slate-400 italic">Kosong</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- CARD: SPESIALIS --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="text-sm font-bold text-slate-800">Spesialis</h3>
                <p class="text-[11px] text-slate-500 mt-0.5 font-medium">{{ $spesialis->count() }} Total Spesialis</p>
            </div>
            <button onclick="openModal('modal-add-spesialis')" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-800 hover:bg-blue-900 text-white text-xs font-bold rounded-lg transition-colors" {{ $ksm->count() === 0 ? 'disabled' : '' }}>
                Tambah
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-[10px] uppercase tracking-wider text-slate-500 font-bold">
                    <tr>
                        <th class="px-5 py-3 border-b border-slate-100 w-10">#</th>
                        <th class="px-5 py-3 border-b border-slate-100">Nama Spesialis</th>
                        <th class="px-5 py-3 border-b border-slate-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($spesialis as $i => $sp)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 text-[11px] text-slate-400">{{ $i + 1 }}</td>
                        <td class="px-5 py-3 text-sm font-bold text-slate-700">
                            {{ $sp->spesialis_name }}
                            <div class="text-[10px] text-slate-400 uppercase font-bold">KSM: {{ $sp->ksm?->ksm_name }}</div>
                        </td>
                        <td class="px-5 py-3 text-right flex justify-end gap-1">
                            <button onclick="openEditSpesialis({{ $sp->id }}, {{ $sp->ksm_id }}, '{{ addslashes($sp->spesialis_name) }}')" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <button onclick="confirmDeleteSpesialis({{ $sp->id }}, '{{ addslashes($sp->spesialis_name) }}')" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-5 py-10 text-center text-xs text-slate-400 italic">Kosong</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- CARD: KATEGORI --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="text-sm font-bold text-slate-800">Kategori</h3>
                <p class="text-[11px] text-slate-500 mt-0.5 font-medium">{{ $categories->count() }} Total Kategori</p>
            </div>
            <button onclick="openModal('modal-add-category')" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-800 hover:bg-blue-900 text-white text-xs font-bold rounded-lg transition-colors">
                Tambah
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-[10px] uppercase tracking-wider text-slate-500 font-bold">
                    <tr>
                        <th class="px-5 py-3 border-b border-slate-100 w-10">#</th>
                        <th class="px-5 py-3 border-b border-slate-100">Kategori</th>
                        <th class="px-5 py-3 border-b border-slate-100 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $i => $cat)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 text-[11px] text-slate-400">{{ $i + 1 }}</td>
                        <td class="px-5 py-3 text-sm font-bold text-slate-700">{{ $cat->category_name }}</td>
                        <td class="px-5 py-3 text-right flex justify-end gap-1">
                            <button onclick="openEditCategory({{ $cat->id }}, '{{ addslashes($cat->category_name) }}')" class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <button onclick="confirmDeleteCategory({{ $cat->id }}, '{{ addslashes($cat->category_name) }}')" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-5 py-10 text-center text-xs text-slate-400 italic">Kosong</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════ --}}
{{-- ALL MODALS --}}
{{-- ════════════════════════════════════════════ --}}

<div id="modal-add-ksm" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-base">Tambah KSM</h3>
            <button onclick="closeModal('modal-add-ksm')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form method="POST" action="{{ route('admin.ksm.store') }}">
            @csrf
            <div class="p-6">
                <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-2">Nama KSM</label>
                <input type="text" name="ksm_name" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-blue-800" placeholder="Contoh: Mata" required>
            </div>
            <div class="p-5 bg-slate-50 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-ksm')" class="text-xs font-bold text-slate-500">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-800 text-white text-xs font-bold rounded-xl">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-edit-ksm" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-base">Edit KSM</h3>
            <button onclick="closeModal('modal-edit-ksm')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form id="form-edit-ksm" method="POST">
            @csrf @method('PUT')
            <div class="p-6">
                <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-2">Nama KSM</label>
                <input type="text" id="edit-ksm-name" name="ksm_name" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-blue-800" required>
            </div>
            <div class="p-5 bg-slate-50 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-ksm')" class="text-xs font-bold text-slate-500">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-800 text-white text-xs font-bold rounded-xl">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-delete-ksm" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-sm rounded-2xl p-6 text-center">
        <h3 class="text-lg font-bold text-slate-800 mb-1">Hapus KSM?</h3>
        <p class="text-sm text-slate-500 mb-6">Anda akan menghapus <span id="delete-ksm-name" class="font-bold"></span>.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-delete-ksm')" class="flex-1 py-2 text-xs font-bold text-slate-500 bg-slate-100 rounded-xl">Batal</button>
            <form id="form-delete-ksm" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-2 text-xs font-bold text-white bg-red-600 rounded-xl">Hapus</button>
            </form>
        </div>
    </div>
</div>

<div id="modal-add-spesialis" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-base">Tambah Spesialis</h3>
            <button onclick="closeModal('modal-add-spesialis')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form method="POST" action="{{ route('admin.spesialis.store') }}">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="text-xs font-bold text-slate-700 uppercase block mb-2">Pilih KSM</label>
                    <select name="ksm_id" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" required>
                        @foreach($ksm as $k)
                            <option value="{{ $k->id }}">{{ $k->ksm_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-700 uppercase block mb-2">Nama Spesialis</label>
                    <input type="text" name="spesialis_name" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" required>
                </div>
            </div>
            <div class="p-5 bg-slate-50 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-spesialis')" class="text-xs font-bold text-slate-500">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-800 text-white text-xs font-bold rounded-xl">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-edit-spesialis" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-base">Edit Spesialis</h3>
            <button onclick="closeModal('modal-edit-spesialis')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form id="form-edit-spesialis" method="POST" action="">
            @csrf @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="text-xs font-bold text-slate-700 uppercase block mb-2">Pilih KSM</label>
                    <select id="edit-spesialis-ksm" name="ksm_id" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" required>
                        @foreach($ksm as $k)
                            <option value="{{ $k->id }}">{{ $k->ksm_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-700 uppercase block mb-2">Nama Spesialis</label>
                    <input type="text" id="edit-spesialis-name" name="spesialis_name" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" required>
                </div>
            </div>
            <div class="p-5 bg-slate-50 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-spesialis')" class="text-xs font-bold text-slate-500">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-800 text-white text-xs font-bold rounded-xl">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-delete-spesialis" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-sm rounded-2xl p-6 text-center">
        <h3 class="text-lg font-bold text-slate-800 mb-1">Hapus Spesialis?</h3>
        <p class="text-sm text-slate-500 mb-6">Anda akan menghapus <span id="delete-spesialis-name" class="font-bold"></span>.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-delete-spesialis')" class="flex-1 py-2 text-xs font-bold text-slate-500 bg-slate-100 rounded-xl">Batal</button>
            <form id="form-delete-spesialis" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-2 text-xs font-bold text-white bg-red-600 rounded-xl">Hapus</button>
            </form>
        </div>
    </div>
</div>

<div id="modal-add-category" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-base">Tambah Kategori</h3>
            <button onclick="closeModal('modal-add-category')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form method="POST" action="{{ route('admin.category.store') }}">
            @csrf
            <div class="p-6">
                <label class="text-xs font-bold text-slate-700 uppercase block mb-2">Nama Kategori</label>
                <input type="text" name="category_name" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" placeholder="Contoh: PPK, SPO" required>
            </div>
            <div class="p-5 bg-slate-50 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-category')" class="text-xs font-bold text-slate-500">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-800 text-white text-xs font-bold rounded-xl">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-edit-category" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-base">Edit Kategori</h3>
            <button onclick="closeModal('modal-edit-category')" class="text-slate-400 hover:text-slate-600">✕</button>
        </div>
        <form id="form-edit-category" method="POST" action="">
            @csrf @method('PUT')
            <div class="p-6">
                <label class="text-xs font-bold text-slate-700 uppercase block mb-2">Nama Kategori</label>
                <input type="text" id="edit-category-name" name="category_name" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm" required>
            </div>
            <div class="p-5 bg-slate-50 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-category')" class="text-xs font-bold text-slate-500">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-800 text-white text-xs font-bold rounded-xl">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-delete-category" class="modal-overlay fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[200] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-sm rounded-2xl p-6 text-center">
        <h3 class="text-lg font-bold text-slate-800 mb-1">Hapus Kategori?</h3>
        <p class="text-sm text-slate-500 mb-6">Anda akan menghapus <span id="delete-category-name" class="font-bold"></span>.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-delete-category')" class="flex-1 py-2 text-xs font-bold text-slate-500 bg-slate-100 rounded-xl">Batal</button>
            <form id="form-delete-category" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-2 text-xs font-bold text-white bg-red-600 rounded-xl">Hapus</button>
            </form>
        </div>
    </div>
</div>

@endsection