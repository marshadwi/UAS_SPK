<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          // 1. Ambil semua data kriteria untuk membuat header tabel secara dinamis.
        // Diurutkan berdasarkan kode agar konsisten (C1, C2, C3, ...)
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();

        // 2. Ambil semua data alternatif beserta relasi kriteria-nya (Eager Loading).
        // Eager loading `with('kriteria')` sangat penting untuk performa agar tidak terjadi N+1 query problem.
        $alternatifs = Alternatif::with('kriteria')->orderBy('nama_karyawan')->get();

        // 3. Kirim kedua data tersebut ke view.
        return view('alternatif.index', compact('alternatifs', 'kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          // Ambil semua kriteria untuk ditampilkan di form
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();
        return view('alternatif.create', compact('kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'nama_karyawan' => 'required|string|max:255',
        'kriteria_nilai' => 'required|array',
        'kriteria_nilai.*' => 'required|numeric',
     ]);
        $alternatif = Alternatif::create(['nama_karyawan' => $request->nama_karyawan]);

            // Loop untuk menyimpan ke tabel pivot
    foreach ($request->kriteria_nilai as $kriteria_id => $nilai) {
        $alternatif->kriteria()->attach($kriteria_id, ['nilai' => $nilai]);
    }

        return redirect()->route('alternatif.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternatif $alternatif)
    {
         $kriterias = Kriteria::orderBy('kode_kriteria')->get();
    // Eager load nilai kriteria karyawan untuk ditampilkan di form
    $alternatif->load('kriteria'); 
    return view('alternatif.edit', compact('alternatif', 'kriterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternatif $alternatif)
    {
          $request->validate([
        'nama_karyawan' => 'required|string|max:255',
        'kriteria_nilai' => 'required|array',
        'kriteria_nilai.*' => 'required|numeric|min:0',
    ]);

       // Update nama karyawan
    $alternatif->update(['nama_karyawan' => $request->nama_karyawan]);

     // Update nilai di tabel pivot menggunakan sync()
    // sync() akan menghapus relasi lama dan membuat yang baru, sangat efisien untuk update.
    $pivotData = [];
        foreach ($request->kriteria_nilai as $kriteria_id => $nilai) {
            $pivotData[$kriteria_id] = ['nilai' => $nilai];
        }
        $alternatif->kriteria()->sync($pivotData);

    return redirect()->route('alternatif.index')->with('success', 'Data karyawan berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternatif $alternatif)
    {
        // Karena kita pakai onDelete('cascade'), nilai di tabel pivot akan ikut terhapus
    $alternatif->delete();
    return redirect()->route('alternatif.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
