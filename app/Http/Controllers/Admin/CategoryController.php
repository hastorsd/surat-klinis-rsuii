<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {   
        $request->validate([
            'category_name' => 'required|string'
        ]);

        Categories::create(['category_name' => $request->category_name]);

        return redirect()->route('admin.settings')->with('success', 'Berhasil menambahkan data.');
    }

    public function update(Request $request, Categories $categories)
    {
        $request->validate([
            'category_name' => 'required|string'
        ]);

        $categories->update(['category_name' => $request->category_name]);

        return redirect()->route('admin.settings')->with('success', 'Berhasil memperbarui data.');
    }

    public function destroy(Categories $categories)
    {
        // pengecekan tambahan sebelum dihapus kalau dibutuhkan
        $categories->delete();

        return redirect()->route('admin.settings')->with('success', 'Berhasil hapus data.');
    }
}
