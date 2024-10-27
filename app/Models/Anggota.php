<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggotas';
    protected $fillable = ['anggota','jk','usia','kontak'];

    public function latihan(){ //relasi dengan tabel latihan
        return $this->hasMany(Latihan::class);
    }

    public function pemenang(){ //relasi dengan table pemenang
        return $this->hasMany(Pemenang::class);
    }
}
