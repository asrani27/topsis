<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of pegawai with search functionality.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pegawais = Pegawai::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%")
                    ->orWhere('telp', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.pegawai.index', compact('pegawais', 'search'));
    }

    /**
     * Show the form for creating a new pegawai.
     */
    public function create()
    {
        return view('admin.pegawai.create');
    }

    /**
     * Store a newly created pegawai in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => ['required', 'string', 'unique:pegawais,nip'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'jabatan' => ['required', 'string', 'max:255'],
            'telp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
        ]);

        Pegawai::create($validated);

        return redirect()->route('admin.pegawai')
            ->with('success', 'Pegawai berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified pegawai.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified pegawai in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nip' => ['required', 'string', 'unique:pegawais,nip,' . $pegawai->id],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'jabatan' => ['required', 'string', 'max:255'],
            'telp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
        ]);

        $pegawai->update($validated);

        return redirect()->route('admin.pegawai')
            ->with('success', 'Pegawai berhasil diperbarui');
    }

    /**
     * Remove the specified pegawai from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('admin.pegawai')
            ->with('success', 'Pegawai berhasil dihapus');
    }
}