@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Tambah Pegawai</h1>
        <p class="text-gray-600 mt-1">Tambahkan pegawai baru ke sistem</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.pegawai.store') }}" method="POST">
            @csrf

            <!-- NIP Field -->
            <div class="mb-6">
                <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                    NIP
                </label>
                <input
                    type="text"
                    name="nip"
                    id="nip"
                    value="{{ old('nip') }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('nip') border-red-500 @enderror"
                    placeholder="Masukkan NIP"
                >
                @error('nip')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Field -->
            <div class="mb-6">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    value="{{ old('nama') }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('nama') border-red-500 @enderror"
                    placeholder="Masukkan nama lengkap"
                >
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenis Kelamin Field -->
            <div class="mb-6">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Kelamin
                </label>
                <select
                    name="jenis_kelamin"
                    id="jenis_kelamin"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('jenis_kelamin') border-red-500 @enderror"
                >
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jabatan Field -->
            <div class="mb-6">
                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                    Jabatan
                </label>
                <input
                    type="text"
                    name="jabatan"
                    id="jabatan"
                    value="{{ old('jabatan') }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('jabatan') border-red-500 @enderror"
                    placeholder="Masukkan jabatan"
                >
                @error('jabatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Telepon Field -->
            <div class="mb-6">
                <label for="telp" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Telepon
                </label>
                <input
                    type="text"
                    name="telp"
                    id="telp"
                    value="{{ old('telp') }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('telp') border-red-500 @enderror"
                    placeholder="Masukkan nomor telepon"
                >
                @error('telp')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat Field -->
            <div class="mb-6">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat
                </label>
                <textarea
                    name="alamat"
                    id="alamat"
                    rows="4"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('alamat') border-red-500 @enderror resize-none"
                    placeholder="Masukkan alamat lengkap"
                >{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-4">
                <a href="{{ route('admin.pegawai') }}" class="inline-flex items-center gap-2 px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">
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