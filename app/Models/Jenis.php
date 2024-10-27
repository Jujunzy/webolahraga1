<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    protected $table = 'jenis';
    protected $fillable = ['jenis','deskripsi','gambar'];

    public function latihan(){ //diambil untuk direlasikan dengan tabel latihan
        return $this->hasMany(Latihan::class);
    }

    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }
}
