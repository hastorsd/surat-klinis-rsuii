<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Ksm;
use App\Models\Surat;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::with(['spesialis.ksm', 'category']);

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

        return view('public.index', compact(
            'grouped',
            'stats',
            'ksms',
            'categories',
            'totalPerCategory'
        ));
    }

    public function download(Surat $surat)
    {
        $filePath = storage_path('app/public/' . $surat->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }
}
