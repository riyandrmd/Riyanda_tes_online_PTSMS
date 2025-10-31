<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

     protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stok',
        'harga',
    ];

    public function pembelianDetails()
    {
        return $this->hasMany(PembelianDetail::class, 'barang_id');
    }
}
