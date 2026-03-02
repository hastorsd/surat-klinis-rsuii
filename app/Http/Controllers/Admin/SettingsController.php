<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Ksm;
use App\Models\Spesialis;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $ksm = Ksm::withCount('spesialis')->orderBy('ksm_name')->get();
        $spesialis = Spesialis::with('ksm')->orderBy('spesialis_name')->get();
        $categories = Categories::withCount('files')->orderBy('category_name')->get();
        $ksmList = Ksm::orderBy('ksm_name')->get(); // untuk dropdown di form spesialis

        return view('admin.settings', compact('ksm', 'spesialis', 'categories', 'ksmList'));
    }
}
