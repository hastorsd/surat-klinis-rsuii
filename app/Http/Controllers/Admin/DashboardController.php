<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Ksm;
use App\Models\Spesialis;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats utama
        $totalSurat      = Surat::count();
        $totalKsm        = Ksm::count();
        $totalSpesialis  = Spesialis::count();
        $totalKategori   = Categories::count();

        // Stats per kategori
        $statsByCategory = Categories::withCount('surats')->orderBy('category_name')->get();

        // Stats per KSM (jumlah surat)
        $statsByKsm = Ksm::withCount(['spesialis as surat_count' => function ($q) {
            $q->join('surats', 'surats.spesialis_id', '=', 'spesialis.id')
              ->select(DB::raw('count(surats.id)'));
        }])->orderBy('ksm_name')->get();

        // Upload terbaru (5 surat)
        $recentSurats = Surat::with(['spesialis.ksm', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // KSM yang belum punya surat sama sekali
        $ksmKosong = Ksm::whereDoesntHave('spesialis.surats')->get();

        // Cek master data lengkap atau belum
        $masterDataLengkap = $totalKsm > 0 && $totalSpesialis > 0 && $totalKategori > 0;

        return view('admin.dashboard', compact(
            'totalSurat',
            'totalKsm',
            'totalSpesialis',
            'totalKategori',
            'statsByCategory',
            'statsByKsm',
            'recentSurats',
            'ksmKosong',
            'masterDataLengkap'
        ));
    }
}
