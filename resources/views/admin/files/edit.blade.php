<x-app-layout title="Edit Data - Admin">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Surat: {{ $surat->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Judul Surat</label>
                        <input type="text" name="title" value="{{ $surat->title }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Spesialis</label>
                        <select name="spesialis_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                            @foreach($spesialis as $sp)
                                <option value="{{ $sp->id }}" @selected($sp->id == $surat->spesialis_id)>
                                    {{ $sp->ksm->ksm_name }} - {{ $sp->spesialis_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" @selected($cat->id == $surat->category_id)>
                                    {{ $cat->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6 border-t pt-4">
                        <label class="block text-gray-700 font-bold">Ganti File (Kosongkan jika tidak ingin mengubah)</label>
                        <p class="text-xs text-blue-600 mb-2">File saat ini: {{ basename($surat->file_path) }}</p>
                        <input type="file" name="file" class="w-full border-gray-300 shadow-sm">
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Update Data</button>
                        <a href="{{ route('surat.index') }}" class="text-gray-600 pt-2 hover:underline">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>