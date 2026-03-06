<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Files;
use App\Models\Spesialis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
        // paginate
        $perPage = $request->input('perPage', 10);

        // Mengambil semua files beserta nama spesialis, KSM, dan kategorinya
        $files = Files::with(['spesialis.ksm', 'category'])->latest()->paginate($perPage);

        return view('admin.files.index', compact('files', 'perPage'));
    }

    public function create()
    {
        // Ambil data spesialis (beserta KSM-nya) dan kategori untuk mengisi dropdown (select) di form
        $spesialis = Spesialis::with('ksm')->get();
        $categories = Categories::all();

        return view('admin.files.create', compact('spesialis', 'categories'));
    }

    public function store(Request $request)
    {
        // 1. validasi input
        $request->validate([
            'title'         => 'required|string',
            'spesialis_id'  => 'required|exists:spesialis,id',
            'category_id'   => 'required|exists:categories,id',
            'file_path'     => 'required|mimes:pdf,doc,docx|max:10240' // max 10MB, hanya pdf dan word
        ]);

        // 2. simpan file ke storage (storage/app/public/surat_klinis)
        // $filePath = $request->file('file')->store('surat_klinis', 'public');

        $filePath = null;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $originalName = $file->getClientOriginalName();
            
            // // Opsi 1: Gunakan nama asli langsung
            // $path = $file->storeAs('surat', $originalName, 'public');
            
            // Opsi 2: Tambahkan timestamp untuk menghindari duplikasi (RECOMMENDED)
            // $fileName = time() . '_' . $originalName;
            // $path = $file->storeAs('surat', $fileName, 'public');
            
            // Opsi 3: Sanitasi nama file untuk keamanan
            // Gunakan Carbon dengan format WIB
            $timestamp = Carbon::now()->format('YmdHis');
            $safeName  = uniqid(). '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $fileName = $timestamp . '_' . $safeName;

            $filePath = $file->storeAs('dokumen_klinis', $fileName, 'public');
        }

        // 3. simpan path file dan data lainnya ke database
        Files::create([
            'title'         => $request->title,
            'spesialis_id'  => $request->spesialis_id,
            'category_id'   => $request->category_id,
            'file_path'     => $filePath
        ]);

        return redirect()->route('admin.files.index')->with('success', 'Berhasil upload surat.');
    }

    public function edit(Files $files)
    {
        $spesialis = Spesialis::with('ksm')->get();
        $categories = Categories::all();

        return view('admin.files.edit', compact('files', 'spesialis', 'categories'));
    }

    public function update(Request $request, Files $files)
    {
        // 1. validasi input (file menjadi opsional/nullable saat update)
        $request->validate([
            'title'         => 'required|string',
            'spesialis_id'  => 'required|exists:spesialis,id',
            'category_id'   => 'required|exists:categories,id',
            'file_path'     => 'nullable|mimes:pdf,doc,docx|max:10240' // max 10MB, hanya pdf dan word
        ]);

        // default path dokumen
        $filePath = $files->file_path;

        // 2. cek apakah ada file baru yang diunggah
        if ($request->hasFile('file_path')) {
            // hapus file lama di storage jika ada
            if ($files->file_path && Storage::disk('public')->exists($files->file_path)) {
                Storage::disk('public')->delete($files->file_path);
            }

            // Simpan file baru dengan format yang sama seperti store
            $file = $request->file('file_path');
            $originalName = $file->getClientOriginalName();
            
            $timestamp = Carbon::now()->format('YmdHis');
            $safeName = uniqid() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $fileName = $timestamp . '_' . $safeName;
            
            $filePath = $file->storeAs('dokumen_klinis', $fileName, 'public');

        }

        // 3. update database
        $files->update([
            'title'         => $request->title,
            'spesialis_id'  => $request->spesialis_id,
            'category_id'   => $request->category_id,
            'file_path'     => $filePath
        ]);

        return redirect()->route('admin.files.index')->with('success', 'Berhasil update data.');
    }

    public function destroy(Files $files)
    {
        // 1. hapus file fisik di storage
        if ($files->file_path && Storage::disk('public')->exists($files->file_path)) {
            Storage::disk('public')->delete($files->file_path);
        }

        // 2. hapus data di database
        $files->delete();

        return redirect()->route('admin.files.index')->with('success', 'Berhasil hapus data.');
    }
}
