<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function barangmasuk(){
        return $this->hasOne(BarangMasuk::class);
    }

    public function barangkeluar(){
        return $this->hasOne(BarangKeluar::class);
    }
}
