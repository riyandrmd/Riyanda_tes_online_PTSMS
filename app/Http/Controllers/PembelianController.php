<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // GET /api/pembelians
    public function index()
    {
        $data = Pembelian::with(['details.barang', 'user'])->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // POST /api/pembelians
    public function store(Request $request)
    {
        $request->validate([
            'no_faktur' => 'required|unique:pembelians',
            'tanggal' => 'required|date',
            'details' => 'required|array|min:1',
            'details.*.barang_id' => 'required|exists:barangs,id',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.harga' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            // Hitung subtotal dan total
            foreach ($request->details as $detail) {
                $total += $detail['qty'] * $detail['harga'];
            }

            $header = Pembelian::create([
                'no_faktur' => $request->no_faktur,
                'tanggal' => $request->tanggal,
                'user_id' => $request->user()->id,
                'total' => $total,
            ]);

            foreach ($request->details as $detail) {
                $subtotal = $detail['qty'] * $detail['harga'];

                PembelianDetail::create([
                    'pembelian_id' => $header->id,
                    'barang_id' => $detail['barang_id'],
                    'qty' => $detail['qty'],
                    'harga' => $detail['harga'],
                    'subtotal' => $subtotal,
                ]);

                // Update stok barang
                $barang = Barang::find($detail['barang_id']);
                $barang->stok += $detail['qty'];
                $barang->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'Pembelian berhasil disimpan',
                'data' => $header->load('details.barang'),
            ], 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // GET /api/pembelians/{id}
    public function show($id)
    {
        $pembelian = Pembelian::with(['details.barang', 'user'])->find($id);

        if (!$pembelian) {
            return response()->json(['message' => 'Pembelian not found'], 404);
        }

        return response()->json($pembelian);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
