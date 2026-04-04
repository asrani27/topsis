<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Http\Traits\TopsisCalculation;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    use TopsisCalculation;

    /**
     * Display the report index page
     */
    public function index()
    {
        return view('admin.laporan.index');
    }

    /**
     * Generate Kriteria PDF report
     */
    public function kriteriaPdf()
    {
        $kriterias = Kriteria::orderBy('id')->get();
        
        $pdf = PDF::loadView('admin.laporan.pdf.kriteria', compact('kriterias'))
                    ->setPaper('a4', 'landscape');
        
        return $pdf->stream('laporan-data-kriteria-' . date('d-m-Y') . '.pdf');
    }

    /**
     * Generate Pegawai PDF report
     */
    public function pegawaiPdf()
    {
        $pegawais = Pegawai::orderBy('id')->get();
        
        $pdf = PDF::loadView('admin.laporan.pdf.pegawai', compact('pegawais'))
                    ->setPaper('a4', 'landscape');
        
        return $pdf->stream('laporan-data-pegawai-' . date('d-m-Y') . '.pdf');
    }

    /**
     * Generate Ranking PDF report
     */
    public function rankingPdf()
    {
        // Calculate TOPSIS to get ranking data
        $results = $this->calculateTopsis();
        
        $pdf = PDF::loadView('admin.laporan.pdf.ranking', $results)
                    ->setPaper('a4', 'landscape');
        
        return $pdf->stream('laporan-hasil-ranking-' . date('d-m-Y') . '.pdf');
    }
}
