<?php

namespace Database\Seeders;

use App\Models\Penilaian;
use App\Models\Pegawai;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all pegawai and kriteria
        $pegawais = Pegawai::all();
        $kriterias = Kriteria::all();

        // Penilaian data for each pegawai
        // Format: [pegawai_index => [kedisiplinan, kejujuran, tanggung_jawab, loyalitas]]
        $penilaianData = [
            // Ahmad Fauzi - Kepala Bagian Keuangan (Excellent performer)
            [
                'kedisiplinan' => 95.50,
                'kejujuran' => 94.00,
                'tanggung_jawab' => 93.50,
                'loyalitas' => 2.50, // Cost criteria - lower is better
            ],
            // Siti Rahayu - Kepala Bagian SDM (Excellent performer)
            [
                'kedisiplinan' => 94.25,
                'kejujuran' => 95.00,
                'tanggung_jawab' => 94.75,
                'loyalitas' => 2.00,
            ],
            // Budi Santoso - Staff IT (Good performer)
            [
                'kedisiplinan' => 88.50,
                'kejujuran' => 90.00,
                'tanggung_jawab' => 87.75,
                'loyalitas' => 4.50,
            ],
            // Dewi Kartika - Staff Administrasi (Good performer)
            [
                'kedisiplinan' => 91.00,
                'kejujuran' => 89.50,
                'tanggung_jawab' => 90.25,
                'loyalitas' => 3.50,
            ],
            // Eko Prasetyo - Staff Keuangan (Average performer)
            [
                'kedisiplinan' => 85.50,
                'kejujuran' => 84.00,
                'tanggung_jawab' => 83.75,
                'loyalitas' => 6.00,
            ],
            // Fitriani - Staff SDM (Good performer)
            [
                'kedisiplinan' => 90.50,
                'kejujuran' => 88.75,
                'tanggung_jawab' => 89.50,
                'loyalitas' => 4.00,
            ],
            // Gunawan - Kepala Bagian Operasional (Excellent performer)
            [
                'kedisiplinan' => 93.75,
                'kejujuran' => 92.50,
                'tanggung_jawab' => 94.00,
                'loyalitas' => 3.00,
            ],
            // Hesti Lestari - Staff Operasional (Average performer)
            [
                'kedisiplinan' => 84.00,
                'kejujuran' => 82.50,
                'tanggung_jawab' => 83.00,
                'loyalitas' => 7.50,
            ],
            // Indra Wijaya - Staff IT (Good performer)
            [
                'kedisiplinan' => 89.00,
                'kejujuran' => 91.25,
                'tanggung_jawab' => 88.50,
                'loyalitas' => 5.00,
            ],
            // Juniarti - Staff Administrasi (Average performer)
            [
                'kedisiplinan' => 86.50,
                'kejujuran' => 85.25,
                'tanggung_jawab' => 86.00,
                'loyalitas' => 5.50,
            ],
        ];

        // Map kriteria IDs
        $kriteriaMap = [];
        foreach ($kriterias as $kriteria) {
            $kriteriaMap[$kriteria->nama] = $kriteria->id;
        }

        // Create penilaian for each pegawai
        foreach ($pegawais as $index => $pegawai) {
            $data = $penilaianData[$index] ?? null;
            
            if ($data) {
                // Create or update penilaian for each kriteria
                Penilaian::updateOrCreate(
                    [
                        'pegawai_id' => $pegawai->id,
                        'kriteria_id' => $kriteriaMap['Kedisiplinan'],
                    ],
                    [
                        'nilai' => $data['kedisiplinan'],
                    ]
                );

                Penilaian::updateOrCreate(
                    [
                        'pegawai_id' => $pegawai->id,
                        'kriteria_id' => $kriteriaMap['Kejujuran'],
                    ],
                    [
                        'nilai' => $data['kejujuran'],
                    ]
                );

                Penilaian::updateOrCreate(
                    [
                        'pegawai_id' => $pegawai->id,
                        'kriteria_id' => $kriteriaMap['Tanggung Jawab'],
                    ],
                    [
                        'nilai' => $data['tanggung_jawab'],
                    ]
                );

                Penilaian::updateOrCreate(
                    [
                        'pegawai_id' => $pegawai->id,
                        'kriteria_id' => $kriteriaMap['Loyalitas'],
                    ],
                    [
                        'nilai' => $data['loyalitas'],
                    ]
                );
            }
        }
    }
}