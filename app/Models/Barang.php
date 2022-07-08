<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public function pemesanan_detail(){
        return $this->hasMany('App\Models\PemesananDetail', 'id_barang', 'id');
    }
    public function jenis_barang(){
        return $this->hasMany('App\Models\JenisBarang', 'id_barang', 'id_jenis');
    }
    public function kategori(){
        return $this->hasMany('App\Models\Kategori', 'id_barang', 'id_kateg');
    }
}
