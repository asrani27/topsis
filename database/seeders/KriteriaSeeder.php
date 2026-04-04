<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriterias = [
            [
                'nama' => 'Kedisiplinan',
                'bobot' => 40.00,
                'tipe' => 'benefit',
            ],
            [
                'nama' => 'Kejujuran',
                'bobot' => 30.00,
                'tipe' => 'benefit',
            ],
            [
                'nama' => 'Tanggung Jawab',
                'bobot' => 20.00,
                'tipe' => 'benefit',
            ],
            [
                'nama' => 'Loyalitas',
                'bobot' => 10.00,
                'tipe' => 'cost',
            ],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}