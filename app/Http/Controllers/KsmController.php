<?php

namespace App\Http\Controllers;

use App\Models\Ksm;
use Illuminate\Http\Request;

class KsmController extends Controller
{
    public function store(Request $request)
    {   
        $request->validate([
            'ksm_name' => 'required|string'
        ]);

        Ksm::create(['ksm_name' => $request->ksm_name]);

        return redirect()->route('admin.master')->with('success', 'Berhasil menambahkan data.');
    }

    public function update(Request $request, Ksm $ksm)
    {
        $request->validate([
            'ksm_name' => 'required|string'
        ]);

        $ksm->update(['ksm_name' => $request->ksm_name]);

        return redirect()->route('admin.master')->with('success', 'Berhasil memperbarui data.');
    }

    public function destroy(Ksm $ksm)
    {
        // pengecekan tambahan sebelum dihapus kalau dibutuhkan
        $ksm->delete();

        return redirect()->route('admin.master')->with('success', 'Berhasil hapus data.');
    }
}
