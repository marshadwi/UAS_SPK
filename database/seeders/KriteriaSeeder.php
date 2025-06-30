<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama untuk menghindari duplikat saat seeding ulang
        Kriteria::query()->delete();


        $kriterias = [
            ['kode_kriteria' => 'C1', 'nama_kriteria' => 'Nilai Kehadiran', 'bobot' => 0.20, 'tipe' => 'benefit'],
            ['kode_kriteria' => 'C2', 'nama_kriteria' => 'Nilai Akademik', 'bobot' => 0.30, 'tipe' => 'benefit'],
            ['kode_kriteria' => 'C3', 'nama_kriteria' => 'Sikap', 'bobot' => 0.25, 'tipe' => 'benefit'],
            ['kode_kriteria' => 'C4', 'nama_kriteria' => 'Keaktifan Ekstrakurikuler', 'bobot' => 0.15, 'tipe' => 'benefit'],
            ['kode_kriteria' => 'C5', 'nama_kriteria' => 'Prestasi Non-Akademik', 'bobot' => 0.10, 'tipe' => 'benefit'],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}