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

        return redirect()->route('admin.master')->with('success', 'Berhasil menambahkan data.');
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'category_name' => 'required|string'
        ]);

        $category->update(['category_name' => $request->category_name]);

        return redirect()->route('admin.master')->with('success', 'Berhasil memperbarui data.');
    }

    public function destroy(Categories $category)
    {
        // pengecekan tambahan sebelum dihapus kalau dibutuhkan
        $category->delete();

        return redirect()->route('admin.master')->with('success', 'Berhasil hapus data.');
    }
}
