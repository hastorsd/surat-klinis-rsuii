<x-app-layout title="Tambah Data - Admin">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Surat Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Judul Surat</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Pilih Spesialis (KSM)</label>
                        <select name="spesialis_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="">-- Pilih Spesialis --</option>
                            @foreach($spesialis as $sp)
                                <option value="{{ $sp->id }}">{{ $sp->ksm->ksm_name }} - {{ $sp->spesialis_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Kategori Dokumen</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700">Upload File (PDF/DOC)</label>
                        <input type="file" name="file" class="w-full border-gray-300 shadow-sm" required>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.files.index') }}" class="mr-4 text-gray-600 pt-2">Batal</a>
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Simpan Surat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>