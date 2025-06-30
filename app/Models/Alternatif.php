<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternatif extends Model
{
     use HasFactory;
    protected $fillable = ['nama_karyawan'];

    // Definisikan relasi Many-to-Many ke Kriteria
    public function kriteria()

     {
        // 'withPivot' memberitahu Laravel untuk juga mengambil kolom 'nilai' dari tabel pivot
        return $this->belongsToMany(Kriteria::class, 'alternatif_kriteria')->withPivot('nilai')->withTimestamps();
    }
}
