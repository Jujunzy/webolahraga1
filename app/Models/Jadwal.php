<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwals';
    protected $fillable = ['pelatih_id','jenis_id','tanggal'];

    public function pelatih(){ //mengambil relasi dari tabel pelatih menggunakan belongsto
        return $this->belongsTo(Pelatih::class, 'pelatih_id');
    }

    public function jenis(){
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}
