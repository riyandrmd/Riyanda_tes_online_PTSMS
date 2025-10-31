<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;

class LaporanController extends Controller
{
    // GET /api/laporan/pembelian
    public function laporanPembelian(Request $request)
    {
        $query = Pembelian::with(['user', 'details.barang']);

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();

        // Hitung total semua pembelian dalam hasil
        $grandTotal = $data->sum('total');

        return response()->json([
            'filters' => [
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir,
                'user_id' => $request->user_id,
            ],
            'grand_total' => $grandTotal,
            'data' => $data,
        ]);
    }
}
