<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PurchaseHistory;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.create');
    }

    public function manage()
    {
        $categories = Category::all();
        return view('admin.category.manage', compact('categories'));
    }

    public function storecat(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Simpan data ke database
        Category::create($validatedData);

        // Redirect kembali ke halaman sebelumnya
        return redirect()->route('category.manage')->with('success', 'Category created successfully!');
    }

    public function showcat($id)
    {
        $category_info = Category::find($id);
        return view('admin.category.edit', compact('category_info'));
    }

    public function updatecat(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $category->id . '|max:20',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0|max:10',
        ]);

        $category->update($validatedData);

        // Redirect ke halaman manage category
        return redirect()->route('category.manage')->with('success', 'Category updated successfully!');
    }

    public function deletecat($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('category.manage')->with('success', 'Category deleted successfully!');
    }

    public function buy($id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
    }

    // Cek jika stok cukup
    if ($category->stock <= 0) {
        return redirect()->back()->with('error', 'Stok tidak cukup.');
    }

    // Redirect ke pemilihan pembayaran
    return redirect()->route('category.payment.selection', $category->id);
}

public function paymentSelection($id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
    }

    return view('admin.category.payment', compact('category'));
}

public function processPayment(Request $request, $id)
{
    // Validasi data yang diterima
    $request->validate([
        'payment_method' => 'required|string',
    ]);

    // Temukan kategori berdasarkan ID
    $category = Category::find($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
    }

    // Simpan riwayat pembelian (jika perlu)
    PurchaseHistory::create([
        'category_id' => $category->id,
        'payment_method' => $request->input('payment_method'),
    ]);

    // Kurangi stok
    $category->decrement('stock');

    // Redirect ke halaman manage category dengan pesan sukses
    return redirect()->route('category.manage')->with('success', 'Pembayaran berhasil untuk kategori: ' . $category->category_name);
}

}
