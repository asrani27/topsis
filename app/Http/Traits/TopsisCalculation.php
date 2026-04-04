<?php

namespace App\Http\Traits;

trait TopsisCalculation
{
    /**
     * Calculate TOPSIS for all employees
     */
    public function calculateTopsis()
    {
        // Get all pegawais
        $pegawais = \App\Models\Pegawai::orderBy('nama')->get();
        
        // Get all kriterias with weights
        $kriterias = \App\Models\Kriteria::orderBy('id')->get();
        
        // Step 1: Build Decision Matrix
        $decisionMatrix = $this->buildDecisionMatrix($pegawais, $kriterias);
        
        // Step 2: Normalize Matrix
        $normalizedMatrix = $this->normalizeMatrix($decisionMatrix, $kriterias);
        
        // Step 3: Weighted Normalization
        $weightedMatrix = $this->applyWeights($normalizedMatrix, $kriterias);
        
        // Step 4: Ideal Solutions
        $idealSolutions = $this->calculateIdealSolutions($weightedMatrix, $kriterias);
        
        // Step 5: Distance to Ideal Solutions
        $distances = $this->calculateDistances($weightedMatrix, $idealSolutions);
        
        // Step 6: Preference Values
        $preferences = $this->calculatePreferences($distances);
        
        // Step 7: Ranking
        $rankings = $this->calculateRanking($preferences, $pegawais);
        
        return [
            'decisionMatrix' => $decisionMatrix,
            'normalizedMatrix' => $normalizedMatrix,
            'weightedMatrix' => $weightedMatrix,
            'idealSolutions' => $idealSolutions,
            'distances' => $distances,
            'preferences' => $preferences,
            'rankings' => $rankings,
            'kriterias' => $kriterias,
        ];
    }
    
    /**
     * Step 1: Build Decision Matrix
     */
    private function buildDecisionMatrix($pegawais, $kriterias)
    {
        $matrix = [];
        
        foreach ($pegawais as $pegawai) {
            $row = [];
            foreach ($kriterias as $kriteria) {
                $penilaian = \App\Models\Penilaian::where('pegawai_id', $pegawai->id)
                    ->where('kriteria_id', $kriteria->id)
                    ->first();
                $row[$kriteria->id] = $penilaian ? (float) $penilaian->nilai : 0;
            }
            $matrix[$pegawai->id] = $row;
        }
        
        return $matrix;
    }
    
    /**
     * Step 2: Normalize Matrix
     */
    private function normalizeMatrix($matrix, $kriterias)
    {
        $normalized = [];
        $dividers = [];
        
        // Calculate dividers (square root of sum of squares)
        foreach ($kriterias as $kriteria) {
            $sum = 0;
            foreach ($matrix as $pegawaiId => $row) {
                $sum += pow($row[$kriteria->id], 2);
            }
            $dividers[$kriteria->id] = sqrt($sum);
        }
        
        // Normalize each value
        foreach ($matrix as $pegawaiId => $row) {
            $normalized[$pegawaiId] = [];
            foreach ($kriterias as $kriteria) {
                $normalized[$pegawaiId][$kriteria->id] = 
                    $dividers[$kriteria->id] > 0 
                        ? $row[$kriteria->id] / $dividers[$kriteria->id] 
                        : 0;
            }
        }
        
        return $normalized;
    }
    
    /**
     * Step 3: Apply Weights to Normalized Matrix
     */
    private function applyWeights($normalizedMatrix, $kriterias)
    {
        $weighted = [];
        
        foreach ($normalizedMatrix as $pegawaiId => $row) {
            $weighted[$pegawaiId] = [];
            foreach ($kriterias as $kriteria) {
                $weighted[$pegawaiId][$kriteria->id] = 
                    $row[$kriteria->id] * ($kriteria->bobot / 100);
            }
        }
        
        return $weighted;
    }
    
    /**
     * Step 4: Calculate Ideal Solutions (Positive and Negative)
     */
    private function calculateIdealSolutions($weightedMatrix, $kriterias)
    {
        $idealPositive = [];
        $idealNegative = [];
        
        foreach ($kriterias as $kriteria) {
            $values = [];
            foreach ($weightedMatrix as $pegawaiId => $row) {
                $values[] = $row[$kriteria->id];
            }
            
            if ($kriteria->tipe == 'benefit') {
                // For benefit criteria: max is ideal positive, min is ideal negative
                $idealPositive[$kriteria->id] = max($values);
                $idealNegative[$kriteria->id] = min($values);
            } else {
                // For cost criteria: min is ideal positive, max is ideal negative
                $idealPositive[$kriteria->id] = min($values);
                $idealNegative[$kriteria->id] = max($values);
            }
        }
        
        return [
            'positive' => $idealPositive,
            'negative' => $idealNegative,
        ];
    }
    
    /**
     * Step 5: Calculate Distances to Ideal Solutions
     */
    private function calculateDistances($weightedMatrix, $idealSolutions)
    {
        $distances = [];
        
        foreach ($weightedMatrix as $pegawaiId => $row) {
            // Distance to positive ideal solution
            $sumPositive = 0;
            // Distance to negative ideal solution
            $sumNegative = 0;
            
            foreach ($row as $kriteriaId => $value) {
                $diffPositive = $value - $idealSolutions['positive'][$kriteriaId];
                $diffNegative = $value - $idealSolutions['negative'][$kriteriaId];
                
                $sumPositive += pow($diffPositive, 2);
                $sumNegative += pow($diffNegative, 2);
            }
            
            $distances[$pegawaiId] = [
                'positive' => sqrt($sumPositive),
                'negative' => sqrt($sumNegative),
            ];
        }
        
        return $distances;
    }
    
    /**
     * Step 6: Calculate Preference Values
     */
    private function calculatePreferences($distances)
    {
        $preferences = [];
        
        foreach ($distances as $pegawaiId => $distance) {
            $denominator = $distance['positive'] + $distance['negative'];
            if ($denominator > 0) {
                $preferences[$pegawaiId] = $distance['negative'] / $denominator;
            } else {
                $preferences[$pegawaiId] = 0;
            }
        }
        
        return $preferences;
    }
    
    /**
     * Step 7: Calculate Ranking
     */
    private function calculateRanking($preferences, $pegawais)
    {
        // Sort by preference value in descending order
        arsort($preferences);
        
        $rankings = [];
        $rank = 1;
        
        foreach ($preferences as $pegawaiId => $preference) {
            $pegawai = $pegawais->find($pegawaiId);
            if ($pegawai) {
                $rankings[] = [
                    'rank' => $rank,
                    'pegawai_id' => $pegawai->id,
                    'nama' => $pegawai->nama,
                    'nip' => $pegawai->nip,
                    'jabatan' => $pegawai->jabatan,
                    'divisi' => $pegawai->divisi,
                    'preference' => $preference,
                ];
                $rank++;
            }
        }
        
        return $rankings;
    }
}