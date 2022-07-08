<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alamat',
        'provinsi',
        'kota',
        'kode_pos',
    ];
    public function user(){
        return $this->hasMany(User::class);
    }
}
