<x-app-layout title="Detail Data - Admin">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Dokumen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-2xl font-bold text-gray-800">{{ $surat->title }}</h3>
                    <p class="text-gray-500 uppercase tracking-widest text-xs">{{ $surat->category->category_name }}</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-xs text-gray-400">KSM</label>
                        <p class="font-semibold">{{ $surat->spesialis->ksm->ksm_name }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-400">Spesialis</label>
                        <p class="font-semibold">{{ $surat->spesialis->spesialis_name }}</p>
                    </div>
                    <div class="pt-6">
                        <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank" class="block w-full text-center bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition">
                            Buka / Download File PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>