<?php

// app/Http/Controllers/MasterCategoryController.php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MasterCategoryController extends Controller
{
    public function storecat(Request $request)
    {
        // Validasi data
        $validate_data = $request->validate([
            'category_name' => 'required|unique:categories|max:100',
            'price' => 'required|numeric|min:0', // Validasi untuk price
            'stock' => 'required|integer|min:0', // Validasi untuk stock
        ]);

        // Simpan data ke database
        Category::create($validate_data); // Pastikan $validate_data termasuk price dan stock

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Category created successfully!');
    }
    
    public function showcat($id)
    {
        $category_info = Category::find($id);
        return view('admin.category.edit', compact('category_info'));
    }

    public function updatecat(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validate_data = $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $category->id . '|max:100', // Memperbaiki validasi unik
            'price' => 'required|numeric|min:0', // Validasi untuk price
            'stock' => 'required|integer|min:0', // Validasi untuk stock
        ]);

        $category->update($validate_data);
        
        // Redirect ke halaman manage category
        return redirect()->route('category.manage')->with('message', 'Category updated successfully');
    }
    
    public function deletecat($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Category deleted successfully');
    }
}

