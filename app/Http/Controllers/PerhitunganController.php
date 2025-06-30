<?php
namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();
        $alternatifs = Alternatif::with('kriteria')->get();

        if ($kriterias->isEmpty() || $alternatifs->isEmpty() || $alternatifs->first()->kriteria->isEmpty()) {
            return view('perhitungan.index')->with('error', 'Data kriteria atau alternatif belum lengkap untuk perhitungan.');
        }

        // 1. MATRIKS KEPUTUSAN (X)
        $matriks_x = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $nilaiPivot = $alternatif->kriteria()->where('kriteria_id', $kriteria->id)->first()->pivot->nilai ?? 0;
                $matriks_x[$alternatif->id][$kriteria->id] = $nilaiPivot;
            }
        }

        // 2. NORMALISASI MATRIKS (R)
        $normalized_matrix = [];
        foreach ($kriterias as $kriteria) {
            $column_values = array_column(array_values($matriks_x), $kriteria->id);
            
            if (empty($column_values)) continue;
            
            $max_val = max($column_values);
            $min_val = min($column_values);

            foreach ($alternatifs as $alternatif) {
                $nilai = $matriks_x[$alternatif->id][$kriteria->id];
                if ($kriteria->tipe == 'benefit') {
                    $normalized_matrix[$alternatif->id][$kriteria->id] = ($max_val > 0) ? $nilai / $max_val : 0;
                } else { // 'cost'
                    $normalized_matrix[$alternatif->id][$kriteria->id] = ($nilai > 0) ? $min_val / $nilai : 0;
                }
            }
        }

        // 3. PERHITUNGAN RANKING (V)
        $rankings = [];
        foreach ($alternatifs as $alternatif) {
            $final_score = 0;
            foreach ($kriterias as $kriteria) {
                $final_score += $normalized_matrix[$alternatif->id][$kriteria->id] * $kriteria->bobot;
            }
            $rankings[] = [
                'nama_karyawan' => $alternatif->nama_karyawan,
                'nilai_saw' => $final_score
            ];
        }
        
        // Urutkan hasil ranking dari yang terbesar
        usort($rankings, fn($a, $b) => $b['nilai_saw'] <=> $a['nilai_saw']);

        return view('perhitungan.index', compact('alternatifs', 'kriterias', 'normalized_matrix', 'rankings', 'matriks_x'));
    }
}