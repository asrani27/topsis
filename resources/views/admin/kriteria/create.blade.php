@extends('layouts.app')

@section('title', 'Tambah Kriteria')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Tambah Kriteria</h1>
        <p class="text-gray-600 mt-1">Tambahkan kriteria penilaian baru</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.kriteria.store') }}" method="POST">
            @csrf

            <!-- Nama Field -->
            <div class="mb-6">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kriteria
                </label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    value="{{ old('nama') }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('nama') border-red-500 @enderror"
                    placeholder="Masukkan nama kriteria"
                >
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bobot Field -->
            <div class="mb-6">
                <label for="bobot" class="block text-sm font-medium text-gray-700 mb-2">
                    Bobot (%)
                </label>
                <input
                    type="number"
                    name="bobot"
                    id="bobot"
                    value="{{ old('bobot') }}"
                    step="0.01"
                    min="0"
                    max="100"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('bobot') border-red-500 @enderror"
                    placeholder="Masukkan bobot (0-100)"
                >
                @error('bobot')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Nilai bobot antara 0 sampai 100</p>
            </div>

            <!-- Tipe Field -->
            <div class="mb-6">
                <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipe Kriteria
                </label>
                <select
                    name="tipe"
                    id="tipe"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('tipe') border-red-500 @enderror"
                >
                    <option value="">Pilih Tipe Kriteria</option>
                    <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit (Makin tinggi makin baik)</option>
                    <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost (Makin rendah makin baik)</option>
                </select>
                @error('tipe')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-blue-800 mb-1">Informasi Tipe Kriteria</h4>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li><strong>Benefit:</strong> Nilai yang lebih tinggi dianggap lebih baik (contoh: kinerja, kehadiran)</li>
                            <li><strong>Cost:</strong> Nilai yang lebih rendah dianggap lebih baik (contoh: jumlah ketidakhadiran, jumlah pelanggaran)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-4">
                <a href="{{ route('admin.kriteria') }}" class="inline-flex items-center gap-2 px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection