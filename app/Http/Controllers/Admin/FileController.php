<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Spesialis;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        // Mengambil semua surat beserta nama spesialis, KSM, dan kategorinya
        $surats = Surat::with(['spesialis.ksm', 'category'])->latest()->get();

        return view('admin.index', compact('surats'));
    }

    public function create()
    {
        // Ambil data spesialis (beserta KSM-nya) dan kategori untuk mengisi dropdown (select) di form
        $spesialis = Spesialis::with('ksm')->get();
        $categories = Categories::all();

        return view('admin.create', compact('spesialis', 'categories'));
    }

    public function store(Request $request)
    {
        // 1. validasi input
        $request->validate([
            'title'         => 'required|string',
            'spesialis_id'  => 'required|exists:spesialis,id',
            'category_id'   => 'required|exists:categories,id',
            'file'          => 'required|mimes:pdf,doc,docx|max:10240' // max 10MB, hanya pdf dan word
        ]);

        // 2. simpan file ke storage (storage/app/public/surat_klinis)
        $filePath = $request->file('file')->store('surat_klinis', 'public');

        // 3. simpan path file dan data lainnya ke database
        Surat::create([
            'title'         => $request->title,
            'spesialis_id'  => $request->spesialis_id,
            'category_id'   => $request->category_id,
            'file_path'     => $filePath
        ]);

        return redirect()->route('admin.file.index')->with('success', 'Berhasil upload surat.');
    }

    public function show(Surat $surat)
    {
        // load relasi agar data spesialis dan kategori bisa ditampilkan
        $surat->load(['spesialis.ksm', 'category']);

        return view('admin.show', compact('surat'));
    }

    public function edit(Surat $surat)
    {
        $spesialis = Spesialis::with('ksm')->get();
        $categories = Categories::all();

        return view('admin.edit', compact('spesialis', 'categories'));
    }

    public function update(Request $request, Surat $surat)
    {
        // 1. validasi input (file menjadi opsional/nullable saat update)
        $request->validate([
            'title'         => 'required|string',
            'spesialis_id'  => 'required|exists:spesialis,id',
            'category_id'   => 'required|exists:categories,id',
            'file'          => 'nullable|mimes:pdf,doc,docx|max:10240' // max 10MB, hanya pdf dan word
        ]);

        $data = [
            'title'         => $request->title,
            'spesialis_id'  => $request->spesialis_id,
            'category_id'   => $request->category_id,
        ];

        // 2. cek apakah ada file baru yang diunggah
        if ($request->hasFile('file')) {
            // hapus file lama di storage jika ada
            if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
                Storage::disk('public')->delete($surat->file_path);
            }

            // simpan file baru
            $data['file_path'] = $request->file('file')->store('surat_klinis', 'public');
        }

        // 3. update database
        $surat->update($data);

        return redirect()->route('admin.file.index')->with('success', 'Berhasil update data.');
    }

    public function destroy(Surat $surat)
    {
        // 1. hapus file fisik di storage
        if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }

        // 2. hapus data di database
        $surat->delete();

        return redirect()->route('admin.file.index')->with('success', 'Berhasil hapus data.');
    }
}
