<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Mengambil semua surat beserta nama spesialis, KSM, dan kategorinya
        $surats = Surat::with(['spesialis.ksm', 'category'])->latest()->get();

        return view('public.index', compact('surats'));
    }

    public function show()
    {

    }
}
