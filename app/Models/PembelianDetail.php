<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;

     protected $fillable = [
        'pembelian_id',
        'barang_id',
        'qty',
        'harga',
        'subtotal',
    ];

    public function pembelian()
    {
        return $this->belongsTo(PembelianHeader::class, 'pembelian_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
