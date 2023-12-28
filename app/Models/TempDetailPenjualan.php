<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDetailPenjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_sepatu',
        'no_penjualan',
        'qty',
        'sub_total'
    ];

    public function Sepatu() {
        return $this->belongsTo(Sepatu::class, 'id_sepatu', 'id');
    }
}
