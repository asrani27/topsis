<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $selectedKriteria = $request->input('kriteria_id');

        $pegawais = Pegawai::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            })
            ->orderBy('nama', 'asc')
            ->paginate(10);

        $kriterias = Kriteria::orderBy('nama')->get();

        return view('admin.penilaian.index', compact('pegawais', 'kriterias', 'search', 'selectedKriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $kriterias = Kriteria::orderBy('nama')->get();

        // Get existing penilaians for this pegawai
        $penilaians = Penilaian::where('pegawai_id', $pegawai->id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kriteria_id => (string) number_format($item->nilai, 2, '.', '')];
            })
            ->toArray();

        return view('admin.penilaian.edit', compact('pegawai', 'kriterias', 'penilaians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'kriteria_id' => 'required|array',
            'kriteria_id.*' => 'exists:kriterias,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0|max:100',
        ], [
            'kriteria_id.required' => 'Kriteria wajib dipilih',
            'kriteria_id.*.exists' => 'Kriteria tidak valid',
            'nilai.required' => 'Nilai wajib diisi',
            'nilai.*.required' => 'Nilai wajib diisi',
            'nilai.*.numeric' => 'Nilai harus berupa angka',
            'nilai.*.min' => 'Nilai minimal 0',
            'nilai.*.max' => 'Nilai maksimal 100',
        ]);

        // Loop through each kriteria and update/create penilaian
        foreach ($validated['kriteria_id'] as $index => $kriteriaId) {
            $nilai = number_format((float) $validated['nilai'][$index], 2, '.', '');

            // Check if penilaian exists
            $penilaian = Penilaian::where('pegawai_id', $pegawai->id)
                ->where('kriteria_id', $kriteriaId)
                ->first();

            if ($penilaian) {
                // Update existing
                $penilaian->nilai = $nilai;
                $penilaian->save();
            } else {
                // Create new
                Penilaian::create([
                    'pegawai_id' => $pegawai->id,
                    'kriteria_id' => $kriteriaId,
                    'nilai' => $nilai,
                ]);
            }
        }

        return redirect()->route('admin.penilaian')
            ->with('success', 'Penilaian pegawai berhasil disimpan');
    }
}
