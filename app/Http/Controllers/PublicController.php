<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Files;
use App\Models\Ksm;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Files::with(['spesialis.ksm', 'category']);

        // Filter by KSM
        if ($request->filled('ksm_id')) {
            $query->whereHas('spesialis.ksm', fn($q) => $q->where('id', $request->ksm_id));
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $files = $query->latest()->get();

        // Grouping: KSM name -> Spesialis name -> collection of files
        $grouped = $files
            ->groupBy(fn($s) => $s->spesialis?->ksm?->ksm_name ?? 'Lainnya')
            ->map(fn($items) => $items->groupBy(fn($s) => $s->spesialis?->spesialis_name ?? 'Lainnya'));

        // Stats per category (all, not filtered)
        $stats = Categories::withCount('files')->get();

        // KSM list for filter tabs
        $ksms = Ksm::orderBy('ksm_name')->get();

        // Categories for filter
        $categories = Categories::orderBy('category_name')->get();

        // Total counts per category for header badges
        $totalPerCategory = $stats->pluck('files_count', 'category_name');

        return view('test', compact(
            'grouped',
            'stats',
            'ksms',
            'categories',
            'totalPerCategory'
        ));
    }

    public function download(Files $files)
    {
        $filePath = storage_path('app/public/' . $files->file_path);

        if (!$files->file_path || !file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        $safeTitle = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $files->title);

        $downloadFileName = 'Dokumen_' . $safeTitle . '.' . $fileExtension;

        return response()->download(
            $filePath,
            $downloadFileName
        );
    }

    public function preview(Files $files)
    {
        $filePath = storage_path('app/public/' . $files->file_path);

        if (!$files->file_path || !file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return response()->file($filePath);
    }
}
