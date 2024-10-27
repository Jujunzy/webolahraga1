<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = ['event','tanggal','lokasi','kategori'];

    public function pemenang(){  //relasi dengan tabel pemenang
        return $this->hasMany(Pemenang::class);
    }
}
