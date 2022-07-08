<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    public function barang(){
        return $this->belongsTo('App\Models\Barang', 'id_barang', 'id_jenis');
    }
}
