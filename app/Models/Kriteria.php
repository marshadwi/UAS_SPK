<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    // Menentukan field yang boleh diisi secara mass-assignment
    protected $fillable = ['kode_kriteria', 'nama_kriteria', 'bobot', 'tipe'];

    // Otomatis konversi 'bobot' menjadi float saat dibaca/disimpan
    protected $casts = [
        'bobot' => 'float',
    ];
}
