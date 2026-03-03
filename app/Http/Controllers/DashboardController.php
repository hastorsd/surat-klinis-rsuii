<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Files;
use App\Models\Ksm;
use App\Models\Spesialis;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats utama
        $totalFiles      = Files::count();
        $totalKsm        = Ksm::count();
        $totalSpesialis  = Spesialis::count();
        $totalKategori   = Categories::count();

        // Stats per kategori
        $statsByCategory = Categories::withCount('files')->orderBy('category_name')->get();

        // Stats per KSM (jumlah surat)
        $statsByKsm = Ksm::withCount(['spesialis as files_count' => function ($q) {
            $q->join('files', 'files.spesialis_id', '=', 'spesialis.id')
              ->select(DB::raw('count(files.id)'));
        }])->orderBy('ksm_name')->get();

        // Upload terbaru (5 surat)
        $recentFiles = Files::with(['spesialis.ksm', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // KSM yang belum punya surat sama sekali
        $ksmKosong = Ksm::whereDoesntHave('spesialis.files')->get();

        // Cek master data lengkap atau belum
        $masterDataLengkap = $totalKsm > 0 && $totalSpesialis > 0 && $totalKategori > 0;

        return view('admin.dashboard', compact(
            'totalFiles',
            'totalKsm',
            'totalSpesialis',
            'totalKategori',
            'statsByCategory',
            'statsByKsm',
            'recentFiles',
            'ksmKosong',
            'masterDataLengkap'
        ));
    }
}
