@extends('layouts.app')

@section('title', 'Nilai Pegawai')

@section('content')
<div class="mb-6">
    <!-- Breadcrumb -->
    <nav class="flex text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.penilaian') }}" class="hover:text-blue-600 transition-colors">Penilaian</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Nilai Pegawai</span>
    </nav>

    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Nilai Pegawai</h1>
    <p class="text-gray-600 mt-1">Isi penilaian kinerja untuk {{ $pegawai->nama }}</p>
</div>

<!-- Employee Info Card -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 mb-6 text-white">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="bg-white/20 p-3 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold">{{ $pegawai->nama }}</h2>
                <p class="text-blue-100">NIP: {{ $pegawai->nip }}</p>
                <p class="text-blue-100">Jabatan: {{ $pegawai->jabatan }}</p>
            </div>
        </div>
        <a href="{{ route('admin.penilaian') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition-colors font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>
</div>

<!-- Form -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <form action="{{ route('admin.penilaian.update', $pegawai) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Kriteria List -->
        <div class="divide-y divide-gray-200">
            @foreach($kriterias as $index => $kriteria)
            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                    <!-- Kriteria Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full text-sm font-bold">
                                {{ $index + 1 }}
                            </span>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $kriteria->nama }}</h3>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-2 ml-10">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700">
                                Bobot: {{ number_format($kriteria->bobot, 2) }}%
                            </span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $kriteria->tipe === 'benefit' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $kriteria->tipe === 'benefit' ? 'Benefit' : 'Cost' }}
                            </span>
                        </div>
                    </div>

                    <!-- Nilai Input -->
                    <div class="w-full sm:w-48">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nilai (0-100)</label>

                        <input type="number" name="nilai[]" value="{{ $penilaians[$kriteria->id] ?? '' }}" min="0"
                            max="100" step="0.0001" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all text-right font-medium"
                            placeholder="0 - 100">
                        <input type="hidden" name="kriteria_id[]" value="{{ $kriteria->id }}">
                        @error('nilai.' . $index)
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Submit Button -->
        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('admin.penilaian') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 rounded-lg font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Penilaian
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Info Box -->
<div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm text-yellow-800">
                <span class="font-semibold">Catatan:</span> Nilai berkisar antara 0-100. Kriteria
                <strong>Benefit</strong> akan memberikan nilai lebih tinggi untuk pegawai yang lebih baik, sedangkan
                kriteria <strong>Cost</strong> akan memberikan nilai lebih rendah untuk pegawai yang lebih baik.
            </p>
        </div>
    </div>
</div>
@endsection