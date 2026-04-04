@extends('layouts.app')

@section('title', 'Nilai TOPSIS - Perhitungan Metode TOPSIS')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Perhitungan Metode TOPSIS</h1>
        <p class="text-gray-600 mt-1">Analisis Penilaian Kinerja Pegawai</p>
    </div>

    <!-- Summary -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 text-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="text-center">
                <div class="text-3xl font-bold">{{ count($rankings) }}</div>
                <div class="text-blue-100 text-sm">Total Pegawai</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold">{{ count($kriterias) }}</div>
                <div class="text-blue-100 text-sm">Kriteria Penilaian</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold">{{ count($rankings) > 0 ? number_format($rankings[0]['preference'] *
                    100, 2) : '0' }}%</div>
                <div class="text-blue-100 text-sm">Nilai Tertinggi</div>
            </div>
        </div>
    </div>

    <!-- Step 1: Decision Matrix -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center text-sm">1</span>
                Matriks Keputusan (Decision Matrix)
            </h2>
        </div>
        <div class="p-6 overflow-x-auto">
            <p class="text-gray-600 mb-4">Matriks keputusan berisi nilai penilaian setiap pegawai untuk setiap kriteria.
            </p>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pegawai</th>
                        @foreach($kriterias as $kriteria)
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $kriteria->nama }}
                            <span class="text-xs font-normal text-gray-400">({{ $kriteria->bobot }}%)</span>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($decisionMatrix as $pegawaiId => $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ collect($rankings)->firstWhere('pegawai_id', $pegawaiId)['nama'] ?? '-' }}
                        </td>
                        @foreach($kriterias as $kriteria)
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($row[$kriteria->id], 2) }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Step 2: Normalized Matrix -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center text-sm">2</span>
                Matriks Normalisasi (Normalized Matrix)
            </h2>
        </div>
        <div class="p-6 overflow-x-auto">
            <p class="text-gray-600 mb-4">Matriks normalisasi diperoleh dengan membagi setiap elemen dengan akar kuadrat
                dari jumlah kuadrat kolom. Rumus: r<sub>ij</sub> = x<sub>ij</sub> / √Σx<sub>ij</sub>²</p>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pegawai</th>
                        @foreach($kriterias as $kriteria)
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $kriteria->nama }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($normalizedMatrix as $pegawaiId => $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ collect($rankings)->firstWhere('pegawai_id', $pegawaiId)['nama'] ?? '-' }}
                        </td>
                        @foreach($kriterias as $kriteria)
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($row[$kriteria->id], 4) }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Step 3: Weighted Normalized Matrix -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center text-sm">3</span>
                Matriks Normalisasi Terbobot (Weighted Normalized Matrix)
            </h2>
        </div>
        <div class="p-6 overflow-x-auto">
            <p class="text-gray-600 mb-4">Matriks normalisasi terbobot diperoleh dengan mengalikan matriks normalisasi
                dengan bobot kriteria. Rumus: y<sub>ij</sub> = w<sub>j</sub> × r<sub>ij</sub></p>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pegawai</th>
                        @foreach($kriterias as $kriteria)
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $kriteria->nama }}
                            <span class="text-xs font-normal text-gray-400">({{ $kriteria->bobot }}%)</span>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($weightedMatrix as $pegawaiId => $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ collect($rankings)->firstWhere('pegawai_id', $pegawaiId)['nama'] ?? '-' }}
                        </td>
                        @foreach($kriterias as $kriteria)
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($row[$kriteria->id], 4) }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Step 4: Ideal Solutions -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center text-sm">4</span>
                Solusi Ideal (Ideal Solutions)
            </h2>
        </div>
        <div class="p-6">
            <p class="text-gray-600 mb-4">Solusi ideal terdiri dari solusi ideal positif (A<sup>+</sup>) dan solusi
                ideal negatif (A<sup>-</sup>).</p>

            <!-- Ideal Positive -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-green-700 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Solusi Ideal Positif (A<sup>+</sup>)
                </h3>
                <div class="bg-green-50 rounded-lg p-4 overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                @foreach($kriterias as $kriteria)
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">
                                    {{ $kriteria->nama }} ({{ $kriteria->tipe }})
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-green-800 font-semibold">
                                @foreach($kriterias as $kriteria)
                                <td class="px-4 py-2 text-sm">
                                    {{ number_format($idealSolutions['positive'][$kriteria->id], 4) }}
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-xs text-gray-500 mt-2">
                    <strong>Benefit:</strong> Nilai maksimum | <strong>Cost:</strong> Nilai minimum
                </p>
            </div>

            <!-- Ideal Negative -->
            <div>
                <h3 class="text-lg font-semibold text-red-700 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Solusi Ideal Negatif (A<sup>-</sup>)
                </h3>
                <div class="bg-red-50 rounded-lg p-4 overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                @foreach($kriterias as $kriteria)
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">
                                    {{ $kriteria->nama }} ({{ $kriteria->tipe }})
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-red-800 font-semibold">
                                @foreach($kriterias as $kriteria)
                                <td class="px-4 py-2 text-sm">
                                    {{ number_format($idealSolutions['negative'][$kriteria->id], 4) }}
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-xs text-gray-500 mt-2">
                    <strong>Benefit:</strong> Nilai minimum | <strong>Cost:</strong> Nilai maksimum
                </p>
            </div>
        </div>
    </div>

    <!-- Step 5: Distances -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center text-sm">5</span>
                Jarak Ke Solusi Ideal (Distance to Ideal Solutions)
            </h2>
        </div>
        <div class="p-6 overflow-x-auto">
            <p class="text-gray-600 mb-4">Menghitung jarak setiap alternatif ke solusi ideal positif dan negatif
                menggunakan rumus Euclidean distance.</p>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pegawai</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            D<sup>+</sup> (Jarak ke A<sup>+</sup>)</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            D<sup>-</sup> (Jarak ke A<sup>-</sup>)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($distances as $pegawaiId => $distance)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ collect($rankings)->firstWhere('pegawai_id', $pegawaiId)['nama'] ?? '-' }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($distance['positive'], 4) }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($distance['negative'], 4) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Step 6: Preference Values -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-pink-600 to-pink-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center text-sm">6</span>
                Nilai Preferensi (Preference Values)
            </h2>
        </div>
        <div class="p-6 overflow-x-auto">
            <p class="text-gray-600 mb-4">Nilai preferensi mengukur kedekatan alternatif dengan solusi ideal positif.
                Rumus: V<sub>i</sub> = D<sub>i</sub><sup>-</sup> / (D<sub>i</sub><sup>+</sup> +
                D<sub>i</sub><sup>-</sup>)</p>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pegawai</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai
                            Preferensi (V)</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Persentase</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($preferences as $pegawaiId => $preference)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ collect($rankings)->firstWhere('pegawai_id', $pegawaiId)['nama'] ?? '-' }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($preference, 4) }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($preference * 100, 2) }}%
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Step 7: Ranking -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="bg-white/20 w-8 h-8 rounded-full flex items-center justify-center text-sm">7</span>
                Ranking Akhir (Final Ranking)
            </h2>
        </div>
        <div class="p-6 overflow-x-auto">
            <p class="text-gray-600 mb-4">Ranking diurutkan berdasarkan nilai preferensi tertinggi. Semakin tinggi nilai
                preferensi, semakin baik kinerja pegawai.</p>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pegawai</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jabatan</th>

                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai
                            Preferensi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Persentase</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($rankings as $ranking)
                    <tr class="hover:bg-gray-50 {{ $ranking['rank'] <= 3 ? 'bg-yellow-50' : '' }}">
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($ranking['rank'] === 1)
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-400 text-white font-bold">
                                🥇
                            </span>
                            @elseif($ranking['rank'] === 2)
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-400 text-white font-bold">
                                🥈
                            </span>
                            @elseif($ranking['rank'] === 3)
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-amber-600 text-white font-bold">
                                🥉
                            </span>
                            @else
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 text-gray-700 font-bold">
                                {{ $ranking['rank'] }}
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $ranking['nama'] }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ $ranking['nip'] }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ $ranking['jabatan'] }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-900">
                            {{ number_format($ranking['preference'], 4) }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $ranking['preference'] >= 0.7 ? 'bg-green-100 text-green-800' : ($ranking['preference'] >= 0.5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ number_format($ranking['preference'] * 100, 2) }}%
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Legend -->
    <div class="bg-blue-50 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Legenda Kriteria</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h4 class="font-medium text-green-700 mb-2">Tipe Benefit (Semakin tinggi semakin baik):</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    @foreach($kriterias as $kriteria)
                    @if($kriteria->tipe == 'benefit')
                    <li>• {{ $kriteria->nama }} (Bobot: {{ $kriteria->bobot }}%)</li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-red-700 mb-2">Tipe Cost (Semakin rendah semakin baik):</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    @foreach($kriterias as $kriteria)
                    @if($kriteria->tipe == 'cost')
                    <li>• {{ $kriteria->nama }} (Bobot: {{ $kriteria->bobot }}%)</li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection