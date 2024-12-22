<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Pastikan ini ada
use App\Models\PurchaseHistory;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index()
    {
        // Ambil semua riwayat pembelian
        $purchaseHistories = PurchaseHistory::with('category')->get(); // Mengambil data dengan relasi category

        // Kirim data ke view
        return view('admin.order.history', compact('purchaseHistories'));
    }

    public function destroy($id)
{
    $purchaseHistory = PurchaseHistory::find($id);

    if (!$purchaseHistory) {
        return redirect()->back()->with('error', 'Riwayat pembelian tidak ditemukan.');
    }

    $purchaseHistory->delete();

    return redirect()->back()->with('success', 'Riwayat pembelian berhasil dihapus.');
}
}
