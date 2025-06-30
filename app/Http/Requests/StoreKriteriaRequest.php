<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Kriteria;

class StoreKriteriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // Ubah koma jadi titik jika user input desimal dengan koma
        $this->merge([
            'bobot' => str_replace(',', '.', $this->bobot),
        ]);
    }

    public function rules(): array
    {
        return [
            'kode_kriteria' => 'required|max:10|unique:kriterias,kode_kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    $totalBobot = Kriteria::sum('bobot');
                    
                    // Gunakan penjumlahan presisi tinggi
                    $totalBaru = bcadd($totalBobot, $value, 4);

                    // Bandingkan total baru dengan 1
                    if (bccomp($totalBaru, 1, 4) === 1) {
                        $sisa = bcsub(1, $totalBobot, 4);
                        $fail("Total bobot semua kriteria tidak boleh melebihi 1. Sisa bobot yang tersedia adalah {$sisa}.");
                    }
                },
            ],
            'tipe' => 'required|in:benefit,cost',
        ];
    }

    public function messages(): array
    {
        return [
            'kode_kriteria.required' => 'Kode kriteria wajib diisi.',
            'kode_kriteria.unique' => 'Kode kriteria sudah digunakan.',
            'nama_kriteria.required' => 'Nama kriteria wajib diisi.',
            'bobot.required' => 'Bobot wajib diisi.',
            'bobot.numeric' => 'Bobot harus berupa angka (gunakan titik).',
            'tipe.required' => 'Tipe kriteria wajib dipilih.',
        ];
    }
}
