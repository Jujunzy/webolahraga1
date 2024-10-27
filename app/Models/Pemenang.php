<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemenang extends Model
{
    use HasFactory;
    protected $table = 'pemenangs';
    protected $fillable = ['event_id','anggota_id','posisi'];

    public function event(){ //mengambil relasi dari tabel event menggunakan belongsto
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function anggota(){
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

}
