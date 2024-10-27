<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    use HasFactory;
    protected $table = 'latihans';
    protected $fillable = ['anggota_id','jenis_id','tanggal','durasi'];

    public function anggota(){
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
    public function jenis(){
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}
