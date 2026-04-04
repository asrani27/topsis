@extends('layouts.app')

@section('title', 'Dashboard - Sistem Penilaian Kinerja Pegawai')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Page Header -->
    <div class="mb-6 sm:mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
        <p class="text-sm sm:text-base text-gray-600">Selamat datang di Sistem Penilaian Kinerja Pegawai menggunakan
            Metode TOPSIS</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <!-- Total Pegawai -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow cursor-pointer"
            onclick="window.location.href='{{ route('admin.pegawai') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Total Pegawai</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800 mt-1">{{ $totalPegawai }}</p>
                    <p class="text-green-600 text-xs sm:text-sm mt-2 hidden sm:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        Total pegawai
                    </p>
                </div>
                <div class="bg-blue-100 p-2 sm:p-3 rounded-full flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kriteria -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border-l-4 border-teal-500 hover:shadow-xl transition-shadow cursor-pointer"
            onclick="window.location.href='{{ route('admin.kriteria') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Total Kriteria</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800 mt-1">{{ $totalKriteria }}</p>
                    <p class="text-gray-500 text-xs sm:text-sm mt-2 hidden sm:block">Semua aktif</p>
                </div>
                <div class="bg-teal-100 p-2 sm:p-3 rounded-full flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-teal-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Penilaian Selesai -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow cursor-pointer"
            onclick="window.location.href='{{ route('admin.penilaian') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Penilaian Selesai</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800 mt-1">{{ $totalPenilaian }}</p>
                    <p class="text-green-600 text-xs sm:text-sm mt-2 hidden sm:block">{{ $penilaianPercentage }}%
                        selesai</p>
                </div>
                <div class="bg-green-100 p-2 sm:p-3 rounded-full flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total User -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow cursor-pointer"
            onclick="window.location.href='{{ route('admin.users') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs sm:text-sm font-medium">Total User</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</p>
                    <p class="text-purple-600 text-xs sm:text-sm mt-2 hidden sm:block">{{ $totalAdmin }} admin, {{
                        $totalRegularUsers }} user</p>
                </div>
                <div class="bg-purple-100 p-2 sm:p-3 rounded-full flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-purple-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Section -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4">Akses Cepat</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                class="bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition-all hover:-translate-y-1 group">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-blue-100 p-2 sm:p-3 rounded-full mb-2 sm:mb-3 group-hover:bg-blue-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">Dashboard</span>
                </div>
            </a>

            <!-- User -->
            <a href="{{ route('admin.users') }}"
                class="bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition-all hover:-translate-y-1 group">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-purple-100 p-2 sm:p-3 rounded-full mb-2 sm:mb-3 group-hover:bg-purple-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">User</span>
                </div>
            </a>

            <!-- Pegawai -->
            <a href="{{ route('admin.pegawai') }}"
                class="bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition-all hover:-translate-y-1 group">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-blue-100 p-2 sm:p-3 rounded-full mb-2 sm:mb-3 group-hover:bg-blue-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">Pegawai</span>
                </div>
            </a>

            <!-- Kriteria -->
            <a href="{{ route('admin.kriteria') }}"
                class="bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition-all hover:-translate-y-1 group">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-teal-100 p-2 sm:p-3 rounded-full mb-2 sm:mb-3 group-hover:bg-teal-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-teal-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">Kriteria</span>
                </div>
            </a>

            <!-- Penilaian -->
            <a href="{{ route('admin.penilaian') }}"
                class="bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition-all hover:-translate-y-1 group">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-green-100 p-2 sm:p-3 rounded-full mb-2 sm:mb-3 group-hover:bg-green-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">Penilaian</span>
                </div>
            </a>

            <!-- Nilai TOPSIS -->
            <a href="{{ route('admin.nilai-topsis') }}"
                class="bg-white rounded-xl shadow-md p-3 sm:p-4 hover:shadow-lg transition-all hover:-translate-y-1 group">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="bg-orange-100 p-2 sm:p-3 rounded-full mb-2 sm:mb-3 group-hover:bg-orange-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-orange-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">Nilai TOPSIS</span>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection