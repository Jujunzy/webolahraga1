<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    use HasFactory;
    protected $table = 'pelatihs';
    protected $fillable = ['pelatih','pengalaman','kontak'];

    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }
}
