@extends('layouts.admin')

@section('title', 'Master Data')
@section('page-title', 'Master Data')

@section('content')

<div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:20px; align-items:start;">

    {{-- ════════════════════════════════════════════ --}}
    {{-- CARD: KSM --}}
    {{-- ════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">KSM (Kelompok Staf Medis)</div>
                <div style="font-size:11px; color:var(--text-light); margin-top:2px;">{{ $ksms->count() }} data terdaftar</div>
            </div>
            <button onclick="openModal('modal-add-ksm')" class="btn btn-primary btn-sm">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah
            </button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama KSM</th>
                    <th>Spesialis</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($ksm as $i => $k)
                    <tr>
                        <td style="color:var(--text-light); font-size:11px;">{{ $i + 1 }}</td>
                        <td style="font-weight:600; font-size:13px;">{{ $k->ksm_name }}</td>
                        <td>
                            <span class="badge badge-teal">{{ $k->spesialis_count }}</span>
                        </td>
                        <td>
                            <div style="display:flex; gap:4px; justify-content:flex-end;">
                                <button onclick="openEditKsm({{ $km->id }}, '{{ addslashes($k->ksm_name) }}')"
                                        class="btn btn-outline btn-xs" title="Edit">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <button onclick="confirmDeleteKsm({{ $k->id }}, '{{ addslashes($k->ksm_name) }}')"
                                        class="btn btn-danger btn-xs" title="Hapus">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:var(--text-light); padding:24px;">Belum ada data KSM</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ════════════════════════════════════════════ --}}
    {{-- CARD: SPESIALIS --}}
    {{-- ════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Spesialis</div>
                <div style="font-size:11px; color:var(--text-light); margin-top:2px;">{{ $spesialis->count() }} data terdaftar</div>
            </div>
            <button onclick="openModal('modal-add-spesialis')" class="btn btn-primary btn-sm"
                    {{ $ksms->count() === 0 ? 'disabled title=Tambah KSM terlebih dahulu' : '' }}>
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah
            </button>
        </div>

        @if($ksms->count() === 0)
            <div style="padding:20px; text-align:center; color:var(--warning); font-size:12px; background:#fffbf0; border-top:1px solid #fef3c7;">
                ⚠️ Tambahkan KSM terlebih dahulu sebelum menambah Spesialis
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Spesialis</th>
                    <th>KSM</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($spesialis as $i => $sp)
                    <tr>
                        <td style="color:var(--text-light); font-size:11px;">{{ $i + 1 }}</td>
                        <td style="font-weight:600; font-size:13px;">{{ $sp->spesialis_name }}</td>
                        <td>
                            <span class="badge badge-gray" style="font-size:10px;">{{ $sp->ksm?->ksm_name ?? '—' }}</span>
                        </td>
                        <td>
                            <div style="display:flex; gap:4px; justify-content:flex-end;">
                                <button onclick="openEditSpesialis({{ $sp->id }}, {{ $sp->ksm_id }}, '{{ addslashes($sp->spesialis_name) }}')"
                                        class="btn btn-outline btn-xs" title="Edit">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <button onclick="confirmDeleteSpesialis({{ $sp->id }}, '{{ addslashes($sp->spesialis_name) }}')"
                                        class="btn btn-danger btn-xs" title="Hapus">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:var(--text-light); padding:24px;">Belum ada data Spesialis</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ════════════════════════════════════════════ --}}
    {{-- CARD: KATEGORI --}}
    {{-- ════════════════════════════════════════════ --}}
    <div class="card">
        <div class="card-header">
            <div>
                <div class="card-title">Kategori Dokumen</div>
                <div style="font-size:11px; color:var(--text-light); margin-top:2px;">{{ $categories->count() }} data terdaftar</div>
            </div>
            <button onclick="openModal('modal-add-category')" class="btn btn-primary btn-sm">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah
            </button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Surat</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $i => $cat)
                    @php
                        $badgeClass = match($cat->category_name) {
                            'PPK'       => 'badge-teal',
                            'CP'        => 'badge-green',
                            'SPO'       => 'badge-purple',
                            'Algoritma' => 'badge-orange',
                            default     => 'badge-gray',
                        };
                    @endphp
                    <tr>
                        <td style="color:var(--text-light); font-size:11px;">{{ $i + 1 }}</td>
                        <td>
                            <span class="badge {{ $badgeClass }}">{{ $cat->category_name }}</span>
                        </td>
                        <td>
                            <span style="font-size:12px; color:var(--text-mid);">{{ $cat->files_count }} surat</span>
                        </td>
                        <td>
                            <div style="display:flex; gap:4px; justify-content:flex-end;">
                                <button onclick="openEditCategory({{ $cat->id }}, '{{ addslashes($cat->category_name) }}')"
                                        class="btn btn-outline btn-xs" title="Edit">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <button onclick="confirmDeleteCategory({{ $cat->id }}, '{{ addslashes($cat->category_name) }}')"
                                        class="btn btn-danger btn-xs" title="Hapus">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:var(--text-light); padding:24px;">Belum ada data Kategori</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- PANDUAN URUTAN --}}
<div style="margin-top:20px; background:#fffbf0; border:1px solid #fef3c7; border-radius:12px; padding:16px 20px;">
    <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
        <span style="font-size:16px;">💡</span>
        <span style="font-size:13px; font-weight:700; color:#92400e;">Urutan Pengisian Master Data</span>
    </div>
    <div style="display:flex; gap:6px; align-items:center; font-size:12px; color:#78350f;">
        <span style="background:#92400e; color:#fff; border-radius:50%; width:20px; height:20px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:11px; flex-shrink:0;">1</span>
        <span>Tambah <strong>KSM</strong> terlebih dahulu</span>
        <span style="margin:0 8px; color:#d97706;">→</span>
        <span style="background:#92400e; color:#fff; border-radius:50%; width:20px; height:20px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:11px; flex-shrink:0;">2</span>
        <span>Tambah <strong>Spesialis</strong> dan kaitkan ke KSM</span>
        <span style="margin:0 8px; color:#d97706;">→</span>
        <span style="background:#92400e; color:#fff; border-radius:50%; width:20px; height:20px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:11px; flex-shrink:0;">3</span>
        <span>Tambah <strong>Kategori</strong> (PPK, CP, SPO, Algoritma)</span>
        <span style="margin:0 8px; color:#d97706;">→</span>
        <span style="background:#92400e; color:#fff; border-radius:50%; width:20px; height:20px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:11px; flex-shrink:0;">4</span>
        <span>Baru bisa <strong>Upload Surat</strong></span>
    </div>
</div>


{{-- ════════════════════════════════════════════ --}}
{{-- MODALS: KSM --}}
{{-- ════════════════════════════════════════════ --}}

{{-- ADD KSM --}}
<div id="modal-add-ksm" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Tambah KSM</span>
            <button class="modal-close" onclick="closeModal('modal-add-ksm')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.ksm.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama KSM <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="ksm_name" class="form-control {{ $errors->has('ksm_name') ? 'error' : '' }}"
                           placeholder="contoh: THT-KL" value="{{ old('ksm_name') }}" required autofocus>
                    @error('ksm_name')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-add-ksm')" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT KSM --}}
<div id="modal-edit-ksm" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Edit KSM</span>
            <button class="modal-close" onclick="closeModal('modal-edit-ksm')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form id="form-edit-ksm" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama KSM <span style="color:var(--danger)">*</span></label>
                    <input type="text" id="edit-ksm-name" name="ksm_name" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-ksm')" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>

{{-- DELETE KSM --}}
<div id="modal-delete-ksm" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title" style="color:var(--danger);">Hapus KSM</span>
            <button class="modal-close" onclick="closeModal('modal-delete-ksm')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <p style="font-size:14px; color:var(--text-mid);">Yakin hapus KSM: <strong id="delete-ksm-name"></strong>?</p>
            <p style="font-size:12px; color:var(--danger); margin-top:10px;">⚠️ KSM yang memiliki Spesialis tidak bisa dihapus.</p>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('modal-delete-ksm')" class="btn btn-outline">Batal</button>
            <form id="form-delete-ksm" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>


{{-- ════════════════════════════════════════════ --}}
{{-- MODALS: SPESIALIS --}}
{{-- ════════════════════════════════════════════ --}}

{{-- ADD SPESIALIS --}}
<div id="modal-add-spesialis" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Tambah Spesialis</span>
            <button class="modal-close" onclick="closeModal('modal-add-spesialis')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.spesialis.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">KSM <span style="color:var(--danger)">*</span></label>
                    <select name="ksm_id" class="form-control {{ $errors->has('ksm_id') ? 'error' : '' }}" required>
                        <option value="">— Pilih KSM —</option>
                        @foreach($ksmList as $ksm)
                            <option value="{{ $ksm->id }}" {{ old('ksm_id') == $ksm->id ? 'selected' : '' }}>
                                {{ $ksm->ksm_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('ksm_id')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Spesialis <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="spesialis_name" class="form-control {{ $errors->has('spesialis_name') ? 'error' : '' }}"
                           placeholder="contoh: Urologi" value="{{ old('spesialis_name') }}" required>
                    @error('spesialis_name')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-add-spesialis')" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT SPESIALIS --}}
<div id="modal-edit-spesialis" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Edit Spesialis</span>
            <button class="modal-close" onclick="closeModal('modal-edit-spesialis')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form id="form-edit-spesialis" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">KSM <span style="color:var(--danger)">*</span></label>
                    <select id="edit-spesialis-ksm" name="ksm_id" class="form-control" required>
                        @foreach($ksmList as $ksm)
                            <option value="{{ $ksm->id }}">{{ $ksm->ksm_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Spesialis <span style="color:var(--danger)">*</span></label>
                    <input type="text" id="edit-spesialis-name" name="spesialis_name" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-spesialis')" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>

{{-- DELETE SPESIALIS --}}
<div id="modal-delete-spesialis" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title" style="color:var(--danger);">Hapus Spesialis</span>
            <button class="modal-close" onclick="closeModal('modal-delete-spesialis')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <p style="font-size:14px; color:var(--text-mid);">Yakin hapus spesialis: <strong id="delete-spesialis-name"></strong>?</p>
            <p style="font-size:12px; color:var(--danger); margin-top:10px;">⚠️ Spesialis yang masih memiliki Surat tidak bisa dihapus.</p>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('modal-delete-spesialis')" class="btn btn-outline">Batal</button>
            <form id="form-delete-spesialis" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>


{{-- ════════════════════════════════════════════ --}}
{{-- MODALS: CATEGORY --}}
{{-- ════════════════════════════════════════════ --}}

{{-- ADD CATEGORY --}}
<div id="modal-add-category" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Tambah Kategori</span>
            <button class="modal-close" onclick="closeModal('modal-add-category')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.category.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Kategori <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="category_name" class="form-control {{ $errors->has('category_name') ? 'error' : '' }}"
                           placeholder="contoh: PPK, CP, SPO, Algoritma" value="{{ old('category_name') }}" required>
                    @error('category_name')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div style="background:var(--teal-ghost); border-radius:8px; padding:10px 12px; font-size:12px; color:var(--text-mid);">
                    💡 Rekomendasi: PPK, CP, SPO, Algoritma (sesuai sistem PPK RS)
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-add-category')" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT CATEGORY --}}
<div id="modal-edit-category" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Edit Kategori</span>
            <button class="modal-close" onclick="closeModal('modal-edit-category')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form id="form-edit-category" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Kategori <span style="color:var(--danger)">*</span></label>
                    <input type="text" id="edit-category-name" name="category_name" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modal-edit-category')" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>

{{-- DELETE CATEGORY --}}
<div id="modal-delete-category" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title" style="color:var(--danger);">Hapus Kategori</span>
            <button class="modal-close" onclick="closeModal('modal-delete-category')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <p style="font-size:14px; color:var(--text-mid);">Yakin hapus kategori: <strong id="delete-category-name"></strong>?</p>
            <p style="font-size:12px; color:var(--danger); margin-top:10px;">⚠️ Kategori yang masih digunakan Surat tidak bisa dihapus.</p>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('modal-delete-category')" class="btn btn-outline">Batal</button>
            <form id="form-delete-category" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// === KSM ===
function openEditKsm(id, name) {
    document.getElementById('edit-ksm-name').value = name;
    document.getElementById('form-edit-ksm').action = '/admin/ksm/' + id;
    openModal('modal-edit-ksm');
}

function confirmDeleteKsm(id, name) {
    document.getElementById('delete-ksm-name').textContent = name;
    document.getElementById('form-delete-ksm').action = '/admin/ksm/' + id;
    openModal('modal-delete-ksm');
}

// === SPESIALIS ===
function openEditSpesialis(id, ksmId, name) {
    document.getElementById('edit-spesialis-name').value = name;
    document.getElementById('edit-spesialis-ksm').value = ksmId;
    document.getElementById('form-edit-spesialis').action = '/admin/spesialis/' + id;
    openModal('modal-edit-spesialis');
}

function confirmDeleteSpesialis(id, name) {
    document.getElementById('delete-spesialis-name').textContent = name;
    document.getElementById('form-delete-spesialis').action = '/admin/spesialis/' + id;
    openModal('modal-delete-spesialis');
}

// === CATEGORY ===
function openEditCategory(id, name) {
    document.getElementById('edit-category-name').value = name;
    document.getElementById('form-edit-category').action = '/admin/category/' + id;
    openModal('modal-edit-category');
}

function confirmDeleteCategory(id, name) {
    document.getElementById('delete-category-name').textContent = name;
    document.getElementById('form-delete-category').action = '/admin/category/' + id;
    openModal('modal-delete-category');
}

// Auto-open modal jika ada validation error
@if($errors->any())
    @if($errors->has('ksm_name'))
        openModal('modal-add-ksm');
    @elseif($errors->has('spesialis_name') || $errors->has('ksm_id'))
        openModal('modal-add-spesialis');
    @elseif($errors->has('category_name'))
        openModal('modal-add-category');
    @endif
@endif
</script>
@endpush