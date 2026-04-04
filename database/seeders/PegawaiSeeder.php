<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawais = [
            [
                'nip' => '198501012010011001',
                'nama' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Kepala Bagian Keuangan',
                'telp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta Pusat',
            ],
            [
                'nip' => '198805152011011002',
                'nama' => 'Siti Rahayu',
                'jenis_kelamin' => 'Perempuan',
                'jabatan' => 'Kepala Bagian SDM',
                'telp' => '082345678901',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta Selatan',
            ],
            [
                'nip' => '199003202012011003',
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Staff IT',
                'telp' => '083456789012',
                'alamat' => 'Jl. Gatot Subroto No. 78, Jakarta Pusat',
            ],
            [
                'nip' => '199207122013011004',
                'nama' => 'Dewi Kartika',
                'jenis_kelamin' => 'Perempuan',
                'jabatan' => 'Staff Administrasi',
                'telp' => '084567890123',
                'alamat' => 'Jl. Thamrin No. 56, Jakarta Pusat',
            ],
            [
                'nip' => '198910082011011005',
                'nama' => 'Eko Prasetyo',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Staff Keuangan',
                'telp' => '085678901234',
                'alamat' => 'Jl. Hayam Wuruk No. 90, Jakarta Barat',
            ],
            [
                'nip' => '199104112012011006',
                'nama' => 'Fitriani',
                'jenis_kelamin' => 'Perempuan',
                'jabatan' => 'Staff SDM',
                'telp' => '086789012345',
                'alamat' => 'Jl. Kebagusan No. 12, Jakarta Selatan',
            ],
            [
                'nip' => '198802252011011007',
                'nama' => 'Gunawan',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Kepala Bagian Operasional',
                'telp' => '087890123456',
                'alamat' => 'Jl. Cempaka Putih No. 34, Jakarta Pusat',
            ],
            [
                'nip' => '199509182016011008',
                'nama' => 'Hesti Lestari',
                'jenis_kelamin' => 'Perempuan',
                'jabatan' => 'Staff Operasional',
                'telp' => '088901234567',
                'alamat' => 'Jl. Pemuda No. 67, Jakarta Timur',
            ],
            [
                'nip' => '199206302013011009',
                'nama' => 'Indra Wijaya',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Staff IT',
                'telp' => '089012345678',
                'alamat' => 'Jl. Diponegoro No. 23, Jakarta Pusat',
            ],
            [
                'nip' => '199308172014011010',
                'nama' => 'Juniarti',
                'jenis_kelamin' => 'Perempuan',
                'jabatan' => 'Staff Administrasi',
                'telp' => '081234567891',
                'alamat' => 'Jl. Rasuna Said No. 89, Jakarta Selatan',
            ],
        ];

        foreach ($pegawais as $pegawai) {
            Pegawai::create($pegawai);
        }
    }
}