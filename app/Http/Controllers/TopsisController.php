<?php

namespace App\Http\Controllers;

use App\Http\Traits\TopsisCalculation;
use App\Models\Pegawai;

class TopsisController extends Controller
{
    use TopsisCalculation;

    /**
     * Display TOPSIS calculation results
     */
    public function index()
    {
        // Calculate TOPSIS
        $results = $this->calculateTopsis();
        
        return view('admin.topsis.index', $results);
    }
}