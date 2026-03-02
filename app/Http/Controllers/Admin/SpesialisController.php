<?php

namespace App\Http\Controllers;

use App\Models\Spesialis;
use Illuminate\Http\Request;

class SpesialisController extends Controller
{
    public function store(Request $request)
    {   
        $request->validate([
            'ksm_id' => 'required|exists:ksm,id',
            'spesialis_name' => 'required|string'
        ]);

        Spesialis::create([
            'ksm_id' => $request->ksm_id,
            'spesialis_name' => $request->spesialis_name
        ]);

        return redirect()->route('admin.settings')->with('success', 'Berhasil menambahkan data.');
    }

    public function update(Request $request, Spesialis $spesialis)
    {
        $request->validate([
            'ksm_id' => 'required|exists:ksm,id',
            'spesialis_name' => 'required|string'
        ]);

        $spesialis->update([
            'ksm_id' => $request->ksm_id,
            'spesialis_name' => $request->spesialis_name
        ]);

        return redirect()->route('admin.settings')->with('success', 'Berhasil memperbarui data.');
    }

    public function destroy(Spesialis $spesialis)
    {
        // pengecekan tambahan sebelum dihapus kalau dibutuhkan
        $spesialis->delete();

        return redirect()->route('admin.settings')->with('success', 'Berhasil hapus data.');
    }
}
