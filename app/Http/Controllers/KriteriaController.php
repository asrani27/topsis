<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $kriterias = Kriteria::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('tipe', 'like', "%{$search}%");
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.kriteria.index', compact('kriterias', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'tipe' => 'required|in:benefit,cost',
        ], [
            'nama.required' => 'Nama kriteria wajib diisi',
            'nama.max' => 'Nama kriteria maksimal 255 karakter',
            'bobot.required' => 'Bobot wajib diisi',
            'bobot.numeric' => 'Bobot harus berupa angka',
            'bobot.min' => 'Bobot minimal 0',
            'bobot.max' => 'Bobot maksimal 100',
            'tipe.required' => 'Tipe kriteria wajib dipilih',
            'tipe.in' => 'Tipe kriteria harus benefit atau cost',
        ]);

        Kriteria::create($validated);

        return redirect()->route('admin.kriteria')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'tipe' => 'required|in:benefit,cost',
        ], [
            'nama.required' => 'Nama kriteria wajib diisi',
            'nama.max' => 'Nama kriteria maksimal 255 karakter',
            'bobot.required' => 'Bobot wajib diisi',
            'bobot.numeric' => 'Bobot harus berupa angka',
            'bobot.min' => 'Bobot minimal 0',
            'bobot.max' => 'Bobot maksimal 100',
            'tipe.required' => 'Tipe kriteria wajib dipilih',
            'tipe.in' => 'Tipe kriteria harus benefit atau cost',
        ]);

        $kriteria->update($validated);

        return redirect()->route('admin.kriteria')
            ->with('success', 'Kriteria berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return redirect()->route('admin.kriteria')
            ->with('success', 'Kriteria berhasil dihapus');
    }
}