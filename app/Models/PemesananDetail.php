<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    use HasFactory;

    public function barang(){
        return $this->belongsTo('App\Models\Barang', 'id_barang', 'id_jenis');
    }

    public function pemesanan(){
        return $this->belongsTo('App\Models\Pemesanan', 'pesanan_id', 'id');
    }
}
