<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_member',
        'id_kasir',
        'tanggal_bayar',
        'jumlah_bayar',
        'pembeli_bayar',
        'no_penjualan',
        'total',
        'diskon',
        'kembalian',
    ];

    public function Member() {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    public function Sepatu() {
        return $this->belongsTo(Sepatu::class, 'id_sepatu', 'id');
    }

    public function Kasir() {
        return $this->belongsTo(User::class, 'id_kasir', 'id');
    }
}
